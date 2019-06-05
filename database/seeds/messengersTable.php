<?php

use Illuminate\Database\Seeder;

class messengersTable extends Seeder
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
	    DB::table('messengers')->truncate();
	
	    $messengers = [
			    [1,2,'hello bạn'],
			    [1, 2, 'tớ tên long'],
			    [2, 1, 'chào cậu'],
			    [1, 2, 'bạn tên gì'],
	    ];
	
	    foreach ($messengers as $messenger) {
		    DB::table('messengers')->insert([
				                                    'sender_id' => $messenger[0],
				                                    'receiver_id' => $messenger[1],
				                                    'content' => $messenger[2]
				                                   
		                                    ]);
	    }
	
	    Schema::enableForeignKeyConstraints();
    }
}
