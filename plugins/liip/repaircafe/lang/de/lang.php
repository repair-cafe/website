<?php return [
    'plugin' => [
        'name' => 'RepairCafe',
        'description' => '',
    ],
    'cafe' => [
        'id' => 'ID',
        'title' => 'Titel',
        'description' => 'Beschreibung',
        'tab' => [
            'general' => 'Allgemein',
            'address' => 'Adresse',
            'contacts' => 'Kontakte',
            'events' => 'Events',
            'external_links' => 'Externe Links',
        ],
        'contacts' => 'Kontakte',
        'slug' => 'Slug',
        'street' => 'Strasse',
        'zip' => 'PLZ',
        'city' => 'Ort',
        'image' => 'Bild',
        'logo' => 'Logo',
        'website_link' => 'Link zur eigenen Webseite',
        'contact_link' => 'Link zum Kontaktformular',
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
        'is_published' => 'Veröffentlicht',
        'created_at' => 'Erstellt am',
        'updated_at' => 'Aktualisiert am',
        'deleted_at' => 'Gelöscht am',
    ],
    'permissions' => [
        'cafes' => 'Cafes',
        'events' => 'Events',
        'contacts' => 'Kontakte',
        'categories' => 'Kategorien',
    ],
    'nav' => [
        'cafes' => 'Cafes',
        'events' => 'Events',
        'categories' => 'Kategorien',
        'contacts' => 'Kontakte',
    ],
    'relation' => [
        'contacts' => 'Kontakte',
        'events' => 'Events',
        'categories' => 'Kategorien',
        'cafe' => 'Cafe',
    ],
    'contact' => [
        'firstname' => 'Vorname',
        'lastname' => 'Nachname',
        'email' => 'Email',
        'phone' => 'Telefonnummer',
        'profile_picture' => 'Profilbild',
        'twitter' => 'Twitter URL',
        'facebook' => 'Facebook URL',
    ],
    'event' => [
        'title' => 'Titel',
        'description' => 'Beschreibung',
        'start' => 'Start',
        'end' => 'Ende',
        'is_published' => 'Veröffentlicht',
        'street' => 'Strasse',
        'zip' => 'PLZ',
        'city' => 'Ort',
        'latitude' => 'Latitude',
        'longitude' => 'Longitude',
        'tab' => [
            'address' => 'Adresse',
            'general' => 'Allgemein',
        ],
    ],
    'category' => [
        'name' => 'Name',
        'slug' => 'Slug',
    ],
    'component' => [
        'eventlist' => [
            'all_categories' => 'Alle Kategorien',
        ],
    ],
    'theme' => [
        'layout' => [
            'default' => [
                'variables' => [
                    'lead_text' => 'Leadtext',
                    'header_image' => 'Headerbild',
                ],
                'tab' => [
                    'general' => 'Allgemein',
                ],
            ],
        ],
        'fields' => [
            'site_title' => 'Seitentitel',
            'contact_email' => 'Kontakt Email-Adresse',
            'repair_cafe_default_image' => 'Standard Repair Café Bild',
            'repair_cafe_default_logo' => 'Standard Repair Café Logo',
            'social_facebook' => 'Facebook Page',
            'social_twitter' => 'Twitter Page',
            'social_googleplus' => 'Google+ Page',
            'tab' => [
                'general' => 'Allgemein',
                'social_media' => 'Social Media',
                'default_content' => 'Standardcontent',
            ],
        ],
    ],
];
