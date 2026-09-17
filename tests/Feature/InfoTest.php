<?php

namespace Tests\Feature;

use App\Models\Info;
use App\Models\User;
use App\Services\InfoService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class InfoTest extends TestCase
{
    use DatabaseTransactions;

    private function payload(array $overrides = []): array
    {
        return array_replace(['title' => 'Test learning card', 'description' => 'Helpful learning guidance.', 'icon' => 'la-book-open', 'sort_order' => 20, 'status' => 1], $overrides);
    }

    private function admin(): void
    {
        $this->actingAs(new User(['id' => 1, 'name' => 'Admin', 'role' => 'admin', 'status' => '1']), 'admin');
    }

    public function test_guests_cannot_manage_cards(): void
    {
        $info = Info::create($this->payload());
        $this->get(route('admin.info.index'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.info.create'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.info.edit', $info->id))->assertRedirect(route('admin.login'));
        $this->post(route('admin.info.store'), $this->payload())->assertRedirect(route('admin.login'));
        $this->put(route('admin.info.update', $info->id), $this->payload(['title' => 'Changed']))->assertRedirect(route('admin.login'));
        $this->delete(route('admin.info.destroy', $info->id))->assertRedirect(route('admin.login'));
        $this->assertSame('Test learning card', $info->fresh()->title);
    }

    public function test_admin_can_create_edit_deactivate_and_delete_cards(): void
    {
        $this->admin();
        $this->get(route('admin.info.index'))->assertOk();
        $this->get(route('admin.info.create'))->assertOk();
        $this->post(route('admin.info.store'), $this->payload())->assertRedirect(route('admin.info.index'));
        $info = Info::where('title', 'Test learning card')->firstOrFail();
        $this->get(route('admin.info.edit', $info->id))->assertOk()->assertSee($info->title);
        $this->put(route('admin.info.update', $info->id), $this->payload(['title' => 'Updated card', 'status' => 0]))->assertRedirect(route('admin.info.index'));
        $this->assertDatabaseHas('infos', ['id' => $info->id, 'title' => 'Updated card', 'status' => 0]);
        $this->delete(route('admin.info.destroy', $info->id))->assertRedirect(route('admin.info.index'));
        $this->assertDatabaseMissing('infos', ['id' => $info->id]);
    }

    public function test_invalid_fields_and_unknown_icons_are_rejected(): void
    {
        $this->admin();
        $this->post(route('admin.info.store'), $this->payload(['title' => '', 'description' => str_repeat('x', 501), 'icon' => '<script>', 'sort_order' => -1, 'status' => 4]))
            ->assertSessionHasErrors(['title', 'description', 'icon', 'sort_order', 'status']);
        $this->get(route('admin.info.edit', 99999999))->assertNotFound();
    }

    public function test_home_shows_only_active_cards_in_order_and_escapes_content(): void
    {
        Info::query()->update(['status' => false]);
        Info::create($this->payload(['title' => 'Later card', 'sort_order' => 10]));
        Info::create($this->payload(['title' => '<script>First card</script>', 'sort_order' => 0]));
        Info::create($this->payload(['title' => 'Hidden info card', 'status' => 0]));
        $this->get(route('home'))->assertOk()
            ->assertSeeInOrder(['&lt;script&gt;First card&lt;/script&gt;', 'Later card'], false)
            ->assertDontSee('<script>First card</script>', false)
            ->assertDontSee('Hidden info card');
        Info::query()->update(['status' => false]);
        $this->assertCount(0, app(InfoService::class)->getActiveInfos());
        $this->get(route('home'))->assertOk()->assertDontSee('Later card');
    }
}
