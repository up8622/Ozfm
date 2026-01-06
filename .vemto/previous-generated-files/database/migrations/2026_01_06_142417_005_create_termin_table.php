<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('termin', function (Blueprint $table) {
            $table->id();

            $table->dateTime('vreme');

            $table->bigInteger('pacijent_id');

            $table->bigInteger('terapeut_id');

            $table->bigInteger('usluga_id');

            $table->timestamp('created_at')->nullable();

            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('termin');
    }
};
