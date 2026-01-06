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
        Schema::create('pacijent', function (Blueprint $table) {
            $table->id();

            $table->string('ime');

            $table->string('prezime');

            $table->integer('godina_rodjenja');

            $table->string('broj_telefona');

            $table->string('password_hash');

            $table->string('username');

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
        Schema::dropIfExists('pacijent');
    }
};
