<?php return [
    'plugin' => [
        'name' => 'Repair Café',
        'description' => 'Organiser des Repair Cafés',
    ],
    'cafe' => [
        'id' => 'ID',
        'title' => 'Titre',
        'description' => 'Description',
        'tab' => [
            'general' => 'Général',
            'address' => 'Adresse',
            'contacts' => 'Contacts',
            'events' => 'Événements',
            'external_links' => 'Liens externes',
        ],
        'contacts' => 'Contacts',
        'slug' => 'Slug',
        'street' => 'Rue',
        'zip' => 'Code postal',
        'city' => 'Localité',
        'image' => 'Photo',
        'logo' => 'Logo',
        'website_link' => 'Lien vers le site internet',
        'contact_link' => 'Lien vers le formulaire de contact',
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
        'is_published' => 'Publié',
        'created_at' => 'Créé le',
        'updated_at' => 'Actualisé le',
        'deleted_at' => 'Supprimé le',
        'comments' => [
            'image' => 'Dimensions optimales de l\'image: 1110 x 450 pixels (px). Taille maximale du fichier: 1MB',
            'logo' => 'Dimensions optimales de l\'image: 500 x 500 pixels (px). Taille maximale du fichier: 512KB',
        ],
    ],
    'permissions' => [
        'cafes' => 'Repair Cafés',
        'events' => 'Événements',
        'categories' => 'Catégories',
        'news' => 'Actualités',
        'settings' => 'Paramètres',
    ],
    'nav' => [
        'cafes' => 'Repair Cafés',
        'events' => 'Événements',
        'categories' => 'Catégories',
        'contacts' => 'Contacts',
        'news' => 'Actualités',
    ],
    'relation' => [
        'contacts' => 'Contacts',
        'events' => 'Événements',
        'categories' => 'Catégories',
        'cafe' => 'Repair Café',
        'locale' => 'Langue',
    ],
    'contact' => [
        'firstname' => 'Prénom',
        'lastname' => 'Nom',
        'email' => 'E-mail',
        'phone' => 'Numéro de téléphone',
        'profile_picture' => 'Photo de profil',
        'twitter' => 'Adresse (URL) Twitter',
        'facebook' => 'Adresse (URL) Facebook',
        'comments' => [
            'profile_picture' => 'Dimensions optimales de l\'image: 200 x 200 pixels (px). Taille maximale du fichier: 512KB',
        ],
    ],
    'event' => [
        'id' => 'ID',
        'title' => 'Titre',
        'description' => 'Description',
        'start' => 'Début',
        'end' => 'Fin',
        'is_published' => 'Publié',
        'addressfinder' => 'Chercher l\'adresse',
        'street' => 'Rue',
        'zip' => 'Code postal',
        'city' => 'Lieu',
        'latitude' => 'Latitude',
        'longitude' => 'Longitude',
        'tab' => [
            'address' => 'Adresse',
            'general' => 'Général',
        ],
        'duplicate_selected' => 'Créer une copie de cet événement',
        'duplicate_selected_confirm' => 'Souhaitez-vous vraiment copier ":eventname"?',
        'duplicate_success' => '":eventname" a été copié avec succès.',
        'duplicate_error' => 'La copie de ":eventname" a échoué.',
        'comments' => [
            'start' => 'Si l\’heure n’est pas indiquée, l\'heure actuelle sera insérée automatiquement.',
            'end' => 'Si l\’heure n’est pas indiquée, l\'heure actuelle sera insérée automatiquement.',
            'addressfinder' => 'Ce champ sert uniquement à la recherche et à la saisie semi-automatique des champs d’adresse.',
        ],
    ],
    'user' => [
        'tab' => [
            'cafes' => 'Repair Cafés',
            'cafe_label' => 'Repair Cafés',
            'cafe_comment' => 'Choisir les Repair Cafés que cet utilisateur peut voir et éditer.',
        ],
    ],
    'category' => [
        'id' => 'ID',
        'name' => 'Nom',
        'slug' => 'Slug',
        'description' => 'Description',
    ],
    'component' => [
        'eventlist' => [
            'details' => [
                'name' => 'Liste d\'événements',
                'description' => 'Liste de tous les événements',
            ],
            'properties' => [
                'cafe_slug' => [
                    'title' => 'Cafe Slug',
                    'description' => 'Si le slug Repair Café est utilisé, seuls les événements de ce Repair Café seront affichés.',
                ],
                'condensed' => [
                    'title' => 'Modèle',
                    'description' => 'Utiliser un modèle.',
                ],
                'events_per_page' => [
                    'title' => 'Nombre d\'événements par page',
                    'description' => 'Définit combien d\'événements doivent être affichés par page.',
                    'validationMessage' => 'Pour le nombre d\'événements par page, entrer des chiffres.',
                ],
                'is_embedded' => [
                    'title' => 'Embed-Template',
                    'description' => 'Marquer si les composants sont utilisés dans le Embed-Template. La cible de tous les liens sera réglée sur _blank.',
                ],
            ],
        ],
        'newslist' => [
            'details' => [
                'name' => 'Liste des actualités',
                'description' => 'Liste de toutes les actualités',
            ],
            'properties' => [
                'max_items' => [
                    'title' => 'Nombre maximal d\'actualités pouvant être entrées',
                    'description' => 'Définit combien d\'actualités doivent être affichées au maximum.',
                    'validationMessage' => 'Pour le nombre maximal d\'actualités, entrer des chiffres.',
                ],
            ],
        ],
        'categorylist' => [
            'details' => [
                'name' => 'Liste des catégories',
                'description' => 'Liste de toutes les catégories',
            ],
            'all_categories' => 'Toutes les catégories',
        ],
        'cafe_detail' => [
            'details' => [
                'name' => 'Repair Café en détail',
                'description' => 'Aperçu détaillé d\'un Repair Café',
            ],
            'properties' => [
                'slug' => [
                    'title' => 'Slug',
                    'description' => 'Slug du Repair Café qui doit être affiché.',
                ],
            ],
        ],
        'news_detail' => [
            'details' => [
                'name' => 'Les actualités en détail',
                'description' => 'Aperçu détaillé d\'une actualité',
            ],
            'properties' => [
                'slug' => [
                    'title' => 'Slug',
                    'description' => 'Slug de l\'actualité qui doit être affichée.',
                ],
            ],
        ],
        'button' => [
            'details' => [
                'name' => 'Bouton',
                'description' => 'Insère un bouton',
            ],
            'label' => [
                'title' => 'Label',
                'description' => 'Bouton texte',
            ],
            'url' => [
                'title' => 'Lien',
                'description' => 'Bouton lien',
            ],
            'target' => [
                'title' => 'Cible du lien',
                'description' => 'Bouton cible du lien',
                'option' => [
                    'self' => 'Fenêtre distincte',
                    'blank' => 'Nouvelle fenêtre',
                ],
            ],
            'style' => [
                'title' => 'Style',
                'description' => 'Bouton style',
                'option' => [
                    'btn_primary' => 'Primary Button',
                    'btn_secondary' => 'Secondary Button',
                    'btn_outline_primary' => 'Primary Outline Button',
                    'btn_outline_secondary' => 'Secondary Outline Button',
                ],
            ],
            'position' => [
                'title' => 'Position',
                'description' => 'Bouton position',
                'option' => [
                    'left' => 'Liens',
                    'center' => 'Centrer',
                    'right' => 'À droite',
                ],
            ],
            'size' => [
                'title' => 'Taille',
                'description' => 'Bouton taille',
                'option' => [
                    'normal' => 'Normal',
                    'large' => 'Grand',
                    'small' => 'Petit',
                ],
            ],
        ],
    ],
    'theme' => [
        'layout' => [
            'default' => [
                'variables' => [
                    'lead_text' => 'Chapeau',
                    'header_image' => 'Image d\'en-tête',
                    'call_to_action_text' => 'Texte call-to-action',
                    'call_to_action_url' => 'Lien call-to-action',
                ],
                'tab' => [
                    'content' => 'Contenu',
                    'header' => 'En-tête',
                ],
                'comments' => [
                    'header_image' => 'Dimensions optimales de l\'image: 1110 x 450 pixels (px). Taille maximale du fichier: 1MB',
                ],
            ],
            'anchor_nav' => [
                'variables' => [
                    'content_sections' => [
                        'prompt' => 'Ajouter une nouvelle section Contenu',
                        'title' => 'Titre',
                        'nav_title' => 'Titre de navigation',
                        'content' => 'Contenu',
                    ],
                ],
            ],
        ],
        'pages' => [
            'events' => [
                'title' => 'Événements',
                'meta_description' => 'Événements du Repair Café',
            ],
            'news' => [
                'title' => 'Actuel',
                'meta_description' => 'Actualités du Repair Café',
            ],
            'cafes' => [
                'title' => 'Tous les Repair Cafés',
                'meta_description' => 'Tous les Repair Cafés',
            ],
        ],
        'fields' => [
            'site_title' => 'Titre de page',
            'contact_email_de' => 'Kontakt Email-Adresse (DE)',
            'contact_email_fr' => 'Adresse e-mail de contact (FR)',
            'contact_email_it' => 'Adresse e-mail de contact (IT)',
            'logo_url_de' => 'Konsumentenschutz Logo URL (DE)',
            'logo_url_fr' => 'URL du logo Fédération romande des consommateurs (FR)',
            'logo_url_it' => 'URL du logo Fédération romande des consommateurs (IT)',
            'repair_cafe_default_image' => 'Image Repair Café par défaut',
            'repair_cafe_default_logo' => 'Logo Repair Café par défaut',
            'contact_default_image' => 'Image de contact par défaut',
            'social_facebook_de' => 'Facebook Page (DE)',
            'social_facebook_fr' => 'Page Facebook (FR)',
            'social_facebook_it' => 'Page Facebook (IT)',
            'social_twitter_de' => 'Twitter Page (DE)',
            'social_twitter_fr' => 'Page Twitter (FR)',
            'social_twitter_it' => 'Page Twitter (IT)',
            'social_googleplus_de' => 'Google+ Page (DE)',
            'social_googleplus_fr' => 'Page Google+ (FR)',
            'social_googleplus_it' => 'Page Google+ (IT)',
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
                'general' => 'Général',
                'general_de' => 'Allgemein (DE)',
                'general_fr' => 'Général (FR)',
                'general_it' => 'Général (IT)',
                'google_analytics' => 'Google Analytics',
                'default_content' => 'Contenu par défaut',
            ],
            'comments' => [
                'mailchimp_domain' => 'Bsp.: konsumentenschutz.us7.list-manage.com',
            ],
        ],
    ],
    'news' => [
        'id' => 'ID',
        'title' => 'Titre',
        'publish_date' => 'Date de publication',
        'slug' => 'Slug',
        'lead' => 'Chapeau',
        'content' => 'Contenu',
        'image' => 'Image',
        'created_at' => 'Créé le',
        'updated_at' => 'Actualisé le',
        'tab' => [
            'general' => 'Général',
        ],
        'comments' => [
            'image' => 'Dimensions optimales de l\'image: 1110 x 450 pixels (px). Taille maximale du fichier: 1MB',
        ],
    ],
    'settings' => [
        'label' => 'Paramètres du Repair Café',
        'description' => 'Configure le plugin Repair Café',
        'static_map_api_url' => 'URL vers la génération de l\'image du Static Map',
        'external_map_url' => 'URL vers le service de cartes externe',
        'mapbox_access_token' => 'Token d’accès à la Mapbox',
        'events_per_page' => 'Nombre d’événements par page',
        'news_per_page' => 'Nombre d\'actualités par page',
        'cafes_per_page' => 'Nombre de Repair Cafés par page',
        'comments' => [
            'static_map_api_url' => 'L\'URL peut inclure les paramètres suivants: {PIN_COLOR}, {LONGITUDE}, {LATITUDE}, {ACCESS_TOKEN}',
            'external_map_url' => 'L\'URL peut inclure les paramètres suivants: {ADDRESS}',
        ],
    ],
    'menuitem' => [
        'cafe' => 'Repair Café',
        'all_cafes' => 'Tous les Repair Cafés',
        'news' => 'Actualités',
        'all_news' => 'Toutes les actualités',
    ],
];
