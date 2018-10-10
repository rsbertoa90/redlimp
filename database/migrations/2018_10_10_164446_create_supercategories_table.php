<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupercategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supercategories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->nullable();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->text('homedescription')->nullable();

            $table->text('metatitle')->nullable();
            $table->text('metadescription')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('image')->default('/storage/images/app/no-image.png');
            $table->softDeletes();
            $table->timestamps();
        });

         DB::table('supercategories')->insert(
        array(
            'name' => 'limpieza'
        )
        );
         DB::table('supercategories')->insert(
        array(
            'name' => 'bazar'
        )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supercategories');
    }
}
