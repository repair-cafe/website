<?php namespace Liip\RepairCafe\Updates;

use Seeder;
use Liip\RepairCafe\Models\LinkType;

class Seeder109 extends Seeder
{
    public function run()
    {
        // create LinkTypes

        $linkType = LinkType::where('id', '9980')->first();
        if($linkType == null) {
            $linkType = LinkType::create([
                'name' => 'facebook',
                'id' => '9980',
                'class_name' => 'facebook'
            ]);
        }
        $linkType = LinkType::where('id', '9981')->first();
        if($linkType == null) {
            $linkType = LinkType::create([
                'name' => 'instagram',
                'id' => '9981',
                'class_name' => 'instagram'
            ]);
        }
        $linkType = LinkType::where('id', '9982')->first();
        if($linkType == null) {
            $linkType = LinkType::create([
                'name' => 'homepage',
                'id' => '9982',
                'class_name' => 'homepage'
            ]);
        }


    }
}
