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
        'duplicate_selected' => 'Eine Kopie dieses Events erstellen',
        'duplicate_selected_confirm' => 'Möchten Sie ":eventname" wirklich kopieren?',
        'duplicate_success' => '":eventname" wurde erfolgreich kopiert.',
        'duplicate_error' => 'Kopieren von ":eventname" ist fehlgeschlagen.',
        'comments' => [
            'longitude' => 'Longitude und Latitude werden, sofern diese Felder leer gelassen werden, beim Speichern automatisch aus der Adresse generiert. Falls die Koordinaten nicht stimmen können diese manuell überschrieben werden. Um die Koordinaten manuell zu generieren kann folgende Webseite verwendet werden <a href="http://www.latlong.net/" target="_blank">http://www.latlong.net/</a>.',
            'start' => 'Bitte geben Sie bei Eingabe eines Datums auch eine Uhrzeit ein, da ansonsten automatisch die jetzige Uhrzeit gesetzt wird.',
            'end' => 'Bitte geben Sie bei Eingabe eines Datums auch eine Uhrzeit ein, da ansonsten automatisch die jetzige Uhrzeit gesetzt wird.',
        ],
        'messages' => [
            'geocoding_error' => 'Die Adresse konnte leider nicht in eine gültige Geolocation (Latitude/Longitude) umgewandelt werden.',
        ],
    ],
    'category' => [
        'name' => 'Name',
        'slug' => 'Slug',
        'description' => 'Beschreibung',
    ],
    'component' => [
        'categorylist' => [
            'all_categories' => 'Alle Kategorien',
        ],
    ],
    'theme' => [
        'layout' => [
            'default' => [
                'variables' => [
                    'lead_text' => 'Leadtext',
                    'header_image' => 'Headerbild',
                    'call_to_action_text' => 'Call-to-action Text',
                    'call_to_action_url' => 'Call-to-action Link',
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
