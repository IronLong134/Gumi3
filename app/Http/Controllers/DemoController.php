<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class DemoController extends Controller
{
    //
    public function testconnect()
    {
        try {
            DB::connection()->getPdo();
            if (DB::connection()->getDatabaseName()) {
                echo 'Yes! Successfully connected to the DB: '.DB::connection()->getDatabaseName();
            } else {
                die('Could not find the database. Please check your configuration.');
            }
        } catch (\Exception $e) {
            die('Could not open connection to database server.  Please check your configuration.');
        }
    }
    /**
     * @param Request $request
     */
    public function admin(Request $request)
    {
        $user1 = Auth::user();
        $user = User::all();
        return view('admin')->with('user', $user)->with('user1', $user1);
    }
    public function load()
    {
        $user = Auth::user();
        dd($user);
    }

}