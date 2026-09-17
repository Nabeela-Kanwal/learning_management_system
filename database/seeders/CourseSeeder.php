<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Add 60 sample courses without overwriting existing content.
     */
    public function run(): void
    {
        DB::transaction(function (): void {
            $this->call(InstructorSeeder::class);

            foreach (CourseCatalog::tracks() as [$categoryName, $subcategoryName, $instructorEmail, $image, $courses]) {
                $instructor = User::where('email', $instructorEmail)->where('role', 'instructor')->firstOrFail();
                $category = Category::firstOrCreate(['slug' => Str::slug($categoryName)], [
                    'name' => $categoryName,
                    'image' => $image,
                    'status' => 1,
                ]);
                $subcategory = SubCategory::firstOrCreate([
                    'slug' => Str::slug($categoryName.' '.$subcategoryName),
                ], ['category_id' => $category->id, 'name' => $subcategoryName]);

                if ($subcategory->category_id != $category->id) {
                    throw new \RuntimeException('The seeded subcategory belongs to a different category: '.$subcategoryName);
                }

                foreach ($courses as $index => [$title, $outcome]) {
                    $level = $index < 2 ? 'Beginner' : ($index < 4 ? 'Intermediate' : 'Advanced');
                    $price = 49 + ($index * 20);

                    Course::firstOrCreate(['course_slug' => Str::slug($title)], [
                        'category_id' => $category->id,
                        'subcategory_id' => $subcategory->id,
                        'instructor_id' => $instructor->id,
                        'course_title' => $title,
                        'course_name' => $title,
                        'course_image' => $image,
                        'course_description' => '<p>Learn to '.$outcome.' in this practical '.$subcategoryName.' course.</p>'
                            .'<p>Work through guided examples, practice exercises, and a final project. By the end, you will be able to '.$outcome.' and explain your approach.</p>',
                        'label' => $level,
                        'resources' => 'Practice exercises, project briefs, and revision checklists',
                        'certificate' => 'Certificate of completion',
                        'selling_price' => number_format($price, 2, '.', ''),
                        'discount_price' => number_format($price - 20, 2, '.', ''),
                        'prerequisites' => $index < 2
                            ? 'No prior experience required. Basic computer skills and internet access.'
                            : 'Familiarity with the fundamentals of '.$subcategoryName.' and a computer for practice.',
                        'best_seller' => $index === 0 ? '1' : '0',
                        'featured' => $index < 2 ? '1' : '0',
                        'hightest_rated' => $index === 2 ? '1' : '0',
                        'status' => 1,
                    ]);
                }
            }
        });

        $this->call(CourseCategorySeeder::class);
    }
}
