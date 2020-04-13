<?php

use App\Models\Agent;
use App\Models\Chamber;
use App\Models\Doctor;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AreaInfosTableSeeder::class,
            UsersTypeTableSeeder::class,
            SpecialistsTableSeeder::class,
        ]);

        $superUser = factory(User::class, 1)->create([
            'name' => 'Admin Admin',
            'email' => 'admin@argon.com',
            'user_type' => '1x101',
        ])->first();

        $organizationUsers = factory(User::class, 15)->create([
            'user_type' => '2x201',
        ]);


        $organizationUsers->each(function ($organizationUser) use ($superUser) {

            $organizations = factory(Organization::class, 1)->create([
                'user_id' => $organizationUser->id,
                'image' => '2323',
            ]);


            $organizations->each(function ($organization) use ($superUser) {

                $doctorUsers = factory(User::class, 20)->create([
                    'user_type' => '3x301',
                ]);


                $agentUsers = factory(User::class, 5)->create([
                    'user_type' => '5x501',
                ]);

                $agentUsers->each(function ($agentUser) use ($organization) {

                    factory(Agent::class, 1)->create([
                        'name' => $agentUser->name,
                        'user_id' => $agentUser->id,
                        'organization_id' => $organization->id,
                    ]);
                });

                $doctorUsers->each(function ($doctorUser) use ($organization) {

                    $chamber = factory(Chamber::class, 1)->create([
                        'organization_id' => $organization->id,
                    ])->first();

                    $doctor = factory(Doctor::class, 1)->create([
                        'name' => $doctorUser->name,
                        'user_id' => $doctorUser->id,
                        'organization_id' => $organization->id,
                    ])->first();

                    $doctor->chambers()->attach([$chamber->id]);
                });
            });
        });
    }
}
