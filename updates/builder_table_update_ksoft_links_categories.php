<?php

namespace Ksoft\Links\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class builder_table_update_ksoft_links_categories extends Migration
{
    public function up()
    {
        Schema::table('ksoft_links_categories', function ($table) {
            $table->integer('order')->nullable();
        });
    }

    public function down()
    {
        Schema::table('ksoft_links_categories', function ($table) {
            $table->dropColumn('order');
        });
    }
}
