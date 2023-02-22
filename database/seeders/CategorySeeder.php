<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;

class CategorySeeder extends Seeder
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name' => 'Electronics',
            ],
            [
                'name' => 'Clothes',
            ],
            [
                'name' => 'Toys',
            ],
            [
                'name' => 'Cars',
            ],
            
        ];

        foreach ($items as $item) {
            Category::create($item);
        }
    }
}
