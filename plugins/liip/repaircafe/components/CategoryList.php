<?php namespace Liip\RepairCafe\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Lang;
use Liip\RepairCafe\Models\Category;

class CategoryList extends ComponentBase
{
    private $categories;

    public function componentDetails()
    {
        return [
            'name'        => 'liip.repaircafe::lang.component.categorylist.details.name',
            'description' => 'liip.repaircafe::lang.component.categorylist.details.description',
        ];
    }

    public function categoryOptions()
    {
        $category_options = array();
        $category_options[] = '- ' . Lang::get('liip.repaircafe::lang.component.categorylist.all_categories') . ' -';
        foreach ($this->categories as $category) {
            $category_options[$category->slug] = $category->name;
        }
        return $category_options;
    }

    public function categories()
    {
        return $this->categories;
    }

    public function onRun()
    {
        $this->categories = Category::orderBy('name', 'asc')->get();
    }
}
