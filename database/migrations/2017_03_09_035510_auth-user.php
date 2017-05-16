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
                login           text NOT NULL UNIQUE CHECK (login <> ''),
                type            smallint NOT NULL DEFAULT 0,
                nama            text NOT NULL CHECK (nama <> ''),
                pass            text NOT NULL,
                remember_token  text,
                sso_cookie      text,
                permission      text NOT NULL DEFAULT ''
            );
        ");

        DB::statement("
            INSERT INTO 
              auth.user(is_local, login, nama, pass, permission)
              VALUES(TRUE, 'master', 'App Master', 'telkomaksesmaster', '*:FULL')
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
