<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        App\User::create( [
            'name'     => 'Injamamul Haque',
            'email'    => 'injam.bd.jsr@gmail.com',
            'password' => Hash::make( 'injam12345' ),
            'is_admin' => true,
            'slug'     => 'injamamul-haque',
        ] );
    }
}
