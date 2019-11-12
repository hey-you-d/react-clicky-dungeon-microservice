<?php

  use Illuminate\Support\Facades\Schema;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Database\Migrations\Migration;

  class CreateAreasTable extend Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('areas', function(Blueprint $table) {
        $table->engine = 'InnoDB';

        $table->string('id');
        $table->string('next_area_id');
        $table->json('area_map');
        $table->json('area_enemies');
        $table->json('area_items');
        $table->json('area_equipments');
        $table->json('area_doors');
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
      Schema::drop('CreateAreasTable');
    }
  }
