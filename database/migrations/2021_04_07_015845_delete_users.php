<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('alamat');
            $table->dropColumn('gender');
            $table->dropColumn('bayaran_perjam');
            $table->dropColumn('umur');
            $table->dropColumn('pengalaman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('phone');
            $table->text('alamat');
            $table->integer('gender');
            $table->integer('bayaran_perjam');
            $table->integer('umur');
            $table->string('pengalaman');
        });
    }
}
