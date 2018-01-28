<?php

use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * @var Factory
     */
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create('ru_Ru');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $andrew = User::firstOrCreate([
            'name' => 'Andrew',
            'email' => 'andrewnovikofff@gmail.com',
            'password' => 'Q1w2R34E!!!'
        ]);

        $andrew->assignRole('admin');
    }
}
