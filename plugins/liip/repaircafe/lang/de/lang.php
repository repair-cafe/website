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
        'comments' => [
            'image' => 'Die optimale Bildgrösse beträgt 1110x450px, die Dateigrösse ist auf 1MB begrenzt',
            'logo' => 'Die optimale Bildgrösse beträgt 500x500px, die Dateigrösse ist auf 512KB begrenzt',
        ],
    ],
    'permissions' => [
        'cafes' => 'Cafes',
        'events' => 'Events',
        'categories' => 'Kategorien',
        'news' => 'News',
        'settings' => 'Einstellungen',
        'is_content_manager' => 'Ist Content Manager',
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
        'comments' => [
            'profile_picture' => 'Die optimale Bildgrösse beträgt 200x200px, die Dateigrösse ist auf 512KB begrenzt',
        ],
    ],
    'event' => [
        'id' => 'ID',
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
            'start' => 'Falls die Zeit nicht angegeben wird, wird automatisch die aktuelle Uhrzeit gesetzt.',
            'end' => 'Falls die Zeit nicht angegeben wird, wird automatisch die aktuelle Uhrzeit gesetzt.',
            'addressfinder' => 'Bitte dieses Feld ausfüllen, damit der Repair Café-Event auf der Karte gefunden wird. Damit werden auch automatisch die anderen Adressfelder ausgefüllt.',
        ],
    ],
    'user' => [
        'tab' => [
            'cafes' => 'Repair Cafés',
            'cafe_label' => 'Repair Cafés',
            'cafe_comment' => 'Wählen Sie Cafés aus, die dieser User sehen und bearbeiten darf.',
        ],
    ],
    'category' => [
        'id' => 'ID',
        'name' => 'Name',
        'slug' => 'Slug',
        'description' => 'Beschreibung',
    ],
    'component' => [
        'eventlist' => [
            'details' => [
                'name' => 'Eventliste',
                'description' => 'Liste aller Events',
            ],
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
                'is_embedded' => [
                    'title' => 'Embed-Template',
                    'description' => 'Markieren falls die Komponente im Embed-Template verwendet wird. Target aller Links wird dadurch auf _blank gesetzt.',
                ],
            ],
        ],
        'newslist' => [
            'details' => [
                'name' => 'Newsliste',
                'description' => 'Liste aller News',
            ],
            'properties' => [
                'max_items' => [
                    'title' => 'Maximale Anzahl an News-Einträgen',
                    'description' => 'Definiert wieviele News-Einträge maximal angezeigt werden sollen.',
                    'validationMessage' => 'Für die Maximale Anzahl an News-Einträgen sind nur Zahlen erlaubt.',
                ],
            ],
        ],
        'categorylist' => [
            'details' => [
                'name' => 'Kategorieliste',
                'description' => 'Liste aller Kategorien',
            ],
            'all_categories' => 'Alle Kategorien',
        ],
        'cafe_detail' => [
            'details' => [
                'name' => 'Café Detail',
                'description' => 'Detailansicht eines Repair Cafés',
            ],
            'properties' => [
                'slug' => [
                    'title' => 'Slug',
                    'description' => 'Slug des Cafés, welches angezeigt werden soll.',
                ],
            ],
        ],
        'news_detail' => [
            'details' => [
                'name' => 'News Detail',
                'description' => 'Detailansicht einer News',
            ],
            'properties' => [
                'slug' => [
                    'title' => 'Slug',
                    'description' => 'Slug der News, welche angezeigt werden soll.',
                ],
            ],
        ],
        'button' => [
            'details' => [
                'name' => 'Button',
                'description' => 'Fügt einen Button ein',
            ],
            'label' => [
                'title' => 'Label',
                'description' => 'Button Text',
            ],
            'url' => [
                'title' => 'Link',
                'description' => 'Button Link',
            ],
            'target' => [
                'title' => 'Link Ziel',
                'description' => 'Button Link Ziel',
                'option' => [
                    'self' => 'Eigenes Fenster',
                    'blank' => 'Neues Fenster',
                ],
            ],
            'style' => [
                'title' => 'Stil',
                'description' => 'Button Stil',
                'option' => [
                    'btn_primary' => 'Primary Button',
                    'btn_secondary' => 'Secondary Button',
                    'btn_outline_primary' => 'Primary Outline Button',
                    'btn_outline_secondary' => 'Secondary Outline Button',
                ],
            ],
            'position' => [
                'title' => 'Position',
                'description' => 'Button Position',
                'option' => [
                    'left' => 'Links',
                    'center' => 'Zentrieren',
                    'right' => 'Rechts',
                ],
            ],
            'size' => [
                'title' => 'Grösse',
                'description' => 'Button Grösse',
                'option' => [
                    'normal' => 'Normal',
                    'large' => 'Gross',
                    'small' => 'Klein',
                ],
            ],
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
                    'content' => 'Inhalt',
                    'header' => 'Header',
                ],
                'comments' => [
                    'header_image' => 'Die optimale Bildgrösse beträgt 1110x450px, die Dateigrösse ist auf 1MB begrenzt',
                ],
            ],
            'anchor_nav' => [
                'variables' => [
                    'content_sections' => [
                        'prompt' => 'Neue Content Section hinzufügen',
                        'title' => 'Titel',
                        'nav_title' => 'Navigationstitel',
                        'content' => 'Inhalt',
                    ],
                ],
            ],
        ],
        'pages' => [
            'events' => [
                'title' => 'Events',
                'meta_description' => 'Repair Café Events',
            ],
            'news' => [
                'title' => 'Aktuelles',
                'meta_description' => 'Repair Café News',
            ],
            'cafes' => [
                'title' => 'Alle Repair Cafés',
                'meta_description' => 'Alle Repair Cafés',
            ],
        ],
        'fields' => [
            'site_title' => 'Seitentitel',
            'contact_email_de' => 'Kontakt Email-Adresse (DE)',
            'contact_email_fr' => 'Kontakt Email-Adresse (FR)',
            'contact_email_it' => 'Kontakt Email-Adresse (IT)',
            'logo_url_de' => 'Konsumentenschutz Logo URL (DE)',
            'logo_url_fr' => 'Konsumentenschutz Logo URL (FR)',
            'logo_url_it' => 'Konsumentenschutz Logo URL (IT)',
            'repair_cafe_default_image' => 'Standard Repair Café Bild',
            'repair_cafe_default_logo' => 'Standard Repair Café Logo',
            'contact_default_image' => 'Standard Kontakt Bild',
            'social_facebook_de' => 'Facebook Page (DE)',
            'social_facebook_fr' => 'Facebook Page (FR)',
            'social_facebook_it' => 'Facebook Page (IT)',
            'social_twitter_de' => 'Twitter Page (DE)',
            'social_twitter_fr' => 'Twitter Page (FR)',
            'social_twitter_it' => 'Twitter Page (IT)',
            'social_googleplus_de' => 'Google+ Page (DE)',
            'social_googleplus_fr' => 'Google+ Page (FR)',
            'social_googleplus_it' => 'Google+ Page (IT)',
            'mailchimp_domain_de' => 'MailChimp Domain (DE)',
            'mailchimp_domain_fr' => 'MailChimp Domain (FR)',
            'mailchimp_domain_it' => 'MailChimp Domain (IT)',
            'mailchimp_user_id_de' => 'MailChimp User ID (DE)',
            'mailchimp_user_id_fr' => 'MailChimp User ID (FR)',
            'mailchimp_user_id_it' => 'MailChimp User ID (IT)',
            'mailchimp_list_id_de' => 'MailChimp List ID (DE)',
            'mailchimp_list_id_fr' => 'MailChimp List ID (FR)',
            'mailchimp_list_id_it' => 'MailChimp List ID (IT)',
            'google_analytics_tracking_id' => 'Tracking ID',
            'tab' => [
                'general' => 'Allgemein',
                'general_de' => 'Allgemein (DE)',
                'general_fr' => 'Allgemein (FR)',
                'general_it' => 'Allgemein (IT)',
                'google_analytics' => 'Google Analytics',
                'default_content' => 'Standardcontent',
            ],
            'comments' => [
                'mailchimp_domain' => 'Bsp.: konsumentenschutz.us7.list-manage.com',
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
        'tab' => [
            'general' => 'Allgemein',
        ],
        'comments' => [
            'image' => 'Die optimale Bildgrösse beträgt 1110x450px, die Dateigrösse ist auf 1MB begrenzt',
        ],
    ],
    'settings' => [
        'label' => 'Repair Café Einstellungen',
        'description' => 'Konfiguriere das Repair Café Plugin',
        'static_map_api_url' => 'URL zur Generierung des Static Map Images',
        'external_map_url' => 'URL zum externen Map-Dienst',
        'mapbox_access_token' => 'Mapbox Access Token',
        'events_per_page' => 'Anzahl Events pro Seite',
        'news_per_page' => 'Anzahl News pro Seite',
        'cafes_per_page' => 'Anzahl Cafes pro Seite',
        'comments' => [
            'static_map_api_url' => 'Die URL kann folgende Parameter beinhalten: {PIN_COLOR}, {LONGITUDE}, {LATITUDE}, {ACCESS_TOKEN}',
            'external_map_url' => 'Die URL kann folgende Parameter beinhalten: {ADDRESS}',
        ],
    ],
    'menuitem' => [
        'cafe' => 'Repair Café',
        'all_cafes' => 'Alle Repair Cafés',
        'news' => 'News',
        'all_news' => 'Alle News',
    ],
];
