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

    'geocoding_api_url' => 'https://maps.googleapis.com/maps/api/geocode/json?address={ADDRESS}&region={REGION}&key={API_KEY}',
    'static_map_api_url' => 'https://api.mapbox.com/styles/v1/mapbox/streets-v10/static/pin-s+4cabe5({LONGITUDE},{LATITUDE})/{LONGITUDE},{LATITUDE},12/540x250@2x?access_token={ACCESS_TOKEN}&logo=false',
    'region' => 'ch',
    'external_map_url' => 'https://www.google.com/maps/search/?api=1&query={QUERY}',
    'events_per_page' => 15,
    'mapbox_access_token' => 'pk.eyJ1IjoicmVwYWlyY2FmZSIsImEiOiJjajZkZHNzemYxdnF3MnFxdjRkcXNrZmFjIn0.O_xC8sZLXDPo611ei0PLFA',
    'googlemaps_geocoding_api_key' => 'AIzaSyChkCF-3LE8cmW8pN2ROSXmtHOIkg1hkbY',

];
