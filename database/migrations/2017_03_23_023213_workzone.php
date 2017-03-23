<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Workgroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE workzone(
              id SMALLSERIAL PRIMARY KEY,
              nama TEXT NOT NULL UNIQUE CHECK (nama <> ''),
              path LTREE
            )
        ");

        DB::statement("CREATE INDEX ON workzone USING GIST(path)");
        DB::statement("CREATE INDEX ON workzone USING btree(path)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP TABLE workzone');
    }
}
