<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{

    public function run(): void
    {

        // svuotiamo la tabella
        // DB::table('categories')->truncate();

        $technologies = ['HTML', 'CSS', 'JS', 'VUE', 'LARAVEL'];

        foreach ($technologies as $technology) {

            $new_technology = new Technology();
            $new_technology->name = $technology;
            $new_technology->slug = Str::slug($technology);

            $new_technology->save();
        }
    }
}
