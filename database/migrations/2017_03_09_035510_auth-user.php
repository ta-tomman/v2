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
                nama            text NOT NULL CHECK (nama <> ''),
                pass            text NOT NULL,
                remember_token  text,
                sso_cookie      text,
                permission      text NOT NULL DEFAULT ''
            );
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
