<?php

use Illuminate\Database\Seeder;

class TruncateTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        DB::table('posts')->truncate();
        DB::table('likes')->truncate();
        DB::table('comments')->truncate();
        DB::table('friends')->truncate();
        Schema::enableForeignKeyConstraints();
    }
}
