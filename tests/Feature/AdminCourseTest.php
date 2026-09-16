<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminCourseTest extends TestCase
{
    use DatabaseTransactions;

    public function test_guests_cannot_view_admin_courses(): void
    {
        foreach (['index', 'yajra', 'show', 'create', 'edit'] as $action) {
            $this->get(route('admin.courses.'.$action, in_array($action, ['show', 'edit']) ? 1 : []))
                ->assertRedirect(route('admin.login'));
        }
    }

    public function test_admin_can_create_and_update_courses_with_validation(): void
    {
        $this->post(route('admin.courses.store'), [])->assertRedirect(route('admin.login'));
        $this->put(route('admin.courses.update', 1), [])->assertRedirect(route('admin.login'));
        $instructor = User::factory()->create([
            'role' => 'instructor', 'first_name' => 'Course', 'last_name' => 'Instructor',
            'image' => '', 'phone' => '', 'address' => '',
        ]);
        $category = \App\Models\Category::create(['name' => 'Course test category', 'slug' => 'course-test-'.uniqid()]);
        $subcategory = \App\Models\SubCategory::create(['name' => 'Course test subcategory', 'slug' => 'course-test-'.uniqid(), 'category_id' => $category->id]);
        $this->actingAs(new User(['id' => 1, 'name' => 'Admin', 'role' => 'admin', 'status' => '1']), 'admin');
        $this->get(route('admin.courses.create'))->assertOk()->assertSee($instructor->email);
        $this->post(route('admin.courses.store'), [])->assertSessionHasErrors(['course_title', 'category_id', 'instructor_id']);
        $data = [
            'course_title' => 'Created by admin', 'course_slug' => 'admin-test-'.uniqid(),
            'category_id' => $category->id, 'subcategory_id' => $subcategory->id,
            'instructor_id' => $instructor->id, 'selling_price' => '99.50', 'discount_price' => '49.25',
            'status' => '1', 'featured' => '1',
        ];
        $this->post(route('admin.courses.store'), $data)->assertSessionHasNoErrors();
        $course = Course::where('course_slug', $data['course_slug'])->firstOrFail();
        $this->get(route('admin.courses.edit', $course->id))->assertOk()->assertSee('Created by admin');
        $this->put(route('admin.courses.update', $course->id), array_merge($data, ['course_title' => 'Edited by admin', 'featured' => '0']))
            ->assertSessionHasNoErrors()->assertRedirect(route('admin.courses.show', $course->id));
        $this->assertDatabaseHas('courses', ['id' => $course->id, 'course_title' => 'Edited by admin', 'featured' => '0']);
        $this->post(route('admin.courses.store'), $data)->assertSessionHasErrors('course_slug');
        $otherCategory = \App\Models\Category::create(['name' => 'Other category', 'slug' => 'other-'.uniqid()]);
        $this->put(route('admin.courses.update', $course->id), array_merge($data, ['category_id' => $otherCategory->id]))
            ->assertSessionHasErrors('subcategory_id');
        $instructor->update(['role' => 'user']);
        $this->put(route('admin.courses.update', $course->id), $data)->assertSessionHasErrors('instructor_id');
    }

    public function test_admin_can_list_search_and_view_courses_with_their_instructor(): void
    {
        $instructor = User::factory()->create(['name' => 'Unique Course Instructor', 'role' => 'instructor',
            'first_name' => 'Unique', 'last_name' => 'Instructor',
            'image' => '', 'phone' => '', 'address' => '',
        ]);
        $course = Course::create([
            'course_title' => 'Admin course test', 'instructor_id' => $instructor->id,
            'category_id' => 0, 'subcategory_id' => 0,
            'course_description' => '<script>alert(1)</script><p>Course description</p>',
        ]);
        $this->actingAs(new User(['id' => 1, 'name' => 'Admin', 'role' => 'admin', 'status' => '1']), 'admin');
        $this->get(route('admin.courses.index'))->assertOk()->assertSee('Instructor');
        $this->get(route('admin.courses.show', $course->id))->assertOk()
            ->assertSee($instructor->name)->assertSee($instructor->email)
            ->assertSee('Course description')->assertDontSee('<script>alert(1)</script>', false);
        $response = $this->getJson(route('admin.courses.yajra', [
            'draw' => 1, 'start' => 0, 'length' => 10,
            'columns' => [['data' => 'instructor_name', 'name' => 'instructor.name', 'searchable' => 'true', 'orderable' => 'true']],
            'search' => ['value' => 'Unique Course Instructor', 'regex' => 'false'],
        ]))->assertOk()->assertJsonPath('recordsFiltered', 1);
        $response->assertJsonPath('data.0.instructor_name', $instructor->name);
        $this->assertStringContainsString(route('admin.courses.show', $course->id), $response->json('data.0.action'));
        $course->update(['instructor_id' => 0]);
        $this->get(route('admin.courses.show', $course->id))->assertOk()->assertSee('Instructor unavailable');
        $this->get(route('admin.courses.show', 999999999))->assertNotFound();
    }
}
