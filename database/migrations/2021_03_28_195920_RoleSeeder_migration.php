<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class RoleSeederMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call( 'db:seed', [
            '--class' => 'PermissionSeeder',
            '--force' => true ]
        );
        Artisan::call( 'db:seed', [
            '--class' => 'RoleSeeder',
            '--force' => true ]
        );
    }

}
