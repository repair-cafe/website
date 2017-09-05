<?php namespace Liip\RepairCafe\Seeds;

use Liip\RepairCafe\Models\Category;
use Liip\RepairCafe\Models\Settings;
use October\Rain\Parse\Yaml;
use RainLab\Translate\Models\Locale;

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

    public static function seedLocaleData()
    {
        // update autogenerated 'en' locale
        $existingLocale = Locale::find(1);
        $existingLocale->code = 'de';
        $existingLocale->name = 'German';
        $existingLocale->save();

        $additionalLocales = [
            'fr' => 'French',
            'it' => 'Italian',
        ];

        foreach ($additionalLocales as $code => $name) {
            $locale = new Locale();
            $locale->code = $code;
            $locale->name = $name;
            $locale->is_enabled = true;
            $locale->save();
        }
    }

    public static function seedSettingsData()
    {
        $settings = new Settings();
        $settings->static_map_api_url = 'https://api.mapbox.com/styles/v1/mapbox/streets-v10/static/pin-s+{PIN_COLOR}({LONGITUDE},{LATITUDE})/{LONGITUDE},{LATITUDE},12/540x250@2x?access_token={ACCESS_TOKEN}&logo=false';
        $settings->external_map_url = 'https://www.google.com/maps/search/?api=1&query={ADDRESS}';
        $settings->events_per_page = 15;
        $settings->cafes_per_page = 15;
        $settings->news_per_page = 9;
        $settings->save();
    }
}
