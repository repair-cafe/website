<?php

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

];
