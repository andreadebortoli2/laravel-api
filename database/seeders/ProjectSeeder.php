<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        for ($i = 0; $i < 20; $i++) {

            $project = new Project();
            $project->title = $faker->sentence();
            $project->slug = Str::of($project->title)->slug('-');
            $project->type_id = Type::all()->random()->id;
            $project->source_code_url = $faker->url();
            $project->production_site_url = $faker->url();
            $project->description = $faker->text();
            $project->image = $faker->imageUrl(700, 550, null, true, null, false, 'png');
            $project->save();
        }

        $technologies_array = range(1, 8);

        foreach (Project::all() as $project) {
            $project->technologies()->attach($faker->randomElements($technologies_array, null));
        }
    }
}
