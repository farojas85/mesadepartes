<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnEmailToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //$table->dropUnique('users_usuario_email_unique');
            //$table->dropColumn('usuario_email');
            $table->string('usuario_email')->nullable()->after('usuario_codigo')->change();
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
            //$table->dropColumn('usuario_email');
            $table->string('usuario_email')->after('usuario_codigo')->change();
        });
    }
}
