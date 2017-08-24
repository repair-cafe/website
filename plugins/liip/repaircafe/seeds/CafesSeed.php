<?php namespace Liip\RepairCafe\Seeds;

use Illuminate\Database\QueryException;
use Liip\RepairCafe\Models\Cafe;
use Liip\RepairCafe\Models\Category;
use Liip\RepairCafe\Models\Contact;
use Liip\RepairCafe\Models\Event;
use October\Rain\Parse\Yaml;
use System\Models\File;

class CafesSeed
{
    public static function seedCafeData()
    {
        $yaml = new Yaml();
        $cafes = $yaml->parseFile(dirname(__FILE__).'/Cafes.yaml');

        foreach ($cafes as $cafe) {
            $cafe_model = new Cafe();

            $cafe_model->fill($cafe);

            if (!empty($cafe['image'])) {
                $image_file = new File();
                $image_file->data = dirname(__FILE__) . '/dummy-images/' . $cafe['image'];
                $cafe_model->image = $image_file;
            }

            if (!empty($cafe['logo'])) {
                $logo_file = new File();
                $logo_file->data = dirname(__FILE__) . '/dummy-images/' . $cafe['logo'];
                $cafe_model->logo = $logo_file;
            }

            $cafe_model->save();

            // retrieve id from created cafe_model to attach the contacts to it
            $cafe_id = $cafe_model->getAttribute('id');

            if (isset($cafe['contacts'])) {
                foreach ($cafe['contacts'] as $contact) {
                    $contact['cafe_id'] = $cafe_id;

                    $contact_model = Contact::create($contact);

                    if (!empty($contact['profile_picture'])) {
                        $profile_picture_file = new File();
                        $profile_picture_file->data = dirname(__FILE__) . '/dummy-images/' . $contact['profile_picture'];
                        $contact_model->profile_picture = $profile_picture_file;
                    }
                    $contact_model->save();

                    $cafe_model->contacts[] = $contact_model;
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
                    try {
                        $event_model->categories()->attach($categories[ rand(0, $last) ]);
                    } catch (QueryException $ex) {
                        // do nothing when the same category is added twice and proceed
                    }
                }
            }
        }
    }
}
