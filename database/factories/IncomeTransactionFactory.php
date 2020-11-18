<?php

namespace Database\Factories;

use App\Models\IncomeTransaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IncomeTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'nominal' => $this->faker->randomNumber(6),
            'created_by' => User::factory(),
            'modified_by' => User::factory(),
        ];
    }
}
