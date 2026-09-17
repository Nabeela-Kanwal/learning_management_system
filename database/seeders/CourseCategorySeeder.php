<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Course;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseCategorySeeder extends Seeder
{
    /**
     * Reconcile known courses without replacing course content or deleting legacy records.
     * Safe to rerun: canonical slugs identify categories and subcategories.
     */
    public function run(): void
    {
        DB::transaction(function (): void {
            $groups = [];

            foreach (CourseCatalog::tracks() as [$category, $subcategory, , , $courses]) {
                $groups[] = [$category, $subcategory, array_column($courses, 0)];
            }

            // These courses predate the sample catalog and had unrelated categories.
            $groups[] = ['Data Science', 'Artificial Intelligence', ['Ai Enginerring', 'AI Engineering', 'Artificial Intelligence']];
            $groups[] = ['IT and Software', 'Computer Science', ['Computer Science']];
            $groups[] = ['Languages', 'English Language', ['English']];

            $categoryImages = [
                'Development' => 'web-development',
                'Design' => 'graphic-design',
                'Marketing' => 'digital-marketing',
                'Data Science' => 'data-analytics',
                'Business' => 'project-management',
                'IT and Software' => 'cybersecurity',
                'Languages' => 'english-language',
            ];

            foreach ($groups as [$categoryName, $subcategoryName, $titles]) {
                $category = Category::updateOrCreate(
                    ['slug' => Str::slug($categoryName)],
                    [
                        'name' => $categoryName,
                        'image' => 'images/course-taxonomy/'.$categoryImages[$categoryName].'.png',
                        'status' => 1,
                    ]
                );

                $subcategory = SubCategory::updateOrCreate(
                    ['slug' => Str::slug($categoryName.' '.$subcategoryName)],
                    [
                        'category_id' => $category->id,
                        'name' => $subcategoryName,
                        'image' => 'images/course-taxonomy/'.Str::slug($subcategoryName).'.png',
                    ]
                );

                Course::where(function ($query) use ($titles) {
                    $query->whereIn('course_title', $titles)
                        ->orWhereIn('course_slug', array_map(fn ($title) => Str::slug($title), $titles));
                })->update([
                    'category_id' => $category->id,
                    'subcategory_id' => $subcategory->id,
                ]);
            }
        });
    }
}
