<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['id' => 1, 'name' => 'Sin Asignar'],
            ['id' => 2, 'name' => 'Auditorio - Jorge Enrique Adown'],
            ['id' => 3, 'name' => 'Café - Hall Ana de Peralta'],
            ['id' => 4, 'name' => 'Terraza - Manuela Saenz'],
            ['id' => 5, 'name' => 'Museo'],
            ['id' => 6, 'name' => 'Sala Negra'],
            ['id' => 7, 'name' => 'Aula 1'],
            ['id' => 8, 'name' => 'Radio'],
            ['id' => 9, 'name' => 'Biblioteca'],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
