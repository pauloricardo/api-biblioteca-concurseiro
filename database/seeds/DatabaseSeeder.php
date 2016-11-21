<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call('CargoTableSeeder');
        $this->call('DisciplinaTableSeeder');
        $this->call('BancaTableSeeder');
        $this->call('OrgaoTableSeeder');
        $this->call('ConcursoTableSeeder');
        $this->call('QuestaoTableSeeder');
        $this->call('ProvaTableSeeder');
        $this->call('AssuntoTableSeeder');
        Model::reguard();
    }
}
