<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE auth.user(
                id              serial PRIMARY KEY,
                is_local        boolean DEFAULT FALSE,
                nik             text NOT NULL UNIQUE CHECK (nik <> ''),
                email           text NOT NULL UNIQUE CHECK (email <> ''),
                nama            text NOT NULL CHECK (nama <> ''),
                pass            text NOT NULL,
                remember_token  text,
                sso_cookie      text,
                permission      text NOT NULL DEFAULT ''
            );
        ");

        DB::statement("
            INSERT INTO 
              auth.user(is_local, nik, email, nama, pass, permission)
              VALUES(TRUE, '000000', 'master@tomman.info', 'App Master', 'telkomaksesmaster', '*:FULL')
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP TABLE auth.user');
    }
}
