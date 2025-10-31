<?php

namespace Database\Seeders;

use App\Models\AlumniPhoto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumniPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $photos = [
            [
                'title' => 'Annual Alumni Reunion 2024',
                'description' => 'A memorable gathering of MBSTU alumni from various batches celebrating together.',
                'photo_path' => 'images/alumni-photos/reunion2024.jpg',
                'event_name' => 'Alumni Reunion 2024',
                'event_date' => '2024-12-15',
                'location' => 'MBSTU Campus',
                'year' => 2024,
                'category' => 'reunion',
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'title' => 'Graduation Ceremony 2023',
                'description' => 'Proud graduates receiving their degrees at the convocation ceremony.',
                'photo_path' => 'images/alumni-photos/graduation2023.jpg',
                'event_name' => 'Convocation 2023',
                'event_date' => '2023-06-20',
                'location' => 'MBSTU Auditorium',
                'year' => 2023,
                'category' => 'graduation',
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'title' => 'Cultural Program',
                'description' => 'Alumni performing at the annual cultural event showcasing MBSTU talent.',
                'photo_path' => 'images/alumni-photos/cultural.jpg',
                'event_name' => 'Cultural Night',
                'event_date' => '2024-03-10',
                'location' => 'MBSTU Auditorium',
                'year' => 2024,
                'category' => 'cultural',
                'is_published' => true,
            ],
            [
                'title' => 'Sports Day Winners',
                'description' => 'Alumni sports champions with their trophies.',
                'photo_path' => 'images/alumni-photos/sports.jpg',
                'event_name' => 'Inter-Batch Sports Day',
                'event_date' => '2024-02-25',
                'location' => 'MBSTU Sports Complex',
                'year' => 2024,
                'category' => 'sports',
                'is_published' => true,
            ],
            [
                'title' => 'Campus Memories',
                'description' => 'Beautiful moments captured around the MBSTU campus.',
                'photo_path' => 'images/alumni-photos/campus.jpg',
                'event_name' => null,
                'event_date' => null,
                'location' => 'MBSTU Campus',
                'year' => 2024,
                'category' => 'campus',
                'is_published' => true,
            ],
            [
                'title' => 'Alumni Meet 2022',
                'description' => 'Senior alumni sharing their experiences with recent graduates.',
                'photo_path' => 'images/alumni-photos/meet2022.jpg',
                'event_name' => 'Alumni Networking Event',
                'event_date' => '2022-11-05',
                'location' => 'MBSTU Conference Hall',
                'year' => 2022,
                'category' => 'event',
                'is_published' => true,
            ],
            [
                'title' => 'Science Fair 2023',
                'description' => 'Alumni participating in the annual science and technology fair.',
                'photo_path' => 'images/alumni-photos/sciencefair.jpg',
                'event_name' => 'MBSTU Science Fair',
                'event_date' => '2023-09-15',
                'location' => 'MBSTU Science Building',
                'year' => 2023,
                'category' => 'event',
                'is_published' => true,
            ],
            [
                'title' => 'Farewell Ceremony',
                'description' => 'Emotional farewell to graduating students.',
                'photo_path' => 'images/alumni-photos/farewell.jpg',
                'event_name' => 'Farewell 2024',
                'event_date' => '2024-05-20',
                'location' => 'MBSTU Campus',
                'year' => 2024,
                'category' => 'ceremony',
                'is_published' => true,
            ],
        ];

        foreach ($photos as $photo) {
            AlumniPhoto::create($photo);
        }
    }
}
