<?php

namespace Ksoft\Links\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateItemsTable extends Migration {

    public function up() {
        Schema::create('ksoft_links_items', function($table) {
            $table->increments('id')->unsigned();
            $table->boolean('enabled'   )->default(1);
            $table->integer('category_id')->unsigned()->index();
            $table->string('title' ,  50)->nullable();
            $table->string('slug')->index();
            $table->string('image' ,  50)->nullable();
            $table->string('phone' ,  50)->nullable();
            $table->string('link'  , 250)->nullable();
            $table->string('target',  10)->nullable();
            $table->integer('order'     )->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::drop('ksoft_links_items');
    }

}
