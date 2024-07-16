<?php

// database/factories/UserFactory.php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // password
            'telefone' => $this->faker->phoneNumber,
            'idade' => $this->faker->date(),
            'bilhete' => Str::random(10),
            'nivel' => $this->faker->randomElement([1, 2, 3]),
            'remember_token' => Str::random(10),
        ];
    }
}
