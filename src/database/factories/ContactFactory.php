<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Category;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElement([1, 2, 3]),
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->numerify('#####'),
            'address' => $this->faker->address,
            'building' => $this->faker->optional()->secondaryAddress,
            'category_id' => Category::inRandomOrder()->first()->id ?? 1, // カテゴリが存在しない場合はデフォルト値
            'detail' => $this->faker->realText(100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}