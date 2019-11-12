<?php

  use Illuminate\Support\Facades\Schema;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Database\Migrations\Migration;

  class CreateEnemiesTable extend Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('enemies', function(Blueprint $table) {
        $table->engine = 'InnoDB';

        $table->string('id');
        $table->string('name');
        $table->string('img');
        $table->json('points');
        $table->timestamps('created_at');
        $table->timestamps('updated_at');

        // indexes
        $table->primary('id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
      Schema::dropPrimary('id');
      Schema::drop('enemies');
    }
  }
