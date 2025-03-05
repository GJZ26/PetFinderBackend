<?php

namespace App\Console\Commands;

use App\Models\Location;
use Illuminate\Console\Command;

class SeedLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ruta al archivo JSON en storage
        $path = storage_path('data/municipios.json');

        // Verificar si el archivo existe
        if (!file_exists($path)) {
            $this->error("El archivo municipios.json no existe.");
            return;
        }

        // Leer y decodificar el archivo JSON
        $json = file_get_contents($path);
        $municipios = json_decode($json, true);

        // Verificar si la decodificación fue exitosa
        if ($municipios === null) {
            $this->error("Error al decodificar el JSON.");
            return;
        }

        // Insertar cada municipio en la base de datos
        foreach ($municipios as $municipio) {
            Location::create([
                'id' => $municipio['clave'],
                'name' => $municipio['nombre'],
            ]);
        }

        $this->info("Municipios importados correctamente.");
    }
}
