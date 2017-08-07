<?php namespace Liip\RepairCafe\Seeds;

use Liip\RepairCafe\Models\Category;
use October\Rain\Parse\Yaml;

class MasterData
{
    public static function seedCategoryData()
    {
        $yaml = new Yaml();

        if (Category::all()->count() === 0) {
            $categories = $yaml->parseFile(dirname(__FILE__) . '/Categories.yaml');
            foreach ($categories as $category) {
                $category_model = new Category();

                $category_model->fill($category);
                $category_model->save();
            }
        }
    }
}
