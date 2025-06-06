<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Location;
use App\Models\Instructor;
use App\Models\Workshop;

class WorkshopsSeeder extends Seeder
{
    public function run()
    {
        // Seed categories
        $categories = [
            ['name' => 'Dance and Theater'],
            ['name' => 'Music'],
            ['name' => 'Education, Arts and Technology'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Seed locations (assuming one location for all workshops)
        $location = Location::create(['name' => 'Cultural Center']);

        // Seed instructors
        $instructors = [
            [
                'name' => 'Ballet Instructor',
                'contact' => '0999515048'
            ],
            [
                'name' => 'Folk Dance Instructor',
                'contact' => '0986304755'
            ],
            [
                'name' => 'Capoeira Instructor',
                'contact' => '0984105293'
            ],
            [
                'name' => 'Urban Dance Instructor',
                'contact' => '0996492554'
            ],
            [
                'name' => 'Dance Theater Instructor',
                'contact' => '0995296551'
            ],
            [
                'name' => 'Therapeutic Ballroom Dance Instructor',
                'contact' => '0999515048'
            ],
            [
                'name' => 'Theater Instructor',
                'contact' => '0987952269'
            ],
            [
                'name' => 'Acting for Film and TV Instructor',
                'contact' => '0982892359'
            ],
            [
                'name' => 'Choir Instructor',
                'contact' => '0985808781'
            ],
            [
                'name' => 'Singing Instructor',
                'contact' => '0986760871'
            ],
            [
                'name' => 'Violin, Viola, Cello Instructor',
                'contact' => '0983087747'
            ],
            [
                'name' => 'Specialized Violin Instructor',
                'contact' => '0999515048'
            ],
            [
                'name' => 'Popular Guitar Instructor',
                'contact' => '0986036074'
            ],
            [
                'name' => 'Classical/Electric Guitar Instructor',
                'contact' => '0989216465'
            ],
            [
                'name' => 'Piano Instructor',
                'contact' => '0986295107'
            ],
            [
                'name' => 'Accordion and Percussion Instructor',
                'contact' => '0994418363'
            ],
            [
                'name' => 'Drums Instructor',
                'contact' => '0986023796'
            ],
            [
                'name' => 'Andean Instruments Instructor',
                'contact' => '0999515048'
            ],
            [
                'name' => 'Theater for People with Disabilities Instructor',
                'contact' => '0999515048'
            ],
            [
                'name' => 'Photography and Video Instructor',
                'contact' => '0985331478'
            ],
            [
                'name' => 'Artificial Intelligence Instructor',
                'contact' => '0981137450'
            ],
            [
                'name' => 'Cinematography Instructor',
                'contact' => '0989492091'
            ],
            [
                'name' => 'Drawing Instructor',
                'contact' => '0986585565'
            ],
            [
                'name' => 'Calligraphy Instructor',
                'contact' => '0985695836'
            ],
            [
                'name' => 'Declamation Instructor',
                'contact' => '0988677885'
            ],
            [
                'name' => 'Creative Writing Instructor',
                'contact' => '0998452636'
            ],
            [
                'name' => 'Chess Instructor',
                'contact' => '0998637647'
            ],
            [
                'name' => 'Introduction to Kichwa Instructor',
                'contact' => '0984073983'
            ],
        ];

        foreach ($instructors as $instructor) {
            Instructor::create($instructor);
        }

        // Seed workshops
        $workshops = [
            // Dance and Theater
            [
                'name' => 'Ballet (Baby, Pre, Initial, Youth)',
                'monthly_cost' => 30,
                'age_range' => 'from 3 years',
                'class_days' => 'various (by level)',
                'morning_schedule' => null,
                'afternoon_schedule' => null,
                'instructor_id' => 1,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Folk Dance',
                'monthly_cost' => 30,
                'age_range' => '5+',
                'class_days' => 'Tuesday, Thursday',
                'morning_schedule' => null,
                'afternoon_schedule' => '15:00-17:00',
                'instructor_id' => 2,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Capoeira',
                'monthly_cost' => 25,
                'age_range' => '5+',
                'class_days' => 'Tuesday, Thursday',
                'morning_schedule' => null,
                'afternoon_schedule' => '17:00-18:30',
                'instructor_id' => 3,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Urban Dance',
                'monthly_cost' => 25,
                'age_range' => '5+',
                'class_days' => 'Monday, Wednesday',
                'morning_schedule' => null,
                'afternoon_schedule' => '16:00-17:30',
                'instructor_id' => 4,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Dance Theater',
                'monthly_cost' => 30,
                'age_range' => '10+',
                'class_days' => 'Monday, Wednesday',
                'morning_schedule' => null,
                'afternoon_schedule' => '15:00-16:30',
                'instructor_id' => 5,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Therapeutic Ballroom Dance',
                'monthly_cost' => 30,
                'age_range' => 'Adults',
                'class_days' => 'Tuesday, Thursday',
                'morning_schedule' => '8:00-9:00',
                'afternoon_schedule' => null,
                'instructor_id' => 6,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Theater',
                'monthly_cost' => 25,
                'age_range' => '12+',
                'class_days' => 'Tuesday, Thursday',
                'morning_schedule' => null,
                'afternoon_schedule' => '17:00-18:30',
                'instructor_id' => 7,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Acting for Film and TV',
                'monthly_cost' => 30,
                'age_range' => '7+',
                'class_days' => 'Wednesday, Friday',
                'morning_schedule' => null,
                'afternoon_schedule' => '17:00-18:30',
                'instructor_id' => 8,
                'location_id' => 1,
                'category_id' => 1
            ],
            // Music
            [
                'name' => 'Choir',
                'monthly_cost' => 30,
                'age_range' => '6+',
                'class_days' => 'Monday, Friday',
                'morning_schedule' => null,
                'afternoon_schedule' => '16:30-18:00',
                'instructor_id' => 9,
                'location_id' => 1,
                'category_id' => 2
            ],
            [
                'name' => 'Singing',
                'monthly_cost' => 30,
                'age_range' => '6+',
                'class_days' => 'Monday, Wednesday',
                'morning_schedule' => null,
                'afternoon_schedule' => '15:00-16:30',
                'instructor_id' => 10,
                'location_id' => 1,
                'category_id' => 2
            ],
            [
                'name' => 'Violin, Viola, Cello',
                'monthly_cost' => 30,
                'age_range' => '6+',
                'class_days' => 'Tuesday, Thursday',
                'morning_schedule' => null,
                'afternoon_schedule' => '15:00-16:30',
                'instructor_id' => 11,
                'location_id' => 1,
                'category_id' => 2
            ],
            [
                'name' => 'Specialized Violin',
                'monthly_cost' => 30,
                'age_range' => '6+',
                'class_days' => 'Monday, Wednesday',
                'morning_schedule' => null,
                'afternoon_schedule' => '16:30-18:00',
                'instructor_id' => 12,
                'location_id' => 1,
                'category_id' => 2
            ],
            [
                'name' => 'Popular Guitar',
                'monthly_cost' => 30,
                'age_range' => '6+',
                'class_days' => 'Tuesday, Thursday',
                'morning_schedule' => null,
                'afternoon_schedule' => '16:30-18:00',
                'instructor_id' => 13,
                'location_id' => 1,
                'category_id' => 2
            ],
            [
                'name' => 'Classical/Electric Guitar',
                'monthly_cost' => 30,
                'age_range' => '6+',
                'class_days' => 'Monday, Wednesday',
                'morning_schedule' => null,
                'afternoon_schedule' => '15:00-16:30',
                'instructor_id' => 14,
                'location_id' => 1,
                'category_id' => 2
            ],
            [
                'name' => 'Piano',
                'monthly_cost' => 30,
                'age_range' => '6+',
                'class_days' => 'Tuesday, Thursday',
                'morning_schedule' => null,
                'afternoon_schedule' => '15:00-16:30',
                'instructor_id' => 15,
                'location_id' => 1,
                'category_id' => 2
            ],
            [
                'name' => 'Accordion and Percussion',
                'monthly_cost' => 30,
                'age_range' => '6+',
                'class_days' => 'Monday, Wednesday',
                'morning_schedule' => null,
                'afternoon_schedule' => '16:30-18:00',
                'instructor_id' => 16,
                'location_id' => 1,
                'category_id' => 2
            ],
            [
                'name' => 'Drums',
                'monthly_cost' => 30,
                'age_range' => '6+',
                'class_days' => 'Tuesday, Thursday',
                'morning_schedule' => null,
                'afternoon_schedule' => '16:30-18:00',
                'instructor_id' => 17,
                'location_id' => 1,
                'category_id' => 2
            ],
            [
                'name' => 'Andean Instruments',
                'monthly_cost' => 30,
                'age_range' => '6+',
                'class_days' => 'Monday, Wednesday',
                'morning_schedule' => null,
                'afternoon_schedule' => '15:00-16:30',
                'instructor_id' => 18,
                'location_id' => 1,
                'category_id' => 2
            ],
            // Education, Arts and Technology
            [
                'name' => 'Theater for People with Disabilities',
                'monthly_cost' => 30,
                'age_range' => 'All ages',
                'class_days' => 'Tuesday, Thursday',
                'morning_schedule' => null,
                'afternoon_schedule' => '15:00-16:30',
                'instructor_id' => 19,
                'location_id' => 1,
                'category_id' => 3
            ],
            [
                'name' => 'Photography and Video',
                'monthly_cost' => 30,
                'age_range' => '12+',
                'class_days' => 'Monday, Wednesday',
                'morning_schedule' => null,
                'afternoon_schedule' => '15:00-16:30',
                'instructor_id' => 20,
                'location_id' => 1,
                'category_id' => 3
            ],
            [
                'name' => 'Artificial Intelligence',
                'monthly_cost' => 30,
                'age_range' => '12+',
                'class_days' => 'Tuesday, Thursday',
                'morning_schedule' => null,
                'afternoon_schedule' => '15:00-16:30',
                'instructor_id' => 21,
                'location_id' => 1,
                'category_id' => 3
            ],
            [
                'name' => 'Cinematography',
                'monthly_cost' => 30,
                'age_range' => '12+',
                'class_days' => 'Monday, Wednesday',
                'morning_schedule' => null,
                'afternoon_schedule' => '16:30-18:00',
                'instructor_id' => 22,
                'location_id' => 1,
                'category_id' => 3
            ],
            [
                'name' => 'Drawing',
                'monthly_cost' => 30,
                'age_range' => '6+',
                'class_days' => 'Tuesday, Thursday',
                'morning_schedule' => null,
                'afternoon_schedule' => '15:00-16:30',
                'instructor_id' => 23,
                'location_id' => 1,
                'category_id' => 3
            ],
            [
                'name' => 'Calligraphy',
                'monthly_cost' => 30,
                'age_range' => '6+',
                'class_days' => 'Monday, Wednesday',
                'morning_schedule' => null,
                'afternoon_schedule' => '16:30-18:00',
                'instructor_id' => 24,
                'location_id' => 1,
                'category_id' => 3
            ],
            [
                'name' => 'Declamation',
                'monthly_cost' => 30,
                'age_range' => '6+',
                'class_days' => 'Tuesday, Thursday',
                'morning_schedule' => null,
                'afternoon_schedule' => '16:30-18:00',
                'instructor_id' => 25,
                'location_id' => 1,
                'category_id' => 3
            ],
            [
                'name' => 'Creative Writing',
                'monthly_cost' => 30,
                'age_range' => '12+',
                'class_days' => 'Monday, Wednesday',
                'morning_schedule' => null,
                'afternoon_schedule' => '15:00-16:30',
                'instructor_id' => 26,
                'location_id' => 1,
                'category_id' => 3
            ],
            [
                'name' => 'Chess',
                'monthly_cost' => 30,
                'age_range' => '6+',
                'class_days' => 'Tuesday, Thursday',
                'morning_schedule' => null,
                'afternoon_schedule' => '15:00-16:30',
                'instructor_id' => 27,
                'location_id' => 1,
                'category_id' => 3
            ],
            [
                'name' => 'Introduction to Kichwa',
                'monthly_cost' => 30,
                'age_range' => 'All ages',
                'class_days' => 'Monday, Wednesday',
                'morning_schedule' => null,
                'afternoon_schedule' => '16:30-18:00',
                'instructor_id' => 28,
                'location_id' => 1,
                'category_id' => 3
            ],
        ];

        foreach ($workshops as $workshop) {
            Workshop::create($workshop);
        }
    }
}
