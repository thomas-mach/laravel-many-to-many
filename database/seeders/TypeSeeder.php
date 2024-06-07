<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{

    public function run(): void
    {

        // svuotiamo la tabella
        // DB::table('categories')->truncate();

        $categories = ['FrontEnd', 'Backend', 'FullStack', 'Design', 'DevOps'];

        foreach ($categories as $category_name) {

            $new_category = new Type();
            $new_category->name = $category_name;
            $new_category->slug = Str::slug($category_name);

            $new_category->save();
        }
    }
}
