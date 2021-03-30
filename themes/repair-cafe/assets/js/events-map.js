import L from 'leaflet';
import 'leaflet.markercluster'
import 'leaflet.locatecontrol'

// stupid hack so that leaflet's images work after going through webpack
// see: https://github.com/Leaflet/Leaflet/issues/4968
import marker from 'leaflet/dist/images/marker-icon.png';
import marker2x from 'leaflet/dist/images/marker-icon-2x.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

delete L.Icon.Default.prototype._getIconUrl;

L.Icon.Default.mergeOptions({
    iconRetinaUrl: marker2x,
    iconUrl: marker,
    shadowUrl: markerShadow
});

$( document ).ready(function() {
    var leafletAttribution = 'Map &copy; <a href="http://openstreetmap.org">OpenStreetMap</a>, Maptiles &copy; <a href="https://mapbox.com">Mapbox</a>';
    var mapboxAccessToken = repaircafe.config.mapboxAccessToken;

    // Initialize events map
    if(document.getElementById('eventsMap') && mapboxAccessToken !== '') {
        if(repaircafe.events.length === 0) {
            return;
        } else {
            $('#eventsMap').show();
        }

        var eventsMap = L.map('eventsMap', {
            dragging: false,
            touchZoom: false,
            scrollWheelZoom: false,
            doubleClickZoom: false,
            boxZoom: false,
            tap: false
        }).setView([46.817801, 8.258972], 7);
        L.control.locate({
            strings: {
                title: 'Locate me'
            }
        }).addTo(eventsMap);
        L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/{id}/tiles/256/{z}/{x}/{y}@2x?access_token={accessToken}', {
            attribution: leafletAttribution,
            maxZoom: 18,
            id: 'streets-v10',
            accessToken: mapboxAccessToken
        }).addTo(eventsMap);

        // Create event markers
        var eventMarkers = L.markerClusterGroup();
        for(var i = 0; i < repaircafe.events.length; i++) {
            if(repaircafe.events[i].latitude && repaircafe.events[i].longitude) {
                var marker = L.marker(
                    [parseFloat(repaircafe.events[i].latitude), parseFloat(repaircafe.events[i].longitude)]
                );

                var popupContent = '';
                popupContent += '<h2 class="h6"><a href="#event' + repaircafe.events[i].id + '" class="smooth-scroll" data-event-id="' + repaircafe.events[i].id + '">' + repaircafe.events[i].title + '</a></h2>';
                popupContent += '<p>' + repaircafe.events[i].date + '</p>';
                popupContent += '<p>' + repaircafe.events[i].address + '</p>';
                if(repaircafe.events[i].categories.length > 0) {
                    popupContent += '<ul class="list-inline my-2">';
                    for(var j = 0; j < repaircafe.events[i].categories.length; j++) {
                        var category = repaircafe.events[i].categories[j];
                        popupContent += '<li class="list-inline-item mb-2">';
                        popupContent += '<img src="/themes/repair-cafe/assets/images/categories/icon-' + category.slug + '.svg" onerror="this.onerror=null;this.src=\'/themes/repair-cafe/assets/images/categories/icon-' + category.slug + '@2x.png\'" class="category-logo" title="' + category.name + ': ' + category.description + '" />';
                        popupContent += '</li>';
                    }
                    popupContent += '</ul>';
                }

                marker.bindPopup(popupContent);
                eventMarkers.addLayer(marker);
            }
        }

        // Add event markers to map
        eventsMap.addLayer(eventMarkers);

        var eventMarkerBounds = eventMarkers.getBounds();
        // Check if bounds are valid (false if no marker is set)
        if(eventMarkerBounds.isValid()) {
            eventsMap.fitBounds(
                eventMarkers.getBounds(),
                { padding: [10, 10] }
            );
        } else {
            // set zoom to fit whole Switzerland
            eventsMap.fitBounds([
                [47.807787, 8.567448], // North
                [46.937305, 10.487652], // East
                [45.818616, 9.015312], // South
                [46.128802, 5.955620] // West
            ]);
        }

        // Popup content gets generated each time the popup is opened -> we need to attach smoothscrolling behaviour each time a popup opens
        eventsMap.on('popupopen', function (e) {
            // Smooth scrolling when clicking links with smooth-scroll class
            $('.leaflet-popup-content a.smooth-scroll').bind('click', function(event) {
                event.preventDefault();

                var $anchor = $(this);
                var offsetTop = $($anchor.attr('href')).offset().top;

                // open additional event info
                var eventId = $anchor.data('eventId');
                $('#eventAdditionalInfo' + eventId).collapse('show');

                if ('scrollBehavior' in document.documentElement.style) {
                    window.scrollTo({
                        left: 0,
                        top: offsetTop,
                        behavior: 'smooth',
                    });
                } else {
                    window.scrollTo(0, offsetTop);
                }
            });
        });

        // Responsive map clicks
        // enable touch and click on map
        $('#eventsMap').on('click', function () {
            eventsMap.dragging.enable();
            eventsMap.touchZoom.enable();
            eventsMap.scrollWheelZoom.disable(); // scrollwheel zoom should always be disabled
            eventsMap.doubleClickZoom.enable();
            eventsMap.boxZoom.enable();
            if(L.Browser.touch && !L.Browser.pointer) {
                eventsMap.tap.enable();
            }
        });

        $('.disable-map').on('click', function (){
            eventsMap.dragging.disable();
            eventsMap.touchZoom.disable();
            eventsMap.scrollWheelZoom.disable();
            eventsMap.doubleClickZoom.disable();
            eventsMap.boxZoom.disable();
            if(L.Browser.touch && !L.Browser.pointer) {
                eventsMap.tap.disable();
            }
        });
    }
});
