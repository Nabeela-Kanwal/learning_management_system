<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\SubCategory;
use Database\Seeders\CourseCategorySeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CourseCategorySeederTest extends TestCase
{
    use DatabaseTransactions;

    public function test_seeder_repairs_course_mapping_and_can_be_rerun_without_duplicates(): void
    {
        $legacy = Category::create(['name' => 'Legacy test category', 'slug' => 'legacy-taxonomy-test', 'status' => 1]);
        $sub = SubCategory::create(['category_id' => $legacy->id, 'name' => 'Legacy', 'slug' => 'legacy-taxonomy-test']);
        $course = Course::create([
            'course_title' => 'English',
            'course_slug' => 'english-taxonomy-test',
            'category_id' => $legacy->id,
            'subcategory_id' => $sub->id,
            'instructor_id' => 1,
            'course_description' => 'Keep my original content.',
        ]);

        $this->seed(CourseCategorySeeder::class);
        $course->refresh();
        $this->assertSame('Languages', $course->category->name);
        $this->assertSame('English Language', $course->subcategory->name);
        $this->assertEquals($course->category_id, $course->subcategory->category_id);
        $this->assertSame('Keep my original content.', $course->course_description);
        $this->assertSame('images/course-taxonomy/english-language.png', $course->subcategory->image);
        $this->assertDatabaseHas('categories', ['id' => $legacy->id]);

        $counts = [Category::count(), SubCategory::count(), Course::count()];
        $this->seed(CourseCategorySeeder::class);
        $this->assertSame($counts, [Category::count(), SubCategory::count(), Course::count()]);
    }

    public function test_frontend_categories_only_include_published_courses(): void
    {
        $empty = Category::create(['name' => 'Empty taxonomy test', 'slug' => 'empty-taxonomy-test', 'status' => 1]);
        $category = Category::create(['name' => 'Published taxonomy test', 'slug' => 'published-taxonomy-test', 'status' => 1]);
        $sub = SubCategory::create(['category_id' => $category->id, 'name' => 'Published subject', 'slug' => 'published-subject-test']);
        foreach ([1, 0] as $status) {
            Course::create([
                'course_title' => 'Taxonomy visibility test',
                'category_id' => $category->id,
                'subcategory_id' => $sub->id,
                'instructor_id' => 1,
                'status' => $status,
            ]);
        }

        $this->assertFalse(Category::withPublishedCourses()->whereKey($empty->id)->exists());
        $this->assertSame(1, Category::withPublishedCourses()->findOrFail($category->id)->courses_count);
        $this->get(route('category.index'))->assertOk()
            ->assertSee('Published taxonomy test')->assertSee('Published subject')
            ->assertDontSee('Empty taxonomy test');
    }
}
