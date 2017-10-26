<?php return [
    'plugin' => [
        'name' => 'Caffè riparazione',
        'description' => 'Organizzare un caffè riparazione',
    ],
    'cafe' => [
        'id' => 'ID',
        'title' => 'Titolo',
        'description' => 'Descrizione',
        'tab' => [
            'general' => 'Informazioni generali',
            'address' => 'Indirizzo',
            'contacts' => 'Contatti',
            'events' => 'Eventi',
            'external_links' => 'Collegamenti esterni',
        ],
        'contacts' => 'Contatti',
        'slug' => 'Slug',
        'street' => 'Via',
        'zip' => 'CAP',
        'city' => 'Città',
        'image' => 'Immagine',
        'logo' => 'Logo',
        'website_link' => 'Link alla propria pagina web',
        'contact_link' => 'Link al formulario di contatto',
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
        'is_published' => 'Pubblicato',
        'created_at' => 'Compilato il',
        'updated_at' => 'Attualizzato il',
        'deleted_at' => 'Eliminato il',
        'comments' => [
            'image' => 'La dimensione ottimale delle immagini è di 1110x450px, il limite di dimensione del file è di 1MB.',
            'logo' => 'La dimensione ottimale delle immagini è di 500x500px, il limite di dimensione del file è di 512 KB.',
        ],
    ],
    'permissions' => [
        'cafes' => 'Caffè',
        'events' => 'Eventi',
        'categories' => 'Categorie',
        'news' => 'News',
        'settings' => 'Impostazioni',
    ],
    'nav' => [
        'cafes' => 'Caffè',
        'events' => 'Eventi',
        'categories' => 'Categorie',
        'contacts' => 'Contatti',
        'news' => 'News',
    ],
    'relation' => [
        'contacts' => 'Contatti',
        'events' => 'Eventi',
        'categories' => 'Categorie',
        'cafe' => 'Caffè',
        'locale' => 'Lingue',
    ],
    'contact' => [
        'firstname' => 'Nome',
        'lastname' => 'Cognome',
        'email' => 'E-mail',
        'phone' => 'Numero di telefono',
        'profile_picture' => 'Immagine profilo',
        'twitter' => 'Twitter URL',
        'facebook' => 'Facebook URL',
        'comments' => [
            'profile_picture' => 'La dimensione ottimale delle immagini è di 200x200px, il limite di dimensione del file è di 512KB.',
        ],
    ],
    'event' => [
        'id' => 'ID',
        'title' => 'Titolo',
        'description' => 'Descrizione',
        'start' => 'Inizio',
        'end' => 'Fine',
        'is_published' => 'Pubblicato',
        'addressfinder' => 'Cercare un indirizzo',
        'street' => 'Via',
        'zip' => 'CAP',
        'city' => 'Città',
        'latitude' => 'Latitude',
        'longitude' => 'Longitude',
        'tab' => [
            'address' => 'Indirizzo',
            'general' => 'Informazioni generali',
        ],
        'duplicate_selected' => 'Copiare questo evento',
        'duplicate_selected_confirm' => 'È sicuro di voler copiare ":eventname"?',
        'duplicate_success' => '":eventname" è stato copiato correttamente',
        'duplicate_error' => 'Un errore non ha permesso di copiare ":eventname"',
        'comments' => [
            'start' => 'Se non si indica un orario, viene inserito automaticamente l\'orario attuale.',
            'end' => 'Se non si indica un orario, viene inserito automaticamente l\'orario attuale.',
            'addressfinder' => 'Questo campo serve unicamente per effettuare una ricerca e per compilare automaticamente i campi dell\'indirizzo.',
        ],
    ],
    'user' => [
        'tab' => [
            'cafes' => 'Caffè riparazione',
            'cafe_label' => 'Caffè riparazione',
            'cafe_comment' => 'Scelga i Caffè riparazione che questo utente può vedere e modificare.',
        ],
    ],
    'category' => [
        'id' => 'ID',
        'name' => 'Cognome',
        'slug' => 'Slug',
        'description' => 'Descrizione',
    ],
    'component' => [
        'eventlist' => [
            'details' => [
                'name' => 'Elenco degli eventi',
                'description' => 'Elenco di tutti gli eventi',
            ],
            'properties' => [
                'cafe_slug' => [
                    'title' => 'Cafe Slug',
                    'description' => 'Se è impostato lo Slug del  caffé, verranno mostrasti solo gli eventi di questo caffé riparazione.',
                ],
                'condensed' => [
                    'title' => 'Template compatto',
                    'description' => 'Utilizzare il template compatto.',
                ],
                'events_per_page' => [
                    'title' => 'Quantità di eventi per pagina',
                    'description' => 'Definisca quanti eventi per pagina devono essere visualizzati.',
                    'validationMessage' => 'Nel campo eventi per pagina sono ammessi unicamente i numeri.',
                ],
                'is_embedded' => [
                    'title' => 'Embed-Template',
                    'description' => 'Segnate se la componente è utilizzata nel modello di base. Tutti i link saranno impostati verso _blank.Segnate se la componente è utilizzata nel modello di base. Tutti i link saranno impostati verso _blank.',
                ],
            ],
        ],
        'newslist' => [
            'details' => [
                'name' => 'Elenco delle news',
                'description' => 'Elenco di tutte le news',
            ],
            'properties' => [
                'max_items' => [
                    'title' => 'Numero massimo di news inserite',
                    'description' => 'Definisca il numero massimo di news che possono essere inserite.',
                    'validationMessage' => 'Nel campo numero massimo di news inserite possono essere utilizzati unicamente i numeri',
                ],
            ],
        ],
        'categorylist' => [
            'details' => [
                'name' => 'Elenco delle categorie',
                'description' => 'Elenco di tutte le categorie',
            ],
            'all_categories' => 'Tutte le categorie',
        ],
        'cafe_detail' => [
            'details' => [
                'name' => 'Dettaglio del caffè',
                'description' => 'Visualizzare un caffè riparazione nel dettaglio',
            ],
            'properties' => [
                'slug' => [
                    'title' => 'Slug',
                    'description' => 'Slug dei Caffé, che mostra quali devono essere mostrati.',
                ],
            ],
        ],
        'news_detail' => [
            'details' => [
                'name' => 'Dettaglio delle news',
                'description' => 'Visualizzare una news nel dettaglio',
            ],
            'properties' => [
                'slug' => [
                    'title' => 'Slug',
                    'description' => 'Slug delle news, che mostra quali devono essere mostrate.',
                ],
            ],
        ],
        'button' => [
            'details' => [
                'name' => 'Distintivo',
                'description' => 'Aggiungere un distintivo',
            ],
            'label' => [
                'title' => 'Label',
                'description' => 'Testo del distintivo',
            ],
            'url' => [
                'title' => 'Link',
                'description' => 'Pulsante link',
            ],
            'target' => [
                'title' => 'Destinazione link',
                'description' => 'Pulsante destinazione link',
                'option' => [
                    'self' => 'Stessa finestra',
                    'blank' => 'Nuova finestra',
                ],
            ],
            'style' => [
                'title' => 'Stile',
                'description' => 'Pulsante stile',
                'option' => [
                    'btn_primary' => 'Primary Button',
                    'btn_secondary' => 'Secondary Button',
                    'btn_outline_primary' => 'Primary Outline Button',
                    'btn_outline_secondary' => 'Secondary Outline Button',
                ],
            ],
            'position' => [
                'title' => 'Posizione',
                'description' => 'Pulsante posizione',
                'option' => [
                    'left' => 'Collegamenti',
                    'center' => 'Centrato',
                    'right' => 'A destra',
                ],
            ],
            'size' => [
                'title' => 'Dimensione',
                'description' => 'Pulsante grandezza',
                'option' => [
                    'normal' => 'Normale',
                    'large' => 'Grande',
                    'small' => 'Piccolo',
                ],
            ],
        ],
    ],
    'theme' => [
        'layout' => [
            'default' => [
                'variables' => [
                    'lead_text' => 'Testo introduttivo',
                    'header_image' => 'Immagine di intestazione',
                    'call_to_action_text' => 'Testo di motivazione',
                    'call_to_action_url' => 'Link di motivazione',
                ],
                'tab' => [
                    'content' => 'Contenuto',
                    'header' => 'Header',
                ],
                'comments' => [
                    'header_image' => 'La dimensione ottimale delle immagini è di 1110x450px, il limite di dimensione del file è di 1MB.',
                ],
            ],
            'anchor_nav' => [
                'variables' => [
                    'content_sections' => [
                        'prompt' => 'Inserire una nuova Content Section',
                        'title' => 'Titolo',
                        'nav_title' => 'Titolo di navigazione',
                        'content' => 'Contenuto',
                    ],
                ],
            ],
        ],
        'pages' => [
            'events' => [
                'title' => 'Eventi',
                'meta_description' => 'Eventi caffè riparazione',
            ],
            'news' => [
                'title' => 'Attualità',
                'meta_description' => 'News caffè riparazione',
            ],
            'cafes' => [
                'title' => 'Tutti i caffè riparazione',
                'meta_description' => 'Tutti i caffè riparazione',
            ],
        ],
        'fields' => [
            'site_title' => 'Titolo della pagina',
            'contact_email_de' => 'Kontakt Email-Adresse (DE)',
            'contact_email_fr' => 'Contatto indirizzo e-mail (FR)',
            'contact_email_it' => 'Contatto indirizzo e-mail (IT)',
            'logo_url_de' => 'Konsumentenschutz Logo URL (DE)',
            'logo_url_fr' => 'Federazione Romanda dei consumatori (FR)',
            'logo_url_it' => 'Associazione consumatrici e consumatori della Svizzera italiana (IT)',
            'repair_cafe_default_image' => 'Immagine standard del caffè riparazione',
            'repair_cafe_default_logo' => 'Logo standard del caffè riparazione',
            'contact_default_image' => 'Immagine standard del contatto',
            'social_facebook_de' => 'Pagina facebook (DE)',
            'social_facebook_fr' => 'Pagina facebook (FR)',
            'social_facebook_it' => 'Pagina facebook (IT)',
            'social_twitter_de' => 'Pagina twitter (DE)',
            'social_twitter_fr' => 'Pagina twitter (FR)',
            'social_twitter_it' => 'Pagina twitter (IT)',
            'social_googleplus_de' => 'Pagina Google+ (DE)',
            'social_googleplus_fr' => 'Pagina Google+ (FR)',
            'social_googleplus_it' => 'Pagina Google+ (IT)',
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
                'general' => 'Informazioni generali',
                'general_de' => 'Informazioni generali (DE)',
                'general_fr' => 'Informazioni generali (FR)',
                'general_it' => 'Informazioni generali (IT)',
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
        'title' => 'Titolo',
        'publish_date' => 'Data di pubblicazione',
        'slug' => 'Slug',
        'lead' => 'Testo introduttivo',
        'content' => 'Contenuto',
        'image' => 'Immagine',
        'created_at' => 'Creato il',
        'updated_at' => 'Aggiornato il',
        'tab' => [
            'general' => 'Informazioni generali',
        ],
        'comments' => [
            'image' => 'La dimensione ottimale delle immagini è di 1110x450px, il limite di dimensione del file è di 1MB.',
        ],
    ],
    'settings' => [
        'label' => 'Impostazioni del caffé riparazioni',
        'description' => 'Configurare il Plugin del caffè riparazione',
        'static_map_api_url' => 'URL per generare le immagini della mappa',
        'external_map_url' => 'URL verso servizi esterni di  mappe',
        'mapbox_access_token' => 'Codice di accesso a  Mapbox ',
        'events_per_page' => 'Numero di eventi per pagina',
        'news_per_page' => 'Numero di news per pagina',
        'cafes_per_page' => 'Numero di caffè per pagina',
        'comments' => [
            'static_map_api_url' => 'Il link può comprendere i seguenti paramentri: {PIN_COLOR}, {LONGITUDE}, {LATITUDE}, {ACCESS_TOKEN}',
            'external_map_url' => 'Il link può comprendere i seguenti paramentri: {ADDRESS}',
        ],
    ],
    'menuitem' => [
        'cafe' => 'Caffè riparazione',
        'all_cafes' => 'Tutti i caffè riparazione',
        'news' => 'News',
        'all_news' => 'Tutte le news',
    ],
];
