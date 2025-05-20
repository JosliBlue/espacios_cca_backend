<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Localizacion;
use App\Models\Instructor;
use App\Models\Taller;

class TalleresSeeder extends Seeder
{
    public function run()
    {
        // Seed categorias
        $categorias = [
            ['nombre' => 'Danza y Teatro'],
            ['nombre' => 'Música'],
            ['nombre' => 'Educación, Artes y Tecnología'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }

        // Seed localizaciones (assuming one location for all workshops)
        $localizacion = Localizacion::create(['nombre' => 'Casa de la Cultura']);

        // Seed instructores
        $instructores = [
            [
                'nombre' => 'Ballet Instructor',
                'contacto' => '0999515048'
            ],
            [
                'nombre' => 'Danza Folklórica Instructor',
                'contacto' => '0986304755'
            ],
            [
                'nombre' => 'Capoeira Instructor',
                'contacto' => '0984105293'
            ],
            [
                'nombre' => 'Danza Urbana Instructor',
                'contacto' => '0996492554'
            ],
            [
                'nombre' => 'Danza Teatro Instructor',
                'contacto' => '0995296551'
            ],
            [
                'nombre' => 'Baile de Salón Terapéutico Instructor',
                'contacto' => '0999515048'
            ],
            [
                'nombre' => 'Teatro Instructor',
                'contacto' => '0987952269'
            ],
            [
                'nombre' => 'Actuación para cine y TV Instructor',
                'contacto' => '0982892359'
            ],
            [
                'nombre' => 'Coro Instructor',
                'contacto' => '0985808781'
            ],
            [
                'nombre' => 'Canto Instructor',
                'contacto' => '0986760871'
            ],
            [
                'nombre' => 'Violín, Viola, Violonchelo Instructor',
                'contacto' => '0983087747'
            ],
            [
                'nombre' => 'Violín Especializado Instructor',
                'contacto' => '0999515048'
            ],
            [
                'nombre' => 'Guitarra Popular Instructor',
                'contacto' => '0986036074'
            ],
            [
                'nombre' => 'Guitarra Clásica/Eléctrica Instructor',
                'contacto' => '0989216465'
            ],
            [
                'nombre' => 'Piano Instructor',
                'contacto' => '0986295107'
            ],
            [
                'nombre' => 'Acordeón y Percusión Instructor',
                'contacto' => '0994418363'
            ],
            [
                'nombre' => 'Batería Instructor',
                'contacto' => '0986023796'
            ],
            [
                'nombre' => 'Instrumentos Andinos Instructor',
                'contacto' => '0999515048'
            ],
            [
                'nombre' => 'Teatro para personas con discapacidad Instructor',
                'contacto' => '0999515048'
            ],
            [
                'nombre' => 'Fotografía y Video Instructor',
                'contacto' => '0985331478'
            ],
            [
                'nombre' => 'Inteligencia Artificial Instructor',
                'contacto' => '0981137450'
            ],
            [
                'nombre' => 'Cinematografía Instructor',
                'contacto' => '0989492091'
            ],
            [
                'nombre' => 'Dibujo Instructor',
                'contacto' => '0986585565'
            ],
            [
                'nombre' => 'Caligrafía Instructor',
                'contacto' => '0985695836'
            ],
            [
                'nombre' => 'Declamación Instructor',
                'contacto' => '0988677885'
            ],
            [
                'nombre' => 'Escritura Creativa Instructor',
                'contacto' => '0998452636'
            ],
            [
                'nombre' => 'Ajedrez Instructor',
                'contacto' => '0998637647'
            ],
            [
                'nombre' => 'Introducción al Kichwa Instructor',
                'contacto' => '0984073983'
            ],
        ];

        foreach ($instructores as $instructor) {
            Instructor::create($instructor);
        }

        // Seed talleres
        $talleres = [
            // Danza y Teatro
            [
                'nombre' => 'Ballet (Baby, Pre, Inicial, Juvenil)',
                'costo_mensual' => 30,
                'edad' => 'desde 3 años',
                'dias_de_clase' => 'varios (según nivel)',
                'horario_maniana' => null,
                'horario_tarde' => null,
                'instructor_id' => 1,
                'lugar_id' => 1,
                'categoria_id' => 1
            ],
            [
                'nombre' => 'Danza Folklórica',
                'costo_mensual' => 30,
                'edad' => '5+',
                'dias_de_clase' => 'Martes, Jueves',
                'horario_maniana' => null,
                'horario_tarde' => '15:00-17:00',
                'instructor_id' => 2,
                'lugar_id' => 1,
                'categoria_id' => 1
            ],
            [
                'nombre' => 'Capoeira',
                'costo_mensual' => 25,
                'edad' => '5+',
                'dias_de_clase' => 'Martes, Jueves',
                'horario_maniana' => null,
                'horario_tarde' => '17:00-18:30',
                'instructor_id' => 3,
                'lugar_id' => 1,
                'categoria_id' => 1
            ],
            [
                'nombre' => 'Danza Urbana',
                'costo_mensual' => 25,
                'edad' => '5+',
                'dias_de_clase' => 'Lunes, Miércoles',
                'horario_maniana' => null,
                'horario_tarde' => '16:00-17:30',
                'instructor_id' => 4,
                'lugar_id' => 1,
                'categoria_id' => 1
            ],
            [
                'nombre' => 'Danza Teatro',
                'costo_mensual' => 30,
                'edad' => '10+',
                'dias_de_clase' => 'Lunes, Miércoles',
                'horario_maniana' => null,
                'horario_tarde' => '15:00-16:30',
                'instructor_id' => 5,
                'lugar_id' => 1,
                'categoria_id' => 1
            ],
            [
                'nombre' => 'Baile de Salón Terapéutico',
                'costo_mensual' => 30,
                'edad' => 'Adultos',
                'dias_de_clase' => 'Martes, Jueves',
                'horario_maniana' => '8:00-9:00',
                'horario_tarde' => null,
                'instructor_id' => 6,
                'lugar_id' => 1,
                'categoria_id' => 1
            ],
            [
                'nombre' => 'Teatro',
                'costo_mensual' => 25,
                'edad' => '12+',
                'dias_de_clase' => 'Martes, Jueves',
                'horario_maniana' => null,
                'horario_tarde' => '17:00-18:30',
                'instructor_id' => 7,
                'lugar_id' => 1,
                'categoria_id' => 1
            ],
            [
                'nombre' => 'Actuación para cine y TV',
                'costo_mensual' => 30,
                'edad' => '7+',
                'dias_de_clase' => 'Miércoles, Viernes',
                'horario_maniana' => null,
                'horario_tarde' => '17:00-18:30',
                'instructor_id' => 8,
                'lugar_id' => 1,
                'categoria_id' => 1
            ],
            // Música
            [
                'nombre' => 'Coro',
                'costo_mensual' => 30,
                'edad' => '6+',
                'dias_de_clase' => 'Lunes, Viernes',
                'horario_maniana' => null,
                'horario_tarde' => '16:30-18:00',
                'instructor_id' => 9,
                'lugar_id' => 1,
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Canto',
                'costo_mensual' => 30,
                'edad' => '5+',
                'dias_de_clase' => 'Lunes, Miércoles',
                'horario_maniana' => '9:00-11:00',
                'horario_tarde' => '14:00-17:00',
                'instructor_id' => 10,
                'lugar_id' => 1,
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Violín, Viola, Violonchelo',
                'costo_mensual' => 30,
                'edad' => '5+',
                'dias_de_clase' => 'Lunes, Miércoles',
                'horario_maniana' => null,
                'horario_tarde' => '14:00-17:00',
                'instructor_id' => 11,
                'lugar_id' => 1,
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Violín Especializado',
                'costo_mensual' => 60,
                'edad' => '10+',
                'dias_de_clase' => 'Lunes, Miércoles, Viernes, Sábado',
                'horario_maniana' => null,
                'horario_tarde' => null,
                'instructor_id' => 12,
                'lugar_id' => 1,
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Guitarra Popular',
                'costo_mensual' => 30,
                'edad' => '5+',
                'dias_de_clase' => 'Miércoles, Viernes',
                'horario_maniana' => null,
                'horario_tarde' => '15:00-17:00',
                'instructor_id' => 13,
                'lugar_id' => 1,
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Guitarra Clásica/Eléctrica',
                'costo_mensual' => 30,
                'edad' => '12+',
                'dias_de_clase' => 'Martes, Jueves',
                'horario_maniana' => null,
                'horario_tarde' => '16:00-18:00',
                'instructor_id' => 14,
                'lugar_id' => 1,
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Piano',
                'costo_mensual' => 30,
                'edad' => '5+',
                'dias_de_clase' => 'Martes, Jueves',
                'horario_maniana' => null,
                'horario_tarde' => '15:00-17:00',
                'instructor_id' => 15,
                'lugar_id' => 1,
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Acordeón y Percusión',
                'costo_mensual' => 25,
                'edad' => '12+',
                'dias_de_clase' => 'Lunes, Miércoles',
                'horario_maniana' => null,
                'horario_tarde' => '15:00-17:00',
                'instructor_id' => 16,
                'lugar_id' => 1,
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Batería',
                'costo_mensual' => 30,
                'edad' => '5+',
                'dias_de_clase' => 'Martes, Jueves',
                'horario_maniana' => null,
                'horario_tarde' => '16:15-18:00',
                'instructor_id' => 17,
                'lugar_id' => 1,
                'categoria_id' => 2
            ],
            [
                'nombre' => 'Instrumentos Andinos',
                'costo_mensual' => 30,
                'edad' => '5+',
                'dias_de_clase' => 'Lunes, Viernes',
                'horario_maniana' => null,
                'horario_tarde' => '15:00-17:00',
                'instructor_id' => 18,
                'lugar_id' => 1,
                'categoria_id' => 2
            ],
            // Educación, Artes y Tecnología
            [
                'nombre' => 'Teatro para personas con discapacidad',
                'costo_mensual' => 0,
                'edad' => 'todas',
                'dias_de_clase' => 'Lunes, Miércoles',
                'horario_maniana' => null,
                'horario_tarde' => '15:30-17:00',
                'instructor_id' => 19,
                'lugar_id' => 1,
                'categoria_id' => 3
            ],
            [
                'nombre' => 'Fotografía y Video (dispositivo móvil)',
                'costo_mensual' => 30,
                'edad' => '15+',
                'dias_de_clase' => 'Martes, Jueves',
                'horario_maniana' => null,
                'horario_tarde' => '15:00-17:00',
                'instructor_id' => 20,
                'lugar_id' => 1,
                'categoria_id' => 3
            ],
            [
                'nombre' => 'Inteligencia Artificial',
                'costo_mensual' => 25,
                'edad' => '12+',
                'dias_de_clase' => 'Martes, Jueves',
                'horario_maniana' => null,
                'horario_tarde' => '15:00-17:00',
                'instructor_id' => 21,
                'lugar_id' => 1,
                'categoria_id' => 3
            ],
            [
                'nombre' => 'Cinematografía',
                'costo_mensual' => 30,
                'edad' => '15+',
                'dias_de_clase' => 'Martes, Jueves',
                'horario_maniana' => null,
                'horario_tarde' => '15:00-17:00',
                'instructor_id' => 22,
                'lugar_id' => 1,
                'categoria_id' => 3
            ],
            [
                'nombre' => 'Dibujo',
                'costo_mensual' => 30,
                'edad' => '5+',
                'dias_de_clase' => 'Martes, Jueves',
                'horario_maniana' => null,
                'horario_tarde' => '15:00-17:00',
                'instructor_id' => 23,
                'lugar_id' => 1,
                'categoria_id' => 3
            ],
            [
                'nombre' => 'Caligrafía',
                'costo_mensual' => 25,
                'edad' => '5+',
                'dias_de_clase' => 'Lunes, Miércoles',
                'horario_maniana' => null,
                'horario_tarde' => '16:00-17:30',
                'instructor_id' => 24,
                'lugar_id' => 1,
                'categoria_id' => 3
            ],
            [
                'nombre' => 'Declamación',
                'costo_mensual' => 30,
                'edad' => '8+',
                'dias_de_clase' => 'Martes, Jueves',
                'horario_maniana' => null,
                'horario_tarde' => '15:00-16:30',
                'instructor_id' => 25,
                'lugar_id' => 1,
                'categoria_id' => 3
            ],
            [
                'nombre' => 'Escritura Creativa',
                'costo_mensual' => 30,
                'edad' => '12+',
                'dias_de_clase' => 'Martes, Jueves',
                'horario_maniana' => null,
                'horario_tarde' => '14:00-15:30',
                'instructor_id' => 26,
                'lugar_id' => 1,
                'categoria_id' => 3
            ],
            [
                'nombre' => 'Ajedrez',
                'costo_mensual' => 30,
                'edad' => '5+',
                'dias_de_clase' => 'Lunes, Sábados',
                'horario_maniana' => null,
                'horario_tarde' => '16:00-17:30',
                'instructor_id' => 27,
                'lugar_id' => 1,
                'categoria_id' => 3
            ],
            [
                'nombre' => 'Introducción al Kichwa',
                'costo_mensual' => 30,
                'edad' => '10+',
                'dias_de_clase' => 'Martes, Jueves',
                'horario_maniana' => null,
                'horario_tarde' => '16:30-18:00',
                'instructor_id' => 28,
                'lugar_id' => 1,
                'categoria_id' => 3
            ],
        ];

        foreach ($talleres as $taller) {
            Taller::create($taller);
        }
    }
}
