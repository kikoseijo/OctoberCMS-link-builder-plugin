<?php

namespace Ksoft\Links\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class create_categories_table extends Migration
{
    public function up()
    {
        Schema::create('ksoft_links_categories', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->index();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ksoft_links_categories');
    }
}
