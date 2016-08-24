<?php

class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();
        
        foreach(range(1,5)as $index)
        {
            User::create([
                'name'=>$faker->username,
                'email'=>$faker->email,
                'password'=>Hash::make('secret')
            ]);
        }
	}

}
