<?php return [
    'plugin' => [
        'name' => 'RepairCafe',
        'description' => 'Repair Cafés organisieren',
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
        'news' => 'News',
    ],
    'nav' => [
        'cafes' => 'Cafes',
        'events' => 'Events',
        'categories' => 'Kategorien',
        'contacts' => 'Kontakte',
        'news' => 'News',
    ],
    'relation' => [
        'contacts' => 'Kontakte',
        'events' => 'Events',
        'categories' => 'Kategorien',
        'cafe' => 'Cafe',
        'locale' => 'Sprache',
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
        'addressfinder' => 'Adresse suchen',
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
            'start' => 'Bitte geben Sie bei Eingabe eines Datums auch eine Uhrzeit ein, da ansonsten automatisch die jetzige Uhrzeit gesetzt wird.',
            'end' => 'Bitte geben Sie bei Eingabe eines Datums auch eine Uhrzeit ein, da ansonsten automatisch die jetzige Uhrzeit gesetzt wird.',
            'addressfinder' => 'Dieses Feld dient lediglich zum Suchen und automatisierten Vervollständigen der Addressfelder.',
        ],
    ],
    'category' => [
        'name' => 'Name',
        'slug' => 'Slug',
        'description' => 'Beschreibung',
    ],
    'component' => [
        'eventlist' => [
            'properties' => [
                'cafe_slug' => [
                    'title' => 'Cafe Slug',
                    'description' => 'Falls der Cafe Slug gesetzt ist, werden nur Events von diesem Cafe angezeigt.',
                ],
                'condensed' => [
                    'title' => 'Kompaktes Template',
                    'description' => 'Kompaktes Template verwenden.',
                ],
                'events_per_page' => [
                    'title' => 'Anzahl Events pro Seite',
                    'description' => 'Definiert wieviele Events pro Seite angezeigt werden sollen.',
                    'validationMessage' => 'Für die Anzahl Events pro Seite sind nur Zahlen erlaubt.',
                ],
            ],
        ],
        'newslist' => [
            'properties' => [
                'max_items' => [
                    'title' => 'Maximale Anzahl an News-Einträgen',
                    'description' => 'Definiert wieviele News-Einträge maximal angezeigt werden sollen.',
                    'validationMessage' => 'Für die Maximale Anzahl an News-Einträgen sind nur Zahlen erlaubt.',
                ],
            ],
        ],
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
            'contact_default_image' => 'Standard Kontakt Bild',
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
    'news' => [
        'id' => 'ID',
        'title' => 'Titel',
        'publish_date' => 'Publikationsdatum',
        'slug' => 'Slug',
        'lead' => 'Leadtext',
        'content' => 'Inhalt',
        'image' => 'Bild',
        'created_at' => 'Erstellt am',
        'updated_at' => 'Aktualisiert am',
    ],
    'settings' => [
        'label' => 'Repair Café Einstellungen',
        'description' => 'Konfiguriere das Repair Café Plugin',
        'static_map_api_url' => 'URL zur Generierung des Static Map Images',
        'external_map_url' => 'URL zum externen Map-Dienst',
        'mapbox_access_token' => 'Mapbox Access Token',
        'events_per_page' => 'Anzahl Events pro Seite',
        'news_per_page' => 'Anzahl News pro Seite',
        'comments' => [
            'static_map_api_url' => 'Muss folgende Parameter beinhalten: {PIN_COLOR}, {LONGITUDE}, {LATITUDE}, {ACCESS_TOKEN}',
            'external_map_url' => 'Muss folgende Parameter beinhalten: {QUERY}',
        ],
    ],
];
