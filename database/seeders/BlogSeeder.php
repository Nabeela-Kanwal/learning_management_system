<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Seed LMS blog posts without creating duplicates on subsequent runs.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'How to Choose the Right Online Course',
                'short_description' => 'Match your next course to your goals, experience, and available study time.',
                'description' => 'Start with one clear outcome, such as building a website or improving your presentation skills. Read the course outline and prerequisites to check that the lessons match your current level.' . "\n\n" . 'Compare the expected workload with your weekly schedule. Choose a course with practical exercises, then set a small milestone for your first week.',
            ],
            [
                'title' => 'Build a Study Routine That Lasts',
                'short_description' => 'Turn online learning into a consistent habit with a realistic weekly schedule.',
                'description' => 'Reserve a regular study slot and decide what you will complete before each session begins. A focused half hour can be easier to maintain than an ambitious weekend marathon.' . "\n\n" . 'Keep your notes and course materials in one place. Review your progress at the end of the week and adjust your plan when work or family commitments change.',
            ],
            [
                'title' => 'Getting Started with Web Development',
                'short_description' => 'Explore how HTML, CSS, and JavaScript work together to build web pages.',
                'description' => 'Begin with HTML to structure headings, paragraphs, links, and forms. Add CSS to control spacing, colors, and layout before introducing JavaScript for interactive behavior.' . "\n\n" . 'Practice by building a personal profile page. Make it usable on a small screen, test every link, and explain your code in your own words before moving to a larger project.',
            ],
            [
                'title' => 'Learn Laravel Through a Small Project',
                'short_description' => 'Practice Laravel concepts by building a simple application step by step.',
                'description' => 'Choose a small project, such as a reading list, with a manageable set of features. Follow a request through its route, controller, model, and Blade view to understand how the application fits together.' . "\n\n" . 'Use migrations to describe your database and validate submitted form data. Add one feature at a time and check both successful submissions and invalid input.',
            ],
            [
                'title' => 'Why Practice Matters More Than Watching',
                'short_description' => 'Make each video lesson useful by applying what you have learned.',
                'description' => 'After watching a lesson, close the example and try the exercise yourself. Notice where you get stuck, then revisit only the section needed to continue.' . "\n\n" . 'Change one requirement in the original exercise to test your understanding. Keep a record of mistakes and solutions so that your practice becomes a resource for future projects.',
            ],
            [
                'title' => 'Take Better Notes During Online Lessons',
                'short_description' => 'Create short, useful notes that help you recall and apply key concepts.',
                'description' => 'Organize each set of notes around a question the lesson answers. Summarize the idea in plain language and include one example instead of copying every slide.' . "\n\n" . 'Finish with a short list of points you still need to clarify. At your next study session, try answering those questions from memory before opening your notes.',
            ],
            [
                'title' => 'Prepare for Quizzes with Active Recall',
                'short_description' => 'Use self-testing to discover what you understand and what needs another review.',
                'description' => 'Turn lesson headings into questions and answer them without looking at the material. Check your answers afterward and mark the topics that need more practice.' . "\n\n" . 'Spread short review sessions across several days. When a quiz answer is incorrect, explain why the correct option works rather than memorizing its position.',
            ],
            [
                'title' => 'Manage Your Time While Learning Online',
                'short_description' => 'Break course goals into manageable tasks that fit around daily responsibilities.',
                'description' => 'List the lessons, reading, and exercises you want to complete this week. Estimate a time block for each task and leave space for topics that take longer than expected.' . "\n\n" . 'During each block, work on one task and silence avoidable notifications. If you miss a session, reschedule the next useful step instead of trying to catch up all at once.',
            ],
            [
                'title' => 'Create Your First Learning Portfolio',
                'short_description' => 'Show your progress through practical projects and clear explanations.',
                'description' => 'Select a few projects that demonstrate different skills. For each one, describe the problem, your approach, and the result, including screenshots or a working example when appropriate.' . "\n\n" . 'Explain what you built yourself and credit any shared resources. Update your portfolio as your skills improve, replacing weaker examples with work you can confidently discuss.',
            ],
            [
                'title' => 'Set Learning Goals You Can Measure',
                'short_description' => 'Replace vague ambitions with specific outcomes and achievable milestones.',
                'description' => 'Instead of planning to learn programming, choose an outcome such as creating a form that validates user input. Divide that outcome into smaller steps you can complete and check.' . "\n\n" . 'Set a realistic review date for each milestone. Measure progress through tasks you can perform independently and revise your plan when you discover a missing prerequisite.',
            ],
            [
                'title' => 'Ask Questions That Get Helpful Answers',
                'short_description' => 'Give instructors and fellow learners enough context to understand your problem.',
                'description' => 'State what you are trying to achieve, what you tried, and what happened. For technical problems, include a small relevant example and the exact error message without sharing passwords or private data.' . "\n\n" . 'Mention the lesson or concept that caused confusion. After resolving the issue, write down the explanation so you can apply it again and help others facing a similar problem.',
            ],
            [
                'title' => 'A Beginner Guide to Database Design',
                'short_description' => 'Understand tables, relationships, and constraints before building complex features.',
                'description' => 'Start by identifying the things your application stores, such as learners, courses, and enrollments. Give each table a clear purpose and use relationships to connect records instead of repeating the same information.' . "\n\n" . 'Think about which fields must be unique and which can be empty. Sketch a few example records and check that the design supports the questions your application needs to answer.',
            ],
            [
                'title' => 'Improve Your Problem-Solving Skills',
                'short_description' => 'Use a repeatable process to work through unfamiliar learning challenges.',
                'description' => 'Describe the problem in your own words and identify the expected result. Break the task into smaller parts, then work through a simple example before attempting the full solution.' . "\n\n" . 'When an approach fails, record what you learned from it. Compare your final answer with the original requirements and consider an edge case that might expose a missing step.',
            ],
            [
                'title' => 'Learn Effectively with Small Projects',
                'short_description' => 'Build confidence by completing focused projects with clear boundaries.',
                'description' => 'Choose a project that exercises one or two new skills, such as a responsive course card or a searchable list. Write down the minimum features required to call it complete.' . "\n\n" . 'Finish those features before adding extras. Review the result, note one improvement for next time, and move to a slightly more challenging project when you can explain the current one.',
            ],
            [
                'title' => 'Stay Motivated During a Long Course',
                'short_description' => 'Keep momentum by recognizing small wins and adjusting your learning plan.',
                'description' => 'Divide a long course into shorter milestones and connect each milestone to a useful skill. Track completed exercises so your progress is visible even before the course is finished.' . "\n\n" . 'If motivation drops, identify whether the material is too difficult, too familiar, or difficult to fit into your schedule. Adjust the pace or review a prerequisite and restart with a manageable task.',
            ],
            [
                'title' => 'Make the Most of Instructor Feedback',
                'short_description' => 'Turn comments on your work into specific actions for your next attempt.',
                'description' => 'Read feedback alongside the assignment requirements and separate corrections from optional improvements. Identify one or two changes that will make the biggest difference to your work.' . "\n\n" . 'Revise the assignment and compare the new version with your original submission. If a comment is unclear, ask a focused question and explain how you interpreted the suggestion.',
            ],
            [
                'title' => 'Build Accessible Web Pages from the Start',
                'short_description' => 'Include clear structure, useful labels, and keyboard access in your practice projects.',
                'description' => 'Use meaningful headings and descriptive link text so visitors can understand the page structure. Give form controls visible labels and provide helpful text when an entry needs correction.' . "\n\n" . 'Try navigating your page with only a keyboard and check that focus remains visible. Add appropriate text alternatives for informative images and review whether your colors are easy to distinguish.',
            ],
            [
                'title' => 'Balance Learning with Work and Family',
                'short_description' => 'Create a flexible learning plan that respects your existing commitments.',
                'description' => 'Choose a weekly workload you can sustain during an ordinary busy week. Discuss your study time with the people who share your schedule and keep a few shorter backup sessions available.' . "\n\n" . 'Prioritize the most useful lesson or exercise when time is limited. Review your commitments regularly and reduce the pace when necessary instead of abandoning your learning goal.',
            ],
            [
                'title' => 'Review a Course Before Moving Forward',
                'short_description' => 'Consolidate your knowledge with a practical review at the end of each course.',
                'description' => 'Revisit the course objectives and describe what you can now do without assistance. Try a small task that combines several lessons and note any concepts that still feel uncertain.' . "\n\n" . 'Organize your best notes and examples for future reference. Choose your next course based on a specific skill gap or project requirement so that your learning has a clear direction.',
            ],
            [
                'title' => 'From Course Completion to Real-World Skills',
                'short_description' => 'Apply what you learn in a realistic project and explain the decisions behind your work.',
                'description' => 'Choose a practical problem that relates to your course and define what a useful solution should achieve. Build a first version using the skills you practiced, then test it against those requirements.' . "\n\n" . 'Ask someone to try the result and observe where they need help. Improve the project based on that feedback and document your decisions so you can demonstrate both your skills and your reasoning.',
            ],
        ];

        foreach ($blogs as $index => $blog) {
            Blog::updateOrCreate(
                ['slug' => Str::slug($blog['title'])],
                array_merge($blog, [
                    'image' => 'frontend/images/img8.jpg',
                    'author' => 'LMS Learning Team',
                    'published_at' => today()->subDays($index)->toDateString(),
                    'status' => true,
                ]),
            );
        }
    }
}
