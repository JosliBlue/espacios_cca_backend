<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkshopSchedule;

class WorkshopSchedulesSeeder extends Seeder
{
    public function run()
    {
        $schedules = [
            // Pre Ballet (ID: 2)
            ['day_of_week' => 'Martes', 'start_time' => '16:00:00', 'end_time' => '17:00:00', 'workshop_id' => 2],
            ['day_of_week' => 'Jueves', 'start_time' => '16:00:00', 'end_time' => '17:00:00', 'workshop_id' => 2],
            ['day_of_week' => 'Sábado', 'start_time' => '09:00:00', 'end_time' => '10:00:00', 'workshop_id' => 2],

            // Ballet Inicial (ID: 3)
            ['day_of_week' => 'Martes', 'start_time' => '17:00:00', 'end_time' => '18:30:00', 'workshop_id' => 3],
            ['day_of_week' => 'Jueves', 'start_time' => '17:00:00', 'end_time' => '18:30:00', 'workshop_id' => 3],
            ['day_of_week' => 'Sábado', 'start_time' => '10:00:00', 'end_time' => '11:30:00', 'workshop_id' => 3],

            // Ballet Inicial Juvenil (ID: 4)
            ['day_of_week' => 'Martes', 'start_time' => '18:30:00', 'end_time' => '20:00:00', 'workshop_id' => 4],
            ['day_of_week' => 'Jueves', 'start_time' => '18:30:00', 'end_time' => '20:00:00', 'workshop_id' => 4],
            ['day_of_week' => 'Sábado', 'start_time' => '08:00:00', 'end_time' => '09:00:00', 'workshop_id' => 4],

            // Danza Folklorica (ID: 5)
            ['day_of_week' => 'Martes', 'start_time' => '17:00:00', 'end_time' => '19:00:00', 'workshop_id' => 5],
            ['day_of_week' => 'Viernes', 'start_time' => '17:00:00', 'end_time' => '19:00:00', 'workshop_id' => 5],

            // Capoeira (ID: 6)
            ['day_of_week' => 'Martes', 'start_time' => '17:30:00', 'end_time' => '18:30:00', 'workshop_id' => 6],
            ['day_of_week' => 'Jueves', 'start_time' => '17:30:00', 'end_time' => '18:30:00', 'workshop_id' => 6],

            // Danza Urbana (ID: 7)
            ['day_of_week' => 'Lunes', 'start_time' => '16:00:00', 'end_time' => '17:30:00', 'workshop_id' => 7],
            ['day_of_week' => 'Miércoles', 'start_time' => '16:00:00', 'end_time' => '17:30:00', 'workshop_id' => 7],

            // Danza Teatro (ID: 8)
            ['day_of_week' => 'Lunes', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 8],
            ['day_of_week' => 'Miércoles', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 8],

            // Baile de Salón Terapéutico (ID: 9)
            ['day_of_week' => 'Martes', 'start_time' => '08:00:00', 'end_time' => '09:00:00', 'workshop_id' => 9],
            ['day_of_week' => 'Viernes', 'start_time' => '08:00:00', 'end_time' => '09:00:00', 'workshop_id' => 9],

            // Coro (ID: 10)
            ['day_of_week' => 'Lunes', 'start_time' => '16:30:00', 'end_time' => '18:00:00', 'workshop_id' => 10],
            ['day_of_week' => 'Viernes', 'start_time' => '16:30:00', 'end_time' => '18:00:00', 'workshop_id' => 10],

            // Canto (ID: 11)
            ['day_of_week' => 'Lunes', 'start_time' => '09:00:00', 'end_time' => '10:00:00', 'workshop_id' => 11],
            ['day_of_week' => 'Miércoles', 'start_time' => '09:00:00', 'end_time' => '10:00:00', 'workshop_id' => 11],
            ['day_of_week' => 'Lunes', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 11],
            ['day_of_week' => 'Miércoles', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 11],

            // Violín, Viola y Violonchelo (ID: 12)
            ['day_of_week' => 'Lunes', 'start_time' => '14:00:00', 'end_time' => '17:00:00', 'workshop_id' => 12],
            ['day_of_week' => 'Miércoles', 'start_time' => '14:00:00', 'end_time' => '17:00:00', 'workshop_id' => 12],

            // Violín Especializado (ID: 13)
            ['day_of_week' => 'Lunes', 'start_time' => '10:00:00', 'end_time' => '11:00:00', 'workshop_id' => 13],
            ['day_of_week' => 'Miércoles', 'start_time' => '10:00:00', 'end_time' => '11:00:00', 'workshop_id' => 13],
            ['day_of_week' => 'Viernes', 'start_time' => '10:00:00', 'end_time' => '11:00:00', 'workshop_id' => 13],
            ['day_of_week' => 'Lunes', 'start_time' => '11:00:00', 'end_time' => '12:00:00', 'workshop_id' => 13],
            ['day_of_week' => 'Miércoles', 'start_time' => '11:00:00', 'end_time' => '12:00:00', 'workshop_id' => 13],
            ['day_of_week' => 'Viernes', 'start_time' => '11:00:00', 'end_time' => '12:00:00', 'workshop_id' => 13],
            ['day_of_week' => 'Lunes', 'start_time' => '15:00:00', 'end_time' => '16:00:00', 'workshop_id' => 13],
            ['day_of_week' => 'Miércoles', 'start_time' => '15:00:00', 'end_time' => '16:00:00', 'workshop_id' => 13],
            ['day_of_week' => 'Viernes', 'start_time' => '15:00:00', 'end_time' => '16:00:00', 'workshop_id' => 13],
            ['day_of_week' => 'Lunes', 'start_time' => '16:00:00', 'end_time' => '17:00:00', 'workshop_id' => 13],
            ['day_of_week' => 'Miércoles', 'start_time' => '16:00:00', 'end_time' => '17:00:00', 'workshop_id' => 13],
            ['day_of_week' => 'Viernes', 'start_time' => '16:00:00', 'end_time' => '17:00:00', 'workshop_id' => 13],
            ['day_of_week' => 'Sábado', 'start_time' => '10:00:00', 'end_time' => '12:00:00', 'workshop_id' => 13],

            // Guitarra Popular (ID: 14)
            ['day_of_week' => 'Lunes', 'start_time' => '10:00:00', 'end_time' => '12:00:00', 'workshop_id' => 14],
            ['day_of_week' => 'Miércoles', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 14],
            ['day_of_week' => 'Viernes', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 14],

            // Guitarra Clásica - Eléctrica (ID: 15)
            ['day_of_week' => 'Martes', 'start_time' => '16:30:00', 'end_time' => '18:30:00', 'workshop_id' => 15],
            ['day_of_week' => 'Jueves', 'start_time' => '16:30:00', 'end_time' => '18:30:00', 'workshop_id' => 15],

            // Piano (ID: 16)
            ['day_of_week' => 'Martes', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 16],
            ['day_of_week' => 'Jueves', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 16],

            // Acordeón y Percusión (ID: 17)
            ['day_of_week' => 'Lunes', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 17],
            ['day_of_week' => 'Miércoles', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 17],

            // Batería (ID: 18)
            ['day_of_week' => 'Martes', 'start_time' => '16:15:00', 'end_time' => '18:00:00', 'workshop_id' => 18],
            ['day_of_week' => 'Jueves', 'start_time' => '16:15:00', 'end_time' => '18:00:00', 'workshop_id' => 18],

            // instrumentos Andinos (ID: 19)
            ['day_of_week' => 'Lunes', 'start_time' => '15:00:00', 'end_time' => '17:00:00', 'workshop_id' => 19],
            ['day_of_week' => 'Viernes', 'start_time' => '15:00:00', 'end_time' => '17:00:00', 'workshop_id' => 19],

            // Teatro para Personas con Discapacidad (ID: 20)
            ['day_of_week' => 'Martes', 'start_time' => '16:00:00', 'end_time' => '18:00:00', 'workshop_id' => 20],
            ['day_of_week' => 'Viernes', 'start_time' => '16:00:00', 'end_time' => '18:00:00', 'workshop_id' => 20],

            // Teatro (ID: 21)
            ['day_of_week' => 'Lunes', 'start_time' => '17:00:00', 'end_time' => '18:30:00', 'workshop_id' => 21],
            ['day_of_week' => 'Viernes', 'start_time' => '18:00:00', 'end_time' => '19:30:00', 'workshop_id' => 21],

            // Actuación para Cine y TV (ID: 22)
            ['day_of_week' => 'Miércoles', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 22],
            ['day_of_week' => 'Viernes', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 22],

            // Fotografía y Video (ID: 23)
            ['day_of_week' => 'Martes', 'start_time' => '14:00:00', 'end_time' => '16:00:00', 'workshop_id' => 23],
            ['day_of_week' => 'Jueves', 'start_time' => '14:00:00', 'end_time' => '16:00:00', 'workshop_id' => 23],

            // Inteligencia Artificial (ID: 24)
            ['day_of_week' => 'Miércoles', 'start_time' => '16:30:00', 'end_time' => '18:00:00', 'workshop_id' => 24],
            ['day_of_week' => 'Viernes', 'start_time' => '16:30:00', 'end_time' => '18:00:00', 'workshop_id' => 24],

            // Comunicación y Marketing Digital (ID: 25)
            ['day_of_week' => 'Martes', 'start_time' => '19:00:00', 'end_time' => '21:00:00', 'workshop_id' => 25],
            ['day_of_week' => 'Jueves', 'start_time' => '19:00:00', 'end_time' => '21:00:00', 'workshop_id' => 25],

            // Dibujo (ID: 26)
            ['day_of_week' => 'Martes', 'start_time' => '16:30:00', 'end_time' => '17:30:00', 'workshop_id' => 26],
            ['day_of_week' => 'Jueves', 'start_time' => '16:30:00', 'end_time' => '17:30:00', 'workshop_id' => 26],

            // Caligrafía (ID: 27)
            ['day_of_week' => 'Lunes', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 27],
            ['day_of_week' => 'Miércoles', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 27],

            // Declamación (ID: 28)
            ['day_of_week' => 'Martes', 'start_time' => '14:15:00', 'end_time' => '16:15:00', 'workshop_id' => 28],
            ['day_of_week' => 'Jueves', 'start_time' => '14:15:00', 'end_time' => '16:15:00', 'workshop_id' => 28],

            // Escritura Creativa (ID: 29)
            ['day_of_week' => 'Martes', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 29],
            ['day_of_week' => 'Jueves', 'start_time' => '15:00:00', 'end_time' => '16:30:00', 'workshop_id' => 29],

            // Ajedrez (ID: 30)
            ['day_of_week' => 'Lunes', 'start_time' => '15:00:00', 'end_time' => '17:00:00', 'workshop_id' => 30],
            ['day_of_week' => 'Miércoles', 'start_time' => '15:00:00', 'end_time' => '17:00:00', 'workshop_id' => 30],

            // Introducción al Kichwa (ID: 31)
            ['day_of_week' => 'Martes', 'start_time' => '16:30:00', 'end_time' => '18:00:00', 'workshop_id' => 31],
            ['day_of_week' => 'Jueves', 'start_time' => '16:30:00', 'end_time' => '18:00:00', 'workshop_id' => 31],
        ];

        foreach ($schedules as $schedule) {
            WorkshopSchedule::create($schedule);
        }
    }
}
