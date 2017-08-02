<?php namespace Ksoft\Links\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateKsoftLinksCategories extends Migration
{
    public function up()
    {
        Schema::table('ksoft_links_categories', function($table)
        {
            $table->integer('order')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('ksoft_links_categories', function($table)
        {
            $table->dropColumn('order');
        });
    }
}
