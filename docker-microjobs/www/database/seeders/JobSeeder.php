<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $model = new Models\Job();
        $table = $model->getTable();
        $tablePrefix = $model->getConnection()->getTablePrefix();

        \DB::statement("LOCK TABLES {$tablePrefix}{$table} WRITE;");
        \DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        \DB::statement("TRUNCATE {$tablePrefix}{$table};");
        \DB::statement("INSERT INTO {$tablePrefix}{$table} VALUES (1,'Работа1',5.20,643,'RUB',1,3,NULL),(3,'Работа2',1.00,643,'RUB',2,3,5),(4,'Работа3',1.00,643,'RUB',1,3,NULL),(5,'Работа4',2.00,643,'RUB',1,3,NULL),(6,'Работа5',2.00,643,'RUB',1,5,NULL),(7,'Работа6',3.50,643,'RUB',2,5,3);");
        \DB::statement("SET FOREIGN_KEY_CHECKS=1;");
        \DB::statement("UNLOCK TABLES;");
    }
}
