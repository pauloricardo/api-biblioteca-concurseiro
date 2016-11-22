<?php

/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 20:40
 */

use Illuminate\Database\Seeder;
class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        $user = app()->make('BibliotecaConcurseiro\Auth\User');
        $hasher = app()->make('hash');

        $user->fill([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => $hasher->make('1234')
        ]);
        $user->save();
    }

}