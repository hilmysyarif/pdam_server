<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable($value = true);
            $table->string('bulan');
            $table->string('tahun');
            $table->string('jumlah_pemakaian');
            $table->string('foto_meteran');
            $table->string('total_bayar');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('beritas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->nullable($value = true);
            $table->text('content');
            $table->string('judul');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('histories');
      Schema::dropIfExists('categories');
      Schema::dropIfExists('beritas');
    }
}
