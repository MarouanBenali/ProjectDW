<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTechHorizonsDatabase extends Migration
{
    public function up()
    {
        DB::statement('CREATE DATABASE IF NOT EXISTS tech_horizons');
    }

    public function down()
    {
        DB::statement('DROP DATABASE IF EXISTS tech_horizons');
    }
}
