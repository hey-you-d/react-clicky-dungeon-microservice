<?php

  use Illuminate\Support\Facades\Schema;
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Database\Migrations\Migration;

  class CreateDoorsTable extend Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
      Schema::create('doors', function(Blueprint $table) {
        $table->engine = 'InnoDB';

        $table->increment('db_id');
        $table->string('id');
        $table->string('img');
        $table->timestamps('created_at');
        $table->timestamps('updated_at');

        // indexes
        $table->primary('db_id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
      Schema::dropPrimary('db_id');
      Schema::drop('doors');
    }
  }
