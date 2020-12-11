<?php

namespace Modules\Blog\Database\Seeders;

use Modules\Blog\Entities\Blog;
use Illuminate\Database\Seeder;

class BlogDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();

        Blog::factory()->times(100)->create();

        //Model::guard();
    }
}
