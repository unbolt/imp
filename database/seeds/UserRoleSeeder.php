<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add the admin role to the database
	DB::table('roles')->insert([
		'name' => 'admin',
		'display_name' => 'Administrator',
		'description' => 'Site Administrator - Does what they want, where they want.'
	]);
    }
}
