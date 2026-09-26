<?php

namespace Tests\Feature;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TestimonialTest extends TestCase
{
    use DatabaseTransactions;

    private function payload(array $overrides = []): array
    {
        return array_replace(['name' => 'Test student', 'role' => 'Student', 'quote' => 'A useful learning experience.', 'rating' => 4, 'sort_order' => 0, 'status' => 1], $overrides);
    }

    private function admin(): void
    {
        $this->actingAs(new User(['id' => 1, 'name' => 'Admin', 'role' => 'admin', 'status' => '1']), 'admin');
    }

    public function test_guests_cannot_manage_testimonials(): void
    {
        $testimonial = Testimonial::create($this->payload());
        $this->get(route('admin.testimonial.index'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.testimonial.create'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.testimonial.edit', $testimonial))->assertRedirect(route('admin.login'));
        $this->post(route('admin.testimonial.store'), $this->payload())->assertRedirect(route('admin.login'));
        $this->put(route('admin.testimonial.update', $testimonial), $this->payload())->assertRedirect(route('admin.login'));
        $this->delete(route('admin.testimonial.destroy'), ['id' => $testimonial->id])->assertRedirect(route('admin.login'));
        $this->assertDatabaseHas('testimonials', ['id' => $testimonial->id]);
    }

    public function test_admin_can_manage_testimonials_and_portraits(): void
    {
        Storage::fake('public');
        $this->app->usePublicPath(Storage::disk('public')->path('test-public'));
        $this->admin();
        $this->get(route('admin.testimonial.index'))->assertOk();
        $this->get(route('admin.testimonial.create'))->assertOk()->assertSee('testimonialForm')->assertSee('Sort Order');
        $this->get(route('admin.testimonial.yajra'), ['X-Requested-With' => 'XMLHttpRequest'])->assertOk()->assertJsonStructure(['data']);
        $this->post(route('admin.testimonial.store'), $this->payload(['image' => UploadedFile::fake()->image('portrait.jpg')]))->assertRedirect(route('admin.testimonial.index'));
        $testimonial = Testimonial::latest('id')->firstOrFail();
        $original = $testimonial->image;
        $this->assertStringStartsWith('images/testimonial/', $original);
        $this->assertFileExists(public_path($original));
        $this->assertSame(asset($original), $testimonial->image_url);
        $this->get(route('admin.testimonial.edit', $testimonial))->assertOk()->assertSee('Test student');
        $this->put(route('admin.testimonial.update', $testimonial), $this->payload(['status' => 0]))->assertRedirect();
        $this->assertSame($original, $testimonial->fresh()->image);
        $this->assertFalse($testimonial->fresh()->status);
        $this->put(route('admin.testimonial.update', $testimonial), $this->payload(['image' => UploadedFile::fake()->image('new.jpg')]))->assertRedirect();
        $this->assertFileDoesNotExist(public_path($original));
        $replacement = $testimonial->fresh()->image;
        $this->assertFileExists(public_path($replacement));
        $this->put(route('admin.testimonial.update', $testimonial), $this->payload(['remove_image' => 1]))->assertRedirect();
        $this->assertFileDoesNotExist(public_path($replacement));
        $this->assertNull($testimonial->fresh()->image);
        $this->delete(route('admin.testimonial.destroy'), ['id' => $testimonial->id])->assertRedirect(route('admin.testimonial.index'));
        $this->assertDatabaseMissing('testimonials', ['id' => $testimonial->id]);
    }

    public function test_invalid_testimonials_are_rejected(): void
    {
        $this->admin();
        $this->post(route('admin.testimonial.store'), $this->payload(['name' => '', 'quote' => '', 'rating' => 6, 'status' => 4, 'sort_order' => -1, 'image' => UploadedFile::fake()->create('bad.txt')]))
            ->assertSessionHasErrors(['name', 'quote', 'rating', 'status', 'sort_order', 'image']);
        $this->get(route('admin.testimonial.edit', 99999999))->assertNotFound();
    }

    public function test_home_only_shows_published_feedback_in_order_and_escapes_html(): void
    {
        Testimonial::query()->update(['status' => false]);
        $this->get(route('home'))->assertOk()->assertDontSee('id="testimonials-title"', false);
        Testimonial::create($this->payload(['name' => 'Later student', 'sort_order' => 10]));
        Testimonial::create($this->payload(['name' => '<script>First student</script>']));
        Testimonial::create($this->payload(['name' => 'Unpublished student', 'status' => 0]));
        $this->get(route('home'))->assertOk()
            ->assertSeeInOrder(['&lt;script&gt;First student&lt;/script&gt;', 'Later student'], false)
            ->assertDontSee('<script>First student</script>', false)
            ->assertDontSee('Unpublished student')->assertSee('4 out of 5 stars');
    }
}
