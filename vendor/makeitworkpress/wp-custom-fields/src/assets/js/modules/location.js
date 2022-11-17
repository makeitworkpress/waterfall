/**
 * Our location field
 */
module.exports.init = function(framework) {
    
    jQuery(framework).find('.wpcf-location').each(function (index) {
        var searchInput = jQuery('.wpcf-map-search', this).get(0),
            mapCanvas = jQuery('.wpcf-map-canvas', this).get(0),
            latitude = jQuery('.latitude', this),
            longitude = jQuery('.longitude', this),
            city = jQuery('.city', this),
            country = jQuery('.country', this),
            zip = jQuery('.postal_code', this),
            street = jQuery('.street', this),
            state = jQuery('.state', this),
            number = jQuery('.number', this),
            latLng = new google.maps.LatLng(52.2129918, 5.2793703),
            zoom = 7;            

        // Map
        if( latitude.val() && longitude.val() ) {
            latLng = new google.maps.LatLng(latitude.val(), longitude.val());
            zoom = 15;
        }

        // Map Options
        var mapOptions = {
                scrollwheel: false,
                center: latLng,
                zoom: zoom,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            },
            map = new google.maps.Map(mapCanvas, mapOptions),
            markerOptions = {
                map: map,
                draggable: false,
            },
            marker = new google.maps.Marker(markerOptions),
            autocomplete = new google.maps.places.Autocomplete(searchInput, {
                types: ['geocode']
            });

        if (latitude.val().length > 0 && longitude.val().length > 0) {
            marker.setPosition(latLng);
        }

        // Search
        autocomplete.bindTo('bounds', map);

        google.maps.event.addListener(autocomplete, 'place_changed', function() {

            var place   	= autocomplete.getPlace(),
                components  = place.address_components;

            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setPosition(place.geometry.location);
            latitude.val(place.geometry.location.lat());
            longitude.val(place.geometry.location.lng());

            // Fill in our components
            if (components) {
                for (var i = 0; i < components.length; i++) {
                    var component = components[i],
                        types = component.types;

                    if (types.indexOf('street_number') != -1) {
                        number.val(component.long_name);
                    } else if (types.indexOf('route') != -1) {
                        street.val(component.long_name);
                    } else if (types.indexOf('locality') != -1) {
                        city.val(component.long_name);
                    } else if (types.indexOf('postal_code') != -1) {
                        zip.val(component.long_name);
                    } else if (types.indexOf('administrative_area_level_1') != -1) {
                        state.val(component.long_name);
                    } else if (types.indexOf('country') != -1) {
                        country.val(component.long_name);
                    }
                }
            }

        }); 

    });  
};