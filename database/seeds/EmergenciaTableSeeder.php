<?php

use Illuminate\Database\Seeder;
use iobom\Models\Emergencia\Emergencia;

class EmergenciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            'ATENCION PREHOSPITALARIA',
            'CONTRA INCENDIO',
            'FALSA ALARMA',
            'RESCATE',
            'DESASTRES'
        );

        foreach ($data as $nombre) {
            Emergencia::firstOrCreate([
                'nombre' => $nombre,
            ]);
        }
    }
}
