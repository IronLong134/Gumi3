<?php

use Illuminate\Database\Seeder;

class masterDataTable extends Seeder
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
        DB::table('masterdata')->truncate();
    
        $masterdatas = [
            [0, 0, 'O',0],
            [0, 1, 'A',1],
            [0, 2, 'B',2],
            [0, 3, 'AB',3],
						[1,0,'Tài khoản giả mạo',0],
						[1,0,'Spam',0]
        ];
    
        foreach ($masterdatas as $masterdata) {
            DB::table('masterdata')->insert([
                                           'kind' => $masterdata[0],
                                           'value' => $masterdata[1],
                                           'name' => $masterdata[2],
                                           'order' => $masterdata[3]
                                       ]);
        }
    
        Schema::enableForeignKeyConstraints();
        
    }
}
