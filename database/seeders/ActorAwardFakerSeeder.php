<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ActorAwardFakerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $awardIds = range(1, 10);
        $actorIds = range(1, 10);

        foreach ($awardIds as $award) {
            $actorsCount = $faker->numberBetween(1, 3);
            $selectedActorIds = $faker->randomElements($actorIds, $actorsCount);

            foreach ($selectedActorIds as $actorId) {
                DB::table('awards_actors')->insert([
                    'actor_id' => $actorId,
                    'award_id' => $award,
                    'awarded_at' => $faker->date(),
                    "created_at" => now()->setTimezone("Europe/Madrid"),
                ]);
            }
        }
    }
}
