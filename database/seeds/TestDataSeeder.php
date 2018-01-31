<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Models\User;

class TestDataSeeder extends Seeder
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
        for ($i = 1; $i < 100; $i++) {
            $readers[] = User::create([
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'password' => $this->faker->password,
            ]);
        }
        for ($i = 1; $i < 10; $i++) {
            $writers[] = User::create([
                'name' => $this->faker->name,
                'email' => $this->faker->userName . "@gmail.com",
                'password' => $this->faker->password,
            ]);
        }
        foreach ($writers as $writer) {
            $writer->assignRole('writer');
            for ($i = 1; $i < rand(4, 8); $i++) {
                $book = $writer->books()->create([
                    'name' => $this->faker->sentence($nbWords = rand(2, 8), $variableNbWords = true),
                    'text' => $this->faker->text(500)
                ]);
                $books[$book->id] = $book->id;
            }
        }
        foreach ($readers as $reader) {
            $reader->assignRole('reader');
            $catalogs[] = $reader->catalogs()->create([
                'name' => $this->faker->sentence($nbWords = rand(1, 4), $variableNbWords = true),
            ]);
        }

        foreach ($catalogs as $catalog) {
            $catalog->books()->sync(array_rand($books, rand(4, 10)));
        }
    }
}
