<?php

namespace Database\Seeders;

use App\Models\VerifiedAlumniData;
use Illuminate\Database\Seeder;

class VerifiedAlumniDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Predefined verified alumni data - MBSTU Format
        $verifiedAlumni = [
            // CSE Department - Format: CSE[YY][XXX]
            [
                'student_id' => 'CSE18001',
                'email' => 'cse18001@mbstu.ac.bd',
                'full_name' => 'Ahmed Rahman',
                'batch_year' => 2018,
                'graduation_year' => 2022,
                'degree' => 'B.Sc. in CSE',
                'phone' => '+8801712345678',
            ],
            [
                'student_id' => 'CSE18002',
                'email' => 'cse18002@mbstu.ac.bd',
                'full_name' => 'Fatima Khan',
                'batch_year' => 2018,
                'graduation_year' => 2022,
                'degree' => 'B.Sc. in CSE',
                'phone' => '+8801812345678',
            ],
            [
                'student_id' => 'CSE19001',
                'email' => 'cse19001@mbstu.ac.bd',
                'full_name' => 'Rafiq Islam',
                'batch_year' => 2019,
                'graduation_year' => 2023,
                'degree' => 'B.Sc. in CSE',
                'phone' => '+8801912345678',
            ],
            [
                'student_id' => 'CSE19002',
                'email' => 'cse19002@mbstu.ac.bd',
                'full_name' => 'Nadia Sultana',
                'batch_year' => 2019,
                'graduation_year' => 2023,
                'degree' => 'B.Sc. in CSE',
                'phone' => '+8801612345678',
            ],
            [
                'student_id' => 'CSE20001',
                'email' => 'cse20001@mbstu.ac.bd',
                'full_name' => 'Karim Hassan',
                'batch_year' => 2020,
                'graduation_year' => 2024,
                'degree' => 'B.Sc. in CSE',
                'phone' => '+8801512345678',
            ],

            // EEE Department
            [
                'student_id' => 'EEE18001',
                'email' => 'eee18001@mbstu.ac.bd',
                'full_name' => 'Salam Uddin',
                'batch_year' => 2018,
                'graduation_year' => 2022,
                'degree' => 'B.Sc. in EEE',
                'phone' => '+8801412345678',
            ],
            [
                'student_id' => 'EEE19001',
                'email' => 'eee19001@mbstu.ac.bd',
                'full_name' => 'Mariam Begum',
                'batch_year' => 2019,
                'graduation_year' => 2023,
                'degree' => 'B.Sc. in EEE',
                'phone' => '+8801312345678',
            ],

            // BBA Department
            [
                'student_id' => 'BBA18001',
                'email' => 'bba18001@mbstu.ac.bd',
                'full_name' => 'Hasan Ali',
                'batch_year' => 2018,
                'graduation_year' => 2022,
                'degree' => 'BBA',
                'phone' => '+8801212345678',
            ],
            [
                'student_id' => 'BBA19001',
                'email' => 'bba19001@mbstu.ac.bd',
                'full_name' => 'Ayesha Siddique',
                'batch_year' => 2019,
                'graduation_year' => 2023,
                'degree' => 'BBA',
                'phone' => '+8801112345678',
            ],

            // Civil Engineering Department
            [
                'student_id' => 'CE18001',
                'email' => 'ce18001@mbstu.ac.bd',
                'full_name' => 'Zahir Ahmed',
                'batch_year' => 2018,
                'graduation_year' => 2022,
                'degree' => 'B.Sc. in CE',
                'phone' => '+8801012345678',
            ],
            [
                'student_id' => 'CE22001',
                'email' => 'ce22001@mbstu.ac.bd',
                'full_name' => 'Samira Haque',
                'batch_year' => 2022,
                'graduation_year' => 2026,
                'degree' => 'B.Sc. in CE',
                'phone' => '+8801782345678',
            ],

            // English Department
            [
                'student_id' => 'ENG18001',
                'email' => 'eng18001@mbstu.ac.bd',
                'full_name' => 'Ibrahim Mahmud',
                'batch_year' => 2018,
                'graduation_year' => 2022,
                'degree' => 'BA in English',
                'phone' => '+8801682345678',
            ],
            [
                'student_id' => 'ENG19001',
                'email' => 'eng19001@mbstu.ac.bd',
                'full_name' => 'Zara Chowdhury',
                'batch_year' => 2019,
                'graduation_year' => 2023,
                'degree' => 'BA in English',
                'phone' => '+8801582345678',
            ],

            // Additional recent batches
            [
                'student_id' => 'CSE21001',
                'email' => 'cse21001@mbstu.ac.bd',
                'full_name' => 'Tariq Mahmood',
                'batch_year' => 2021,
                'graduation_year' => 2025,
                'degree' => 'B.Sc. in CSE',
                'phone' => '+8801482345678',
            ],
            [
                'student_id' => 'CSE21002',
                'email' => 'cse21002@mbstu.ac.bd',
                'full_name' => 'Sabrina Akter',
                'batch_year' => 2021,
                'graduation_year' => 2025,
                'degree' => 'B.Sc. in CSE',
                'phone' => '+8801382345678',
            ],
        ];

        foreach ($verifiedAlumni as $alumni) {
            VerifiedAlumniData::create($alumni);
        }

        $this->command->info('Verified alumni data seeded successfully!');
        $this->command->info('Total alumni in database: ' . count($verifiedAlumni));
    }
}
