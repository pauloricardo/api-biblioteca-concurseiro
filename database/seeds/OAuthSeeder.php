<?php

/**
 * Created by PhpStorm.
 * User: paulo
 * Date: 08/10/2016
 * Time: 20:40
 */

use Illuminate\Database\Seeder;
class OAuthSeeder extends Seeder
{
    public function run()
    {
        $config = app()->make('config');

        DB::table("oauth_clients")->delete();

        DB::table("oauth_clients")->insert([
            'id' => $config->get('secrets.client_id'),
            'secret' => $config->get('secrets.client_secret'),
            'name' => 'App'
        ]);

    }

}