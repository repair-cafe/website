<?php
// @codingStandardsIgnoreFile

return [

    /*
    |--------------------------------------------------------------------------
    | Map Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the map settings for your application.
    |
    */

    'api_key' => 'j9q119t9rGOGfu2WGroSWwLGSfTTTasA',
    'geocoding_api_url' => 'http://open.mapquestapi.com/geocoding/v1/address?key={API_KEY}&street={STREET}&city={CITY}&postalCode={ZIP}&country={COUNTRY}',
    'static_map_api_url' => 'https://www.mapquestapi.com/staticmap/v5/map?key={API_KEY}&size=540,360&scalebar=false&zoom=17&locations={LATITUDE},{LONGITUDE}',
    'country' => 'ch',
    'external_map_url' => 'https://www.google.com/maps/search/?api=1&query={QUERY}',
    'events_per_page' => 15,
    'mapbox_access_token' => 'pk.eyJ1IjoicmVwYWlyY2FmZSIsImEiOiJjajZkZHNzemYxdnF3MnFxdjRkcXNrZmFjIn0.O_xC8sZLXDPo611ei0PLFA',

];
