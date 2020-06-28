<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table( 'users' )->insert( [
            
            'name'     => 'Injamamul Haque',
            'email'    => 'injam.bd.jsr@gmail.com',
            'password' => Hash::make( 'injam2015jsr' ),
            'is_admin' => true,
            'slug'     => 'injamamul-haque',
            'created_at'     => '2020-06-28 18:46:13',
        ] );
    }
}
