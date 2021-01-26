<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_types', function (Blueprint $table) {
            DB::table('user_types')->insert(
                array(
                    'description' => 'Member',
                ),
            );
            DB::table('user_types')->insert(
                array(
                    'description' => 'Bronze Member',
                ),
            );
            DB::table('user_types')->insert(
                array(
                    'description' => 'Silver Member',
                ),
            );
            DB::table('user_types')->insert(
                array(
                    'description' => 'Gold Member',
                ),
            );
            DB::table('user_types')->insert(
                array(
                    'description' => 'Developer',
                ),
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_types', function (Blueprint $table) {
            //
        });
    }
}
