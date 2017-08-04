<?php namespace Liip\RepairCafe\Seeds;

use Liip\RepairCafe\Models\Category;
use Liip\RepairCafe\Models\LinkType;
use October\Rain\Parse\Yaml;

class MasterData
{
    public static function seedLinkTypeData()
    {
        $yaml = new Yaml();

        if (LinkType::all()->count() === 0) {
            $link_types = $yaml->parseFile(dirname(__FILE__) . '/LinkTypes.yaml');
            foreach ($link_types as $linkType) {
                $link_type_model = new LinkType();

                $link_type_model->fill($linkType);
                $link_type_model->save();
            }
        }
    }

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
