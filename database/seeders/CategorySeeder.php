<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // drop all categories
        Category::truncate();
        $categories = [
            'ثلاثة اجزاء',
            'ربع القران',
            'نصف القران',
            'ثلاث ارباع القران',
            'القران كاملا',
            'اسأله ثقافيه'
        ];
        foreach ($categories as $category) {
            $categoryInserted = Category::create(['name' => $category]);
            if ($categoryInserted) {
                Question::where('category_id', $category)->update(['category_id' => $categoryInserted->id]);
            }
        }
        // change the category_id column from type string to integer
        \DB::statement('ALTER TABLE questions MODIFY category_id INT');
    }
}
