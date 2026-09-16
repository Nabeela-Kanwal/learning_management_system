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

            foreach ($this->tracks() as [$categoryName, $subcategoryName, $instructorEmail, $image, $courses]) {
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
    }

    private function tracks(): array
    {
        return [
            ['Development', 'Web Development', 'ahmed.khan@example.com', 'images/blogs/web-development.png', [
                ['HTML and CSS for Beginners', 'build a responsive personal website'],
                ['JavaScript Fundamentals', 'create interactive browser interfaces'],
                ['Responsive Web Design with Bootstrap', 'design a mobile-friendly business website'],
                ['React Application Development', 'build a reusable component-based dashboard'],
                ['TypeScript for Frontend Developers', 'add reliable types to a frontend application'],
                ['Full Stack JavaScript Projects', 'deliver a complete application with authentication'],
            ]],
            ['Design', 'UI UX Design', 'sara.ali@example.com', 'images/blogs/accessible-web.png', [
                ['User Experience Design Fundamentals', 'research user needs and map customer journeys'],
                ['Figma Interface Design Essentials', 'create reusable interface components in Figma'],
                ['Wireframing and Interactive Prototyping', 'turn product ideas into testable prototypes'],
                ['Accessible Interface Design', 'design inclusive navigation and accessible forms'],
                ['Mobile App UI Design', 'create a consistent mobile application interface'],
                ['Design Systems for Digital Products', 'document reusable components and design tokens'],
            ]],
            ['Development', 'Laravel Development', 'usman.malik@example.com', 'images/blogs/laravel-project.png', [
                ['PHP Programming for Beginners', 'write practical server-side PHP programs'],
                ['Laravel Application Development', 'build a database-backed Laravel application'],
                ['MySQL Database Design', 'model relational data and write efficient queries'],
                ['REST API Development with Laravel', 'create validated and authenticated API endpoints'],
                ['Laravel Testing and Debugging', 'test application behavior and diagnose failures'],
                ['Advanced Laravel E Commerce Projects', 'build a catalog with carts and order management'],
            ]],
            ['Marketing', 'Digital Marketing', 'ayesha.noor@example.com', 'images/blogs/learning-portfolio.png', [
                ['Digital Marketing Fundamentals', 'plan a measurable digital marketing campaign'],
                ['Search Engine Optimization Essentials', 'improve website content and technical SEO'],
                ['Social Media Marketing Strategy', 'create a social media publishing plan'],
                ['Content Marketing and Copywriting', 'write useful content for a defined audience'],
                ['Email Marketing Campaigns', 'design audience segments and email sequences'],
                ['Marketing Analytics and Reporting', 'evaluate campaign results with actionable reports'],
            ]],
            ['Data Science', 'Data Analytics', 'bilal.ahmed@example.com', 'images/blogs/database-design.png', [
                ['Python Programming for Data Science', 'clean and transform data with Python'],
                ['Data Analysis with Pandas', 'explore tabular datasets and summarize findings'],
                ['Data Visualization with Python', 'communicate trends through clear charts'],
                ['SQL for Data Analysts', 'answer business questions using SQL queries'],
                ['Machine Learning Fundamentals', 'train and evaluate predictive models'],
                ['Practical Data Science Capstone', 'complete an end-to-end data analysis project'],
            ]],
            ['Design', 'Graphic Design', 'fatima.hassan@example.com', 'images/blogs/learning-portfolio.png', [
                ['Graphic Design Fundamentals', 'apply layout, contrast, and visual hierarchy'],
                ['Adobe Photoshop Essentials', 'edit photographs and compose digital artwork'],
                ['Adobe Illustrator for Beginners', 'create scalable vector illustrations'],
                ['Typography and Layout Design', 'combine type and spacing in editorial layouts'],
                ['Brand Identity Design', 'develop a cohesive logo and brand style guide'],
                ['Portfolio Projects for Graphic Designers', 'present a professional collection of design work'],
            ]],
            ['Development', 'Mobile App Development', 'hamza.sheikh@example.com', 'images/blogs/small-projects.png', [
                ['Dart Programming Fundamentals', 'write reusable Dart classes and functions'],
                ['Flutter App Development for Beginners', 'build a multi-screen Flutter application'],
                ['React Native Mobile Applications', 'create cross-platform mobile interfaces'],
                ['Mobile App API Integration', 'connect mobile screens to remote data'],
                ['Flutter State Management', 'manage shared application state predictably'],
                ['Mobile App Testing and Release', 'test and prepare a mobile application for release'],
            ]],
            ['Business', 'Business Communication', 'zainab.iqbal@example.com', 'images/blogs/helpful-questions.png', [
                ['Professional Communication Skills', 'communicate clearly in workplace situations'],
                ['Business Writing Essentials', 'write concise professional emails and reports'],
                ['Presentation Skills for Professionals', 'structure and deliver a persuasive presentation'],
                ['English for the Workplace', 'practice English for everyday workplace communication'],
                ['Remote Team Collaboration', 'coordinate tasks and feedback across remote teams'],
                ['Negotiation and Client Communication', 'prepare proposals and handle client discussions'],
            ]],
            ['IT and Software', 'Cybersecurity', 'omar.farooq@example.com', 'images/blogs/problem-solving.png', [
                ['Cybersecurity Fundamentals', 'recognize common threats and basic defenses'],
                ['Computer Networking Essentials', 'understand network protocols and troubleshoot connections'],
                ['Linux Administration for Beginners', 'manage users, files, and services on Linux'],
                ['Web Application Security', 'identify and remediate common application vulnerabilities'],
                ['Ethical Hacking in Practice Labs', 'assess security in an authorized practice environment'],
                ['Incident Response and Security Monitoring', 'investigate alerts and document a response plan'],
            ]],
            ['Business', 'Project Management', 'maryam.saeed@example.com', 'images/blogs/time-management.png', [
                ['Project Management Fundamentals', 'define scope, milestones, and project responsibilities'],
                ['Agile and Scrum Essentials', 'plan iterations and facilitate team ceremonies'],
                ['Project Planning and Scheduling', 'build a realistic schedule with dependencies'],
                ['Risk Management for Projects', 'identify project risks and prepare mitigation plans'],
                ['Team Leadership and Stakeholder Management', 'align team responsibilities and stakeholder expectations'],
                ['Practical Project Management Capstone', 'deliver a project plan with budget and progress reporting'],
            ]],
        ];
    }
}
