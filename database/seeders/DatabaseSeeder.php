<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Department;
use App\Models\AlumniProfile;
use App\Models\Event;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Departments
        $departments = [
            [
                'name' => 'Computer Science & Engineering',
                'code' => 'CSE',
                'description' => 'Department of Computer Science and Engineering focuses on software development, algorithms, and computing systems.',
                'head_name' => 'Dr. John Smith',
                'contact_email' => 'cse@university.edu',
                'contact_phone' => '+1234567890',
            ],
            [
                'name' => 'Electrical & Electronic Engineering',
                'code' => 'EEE',
                'description' => 'Department of Electrical and Electronic Engineering specializes in power systems, electronics, and telecommunications.',
                'head_name' => 'Dr. Sarah Johnson',
                'contact_email' => 'eee@university.edu',
                'contact_phone' => '+1234567891',
            ],
            [
                'name' => 'Business Administration',
                'code' => 'BBA',
                'description' => 'Department of Business Administration offers programs in management, marketing, and entrepreneurship.',
                'head_name' => 'Dr. Michael Brown',
                'contact_email' => 'bba@university.edu',
                'contact_phone' => '+1234567892',
            ],
            [
                'name' => 'Civil Engineering',
                'code' => 'CE',
                'description' => 'Department of Civil Engineering focuses on infrastructure, construction, and environmental engineering.',
                'head_name' => 'Dr. Emily Davis',
                'contact_email' => 'ce@university.edu',
                'contact_phone' => '+1234567893',
            ],
            [
                'name' => 'English',
                'code' => 'ENG',
                'description' => 'Department of English offers programs in literature, linguistics, and creative writing.',
                'head_name' => 'Dr. Robert Wilson',
                'contact_email' => 'eng@university.edu',
                'contact_phone' => '+1234567894',
            ],
        ];

        $createdDepartments = [];
        foreach ($departments as $dept) {
            $createdDepartments[] = Department::create($dept);
        }

<<<<<<< HEAD
        // Seed verified alumni data
        $this->call(VerifiedAlumniDataSeeder::class);

=======
>>>>>>> 78ebf9cf692714fb93a2894277478235eb635f49
        // Create Super Admin
        $superAdmin = User::create([
            'name' => 'Super Administrator',
            'email' => 'admin@alumni.edu',
            'password' => Hash::make('password'),
            'role' => UserRole::SUPER_ADMIN,
            'email_verified_at' => now(),
        ]);

        // Create Department Admins
        foreach ($createdDepartments as $index => $department) {
            User::create([
                'name' => $department->name . ' Admin',
                'email' => strtolower($department->code) . '@university.edu',
                'password' => Hash::make('password'),
                'role' => UserRole::DEPARTMENT_ADMIN,
                'department_id' => $department->id,
                'email_verified_at' => now(),
            ]);
        }

        // Create Sample Alumni
        $cseDept = $createdDepartments[0];
        
        $alumniUsers = [
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'batch_year' => 2015,
                'graduation_year' => 2019,
                'degree' => 'Bachelor of Science',
                'major' => 'Computer Science',
                'current_company' => 'Google',
                'current_position' => 'Senior Software Engineer',
                'industry' => 'Technology',
            ],
            [
                'name' => 'Bob Williams',
                'email' => 'bob@example.com',
                'batch_year' => 2016,
                'graduation_year' => 2020,
                'degree' => 'Bachelor of Science',
                'major' => 'Software Engineering',
                'current_company' => 'Microsoft',
                'current_position' => 'Software Developer',
                'industry' => 'Technology',
            ],
            [
                'name' => 'Carol Martinez',
                'email' => 'carol@example.com',
                'batch_year' => 2015,
                'graduation_year' => 2019,
                'degree' => 'Bachelor of Science',
                'major' => 'Computer Science',
                'current_company' => 'Amazon',
                'current_position' => 'DevOps Engineer',
                'industry' => 'Technology',
            ],
        ];

        foreach ($alumniUsers as $alumniData) {
            $user = User::create([
                'name' => $alumniData['name'],
                'email' => $alumniData['email'],
                'password' => Hash::make('password'),
                'role' => UserRole::ALUMNI,
                'department_id' => $cseDept->id,
                'email_verified_at' => now(),
            ]);

            AlumniProfile::create([
                'user_id' => $user->id,
                'department_id' => $cseDept->id,
                'student_id' => 'STD' . rand(100000, 999999),
                'batch_year' => $alumniData['batch_year'],
                'graduation_year' => $alumniData['graduation_year'],
                'degree' => $alumniData['degree'],
                'major' => $alumniData['major'],
                'phone' => '+1' . rand(1000000000, 9999999999),
                'city' => 'New York',
                'country' => 'USA',
                'current_company' => $alumniData['current_company'],
                'current_position' => $alumniData['current_position'],
                'industry' => $alumniData['industry'],
                'bio' => 'Passionate about technology and innovation. Love to solve complex problems and build scalable solutions.',
                'is_profile_public' => true,
                'is_verified' => true,
            ]);
        }

        // Create Sample Events
        Event::create([
            'department_id' => $cseDept->id,
            'title' => 'CSE Alumni Reunion 2024',
            'description' => 'Join us for the annual CSE alumni reunion. Reconnect with old friends, network with fellow alumni, and celebrate our shared experiences.',
            'event_type' => 'reunion',
            'event_date' => now()->addMonths(2),
            'event_time' => '18:00:00',
            'location' => 'University Campus',
            'venue' => 'Main Auditorium',
            'registration_deadline' => now()->addMonth(),
            'max_participants' => 200,
            'is_public' => true,
            'is_active' => true,
        ]);

        Event::create([
            'department_id' => null, // University-wide event
            'title' => 'Career Fair 2024',
            'description' => 'Annual career fair connecting alumni with current students. Share your experiences and help shape future careers.',
            'event_type' => 'career_fair',
            'event_date' => now()->addMonths(3),
            'event_time' => '10:00:00',
            'location' => 'University Campus',
            'venue' => 'Sports Complex',
            'registration_deadline' => now()->addMonths(2)->subWeeks(2),
            'max_participants' => 500,
            'is_public' => true,
            'is_active' => true,
        ]);

        // Create Sample News
        News::create([
            'department_id' => $cseDept->id,
            'user_id' => $superAdmin->id,
            'title' => 'New Research Lab Inaugurated',
            'slug' => 'new-research-lab-inaugurated',
            'content' => 'The Department of Computer Science & Engineering is proud to announce the inauguration of our state-of-the-art AI Research Lab. This facility will enable cutting-edge research in artificial intelligence, machine learning, and data science.',
            'excerpt' => 'CSE department launches new AI Research Lab with state-of-the-art facilities.',
            'is_featured' => true,
            'is_published' => true,
            'published_at' => now(),
        ]);

        News::create([
            'department_id' => null,
            'user_id' => $superAdmin->id,
            'title' => 'University Celebrates 50 Years of Excellence',
            'slug' => 'university-celebrates-50-years',
            'content' => 'Our university marks its golden jubilee this year. Over the past 50 years, we have produced thousands of successful alumni who have made significant contributions to society. Join us in celebrating this milestone.',
            'excerpt' => 'University marks 50 years of academic excellence and achievements.',
            'is_featured' => true,
            'is_published' => true,
            'published_at' => now()->subDays(5),
        ]);
    }
}
