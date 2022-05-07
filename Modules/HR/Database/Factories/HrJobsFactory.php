<?php

namespace Modules\HR\Database\Factories;

use Faker\Factory as Faker;
use Modules\HR\Entities\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class HrJobsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();

        return [
            'domain' => array_rand(config('hr.opportunities.domains')),
            'status' => array_rand(array_keys(config('hr.opportunities-status'))),
            'type' => config('hr.opportunities.job.type'),
            'title' => $faker->jobTitle,
        ];
    }
}
