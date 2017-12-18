<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdAndDescriptionFieldInNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function(Blueprint $table) {
            $table->text('description')->after('title');
            $table->integer('user_id')->unsigned()->after('description');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->integer('is_favourite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notes', function(Blueprint $table) {
           $table->dropColumn('description');
           $table->dropColumn('title');
        });
    }
}
