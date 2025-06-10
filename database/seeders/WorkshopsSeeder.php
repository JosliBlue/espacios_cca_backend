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
        $location = Location::create(['name' => 'space reservation']);

        // Seed instructors
        $instructors = [
            ['id' => 1, 'name' => 'Andrea Mora', 'contact' => '0995883096', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 2, 'name' => 'Juan Rosero', 'contact' => '0995915048', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 3, 'name' => 'Paulo Jurado', 'contact' => '0996492554', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 4, 'name' => 'Juan Muñoz', 'contact' => '0987420305', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 5, 'name' => 'Valeria Brito', 'contact' => '0999906927', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 6, 'name' => 'Rodrigo Herrera', 'contact' => '0984587081', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 7, 'name' => 'Fanny Ramon', 'contact' => '0998006634', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 8, 'name' => 'Estefanía Avilés', 'contact' => '0983087047', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 9, 'name' => 'Christian Cedeño', 'contact' => '0960478650', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 10, 'name' => 'Carlos Landa', 'contact' => '0992900763', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 11, 'name' => 'Diego Navarrete', 'contact' => '0984055459', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 12, 'name' => 'Antonio Lozada', 'contact' => '0998515616', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 13, 'name' => 'Juan Cristancho', 'contact' => '0984714368', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 14, 'name' => 'Jarry Moya', 'contact' => '0981421125', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 15, 'name' => 'Alexander Campoverde', 'contact' => '0958955916', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 16, 'name' => 'Augusto Días', 'contact' => '0998286429', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 17, 'name' => 'Jaime Echeverría', 'contact' => '0983134748', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 18, 'name' => 'William Sánchez', 'contact' => '0995934528', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 19, 'name' => 'Leonardo Brito', 'contact' => '0987434245', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 20, 'name' => 'Alisson Sánchez', 'contact' => '0994855655', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 21, 'name' => 'Luis Quesada', 'contact' => '0999233895', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 22, 'name' => 'Margoth Catuta', 'contact' => '0995979739', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 23, 'name' => 'Rodrigo Jurado', 'contact' => '0962797469', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 24, 'name' => 'Cesar Viera', 'contact' => '0998702688', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
            ['id' => 25, 'name' => 'Kusi Masaquiza', 'contact' => '0994377739', 'created_at' => '2025-05-27 20:23:04', 'updated_at' => '2025-05-27 20:23:04'],
        ];

        foreach ($instructors as $instructor) {
            Instructor::create($instructor);
        }

        // Seed workshops
        $workshops = [
            [
                'name' => 'Baby Ballet',
                'monthly_cost' => 30,
                'age_range' => '1; 3 a 4; 5 a 6',
                'instructor_id' => 1,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Pre Ballet',
                'monthly_cost' => 30,
                'age_range' => '7 a 9',
                'instructor_id' => 1,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Ballet Inicial',
                'monthly_cost' => 30,
                'age_range' => '10+',
                'instructor_id' => 1,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Ballet Inicial Juvenil',
                'monthly_cost' => 30,
                'age_range' => '16+',
                'instructor_id' => 1,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Danza Folklorica',
                'monthly_cost' => 30,
                'age_range' => '5+',
                'instructor_id' => 2,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Capoeira',
                'monthly_cost' => 25,
                'age_range' => '5+',
                'instructor_id' => 3,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Danza Urbana',
                'monthly_cost' => 25,
                'age_range' => '12+',
                'instructor_id' => 4,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Danza Teatro',
                'monthly_cost' => 30,
                'age_range' => '8 a 16',
                'instructor_id' => 5,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Baile de Salón Terapéutico',
                'monthly_cost' => 25,
                'age_range' => '60+',
                'instructor_id' => 1,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Coro',
                'monthly_cost' => 30,
                'age_range' => '6 a 18',
                'instructor_id' => 6,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Canto',
                'monthly_cost' => 30,
                'age_range' => '5+',
                'instructor_id' => 7,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Violín, Viola y Violonchelo',
                'monthly_cost' => 30,
                'age_range' => '5+',
                'instructor_id' => 8,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Violín Especializado',
                'monthly_cost' => 60,
                'age_range' => '5+',
                'instructor_id' => 9,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Guitarra Popular',
                'monthly_cost' => 30,
                'age_range' => '5+',
                'instructor_id' => 10,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Guitarra Clásica - Eléctrica',
                'monthly_cost' => 30,
                'age_range' => '12+',
                'instructor_id' => 11,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Piano',
                'monthly_cost' => 40,
                'age_range' => '9+',
                'instructor_id' => 12,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Acordeón y Percusión',
                'monthly_cost' => 25,
                'age_range' => '12+',
                'instructor_id' => 13,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Batería',
                'monthly_cost' => 30,
                'age_range' => '5+',
                'instructor_id' => 14,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'instrumentos Andinos',
                'monthly_cost' => 30,
                'age_range' => '5+',
                'instructor_id' => 2,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Teatro para Personas con Discapacidad',
                'monthly_cost' => 15,
                'age_range' => '12+',
                'instructor_id' => 15,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Teatro',
                'monthly_cost' => 25,
                'age_range' => '15+',
                'instructor_id' => 15,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Actuación para Cine y TV',
                'monthly_cost' => 30,
                'age_range' => '7+',
                'instructor_id' => 16,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Fotografía y Video (Dispositivo Móvil)',
                'monthly_cost' => 30,
                'age_range' => '15 a 25',
                'instructor_id' => 17,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Inteligencia Artificial',
                'monthly_cost' => 30,
                'age_range' => '13+',
                'instructor_id' => 18,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Comunicación y Marketing Digital para Artistas y Emprendedores',
                'monthly_cost' => 30,
                'age_range' => '15+',
                'instructor_id' => 19,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Dibujo',
                'monthly_cost' => 30,
                'age_range' => '5+',
                'instructor_id' => 20,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Caligrafía',
                'monthly_cost' => 30,
                'age_range' => '9+',
                'instructor_id' => 21,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Declamación',
                'monthly_cost' => 30,
                'age_range' => '8+',
                'instructor_id' => 22,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Escritura Creativa',
                'monthly_cost' => 30,
                'age_range' => '12+',
                'instructor_id' => 23,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Ajedrez',
                'monthly_cost' => 30,
                'age_range' => '5+',
                'instructor_id' => 24,
                'location_id' => 1,
                'category_id' => 1
            ],
            [
                'name' => 'Introducción al Kichwa',
                'monthly_cost' => 30,
                'age_range' => '10+',
                'instructor_id' => 25,
                'location_id' => 1,
                'category_id' => 1
            ]
        ];

        foreach ($workshops as $workshop) {
            Workshop::create($workshop);
        }
    }
}
