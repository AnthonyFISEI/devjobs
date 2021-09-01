<?php

use App\Ubicacion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // Llamar al seed

        $this->call(UsuarioSeed::class);
        $this->call(CategoriaSeed::class);
        $this->call(ExperienciaSeeder::class);
        $this->call(UbicacionSeeder::class);
        $this->call(SalarioSeeder::class);
    }
}
