<?php

namespace Database\Seeders;

use App\Models\Info;
use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    public function run(): void
    {
        $cards = [
            ['Expert Teachers', 'Learn from passionate instructors who make complex topics easier to understand.', 'la-chalkboard-teacher'],
            ['Easy Communication', 'Ask questions and get the guidance you need to keep moving forward.', 'la-comments'],
            ['Grow Your Skills', 'Explore new subjects and build knowledge for your next personal or professional goal.', 'la-lightbulb'],
            ['Flexible Learning', 'Make room for learning in your day and build a routine that works for you.', 'la-clock'],
            ['Explore Your Interests', 'Discover courses across a range of subjects and find your next learning opportunity.', 'la-book-open'],
            ['Here to Help', 'Contact our team when you need help with a course or your account.', 'la-headset'],
        ];
        foreach ($cards as $index => [$title, $description, $icon]) {
            Info::firstOrCreate(['title' => $title], compact('description', 'icon') + ['sort_order' => $index, 'status' => true]);
        }
    }
}
