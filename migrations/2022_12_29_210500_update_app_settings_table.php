<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->bigIncrements('id')->change();
            $table->longText('value')->nullable()->change();
            $table->string('description')->nullable();
            $table->string('type')->default('text');
            $table->string('validation_rules')->nullable();
            $table->string('options')->nullable();
            $table->string('group')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->increments('id')->change();
            $table->longText('value')->change();
            $table->dropColumn(['description', 'type', 'validation_rules', 'options', 'group']);
        });
    }
}
