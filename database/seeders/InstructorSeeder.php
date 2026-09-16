<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InstructorSeeder extends Seeder
{
    /**
     * Seed ten sample instructors with existing local profile images.
     */
    public function run(): void
    {
        $instructors = [
            ['Ahmed', 'Khan', 'Web Development', 'Lahore'],
            ['Sara', 'Ali', 'UI/UX Design', 'Karachi'],
            ['Usman', 'Malik', 'Laravel Development', 'Islamabad'],
            ['Ayesha', 'Noor', 'Digital Marketing', 'Lahore'],
            ['Bilal', 'Ahmed', 'Data Science', 'Karachi'],
            ['Fatima', 'Hassan', 'Graphic Design', 'Islamabad'],
            ['Hamza', 'Sheikh', 'Mobile App Development', 'Faisalabad'],
            ['Zainab', 'Iqbal', 'Business Communication', 'Rawalpindi'],
            ['Omar', 'Farooq', 'Cybersecurity', 'Peshawar'],
            ['Maryam', 'Saeed', 'Project Management', 'Multan'],
        ];

        $password = Hash::make('password');

        foreach ($instructors as $index => [$firstName, $lastName, $specialty, $city]) {
            $email = strtolower($firstName.'.'.$lastName).'@example.com';

            // Preserve existing accounts and their credentials when rerunning.
            User::firstOrCreate(['email' => $email], [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'name' => $firstName.' '.$lastName,
                'password' => $password,
                'email_verified_at' => now(),
                'role' => 'instructor',
                'status' => '1',
                'image' => 'frontend/images/team'.($index === 0 ? '' : $index + 1).'.jpg',
                'phone' => '030000000'.str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT),
                'address' => $city.', Pakistan',
                'city' => $city,
                'country' => 'Pakistan',
                'gender' => $index % 2 === 0 ? 'male' : 'female',
                'bio' => 'Instructor specializing in '.$specialty.'. Passionate about helping students develop practical skills through hands-on learning.',
                'experience' => (5 + $index).' years of professional experience in '.$specialty.'.',
            ]);
        }
    }
}
