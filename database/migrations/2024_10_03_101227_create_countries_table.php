<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id(); // Kolom 'id' dengan auto-increment
            $table->string('code')->unique(); // Kolom 'code' yang unik
            $table->string('name'); // Kolom 'name'
            $table->string('phonecode'); // Kolom 'phonecode'
            $table->timestamps(); // Kolom 'created_at' dan 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries'); // Menghapus tabel jika rollback
    }
}
