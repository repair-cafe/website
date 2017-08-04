<?php namespace Liip\RepairCafe\Seeds;

use Liip\RepairCafe\Models\Cafe;
use Liip\RepairCafe\Models\Category;
use Liip\RepairCafe\Models\Contact;
use Liip\RepairCafe\Models\Event;
use October\Rain\Parse\Yaml;

class Cafes
{
    public static function seedCafeData()
    {
        $yaml = new Yaml();
        $cafes = $yaml->parseFile(dirname(__FILE__).'/Cafes.yaml');

        foreach ($cafes as $cafe) {
            $cafe_model = new Cafe();

            $cafe_model->fill($cafe);
            $cafe_model->save();

            // retrieve id from created cafe_model to attach the contacts to it
            $cafe_id = $cafe_model->getAttribute('id');

            if (isset($cafe['contacts'])) {
                foreach ($cafe['contacts'] as $contact) {
                    $contact['cafe_id'] = $cafe_id;
                    $cafe_model->contacts[] = Contact::create($contact);
                }
            }

            if (isset($cafe['events'])) {
                foreach ($cafe['events'] as $event) {
                    $event['cafe_id'] = $cafe_id;
                    $cafe_model->events[] = Event::create($event);
                }

                // attach some random categories to events
                foreach ($cafe_model->events as $event_model) {
                    $categories = Category::all();
                    $last = count($categories)-1;
                    $event_model->categories()->attach($categories[ rand(0, $last) ]);
                }
            }
        }
    }
}
