<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AwardsFakerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();


        $actorIds = range(3, 10);


        $actorsCount = $faker->numberBetween(1, 3);
        $selectedActorIds = $faker->randomElements($actorIds, $actorsCount);

        foreach ($selectedActorIds as $actorId) {
            DB::table('awards')->insert([
                'name' => $faker->name,
                'awardedOn' => $faker->date,
                'actor_id' => $actorId,
                "created_at" => now()->setTimezone("Europe/Madrid"),
            ]);
        }
    }
}
