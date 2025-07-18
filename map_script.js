let map;
        let marker;

        function initMap() {
            const mapOptions = {
                center: { lat: -34.397, lng: 150.644 },
                zoom: 8
            };
            map = new google.maps.Map(document.getElementById('map'), mapOptions);

            const input = document.getElementById('search-input');
            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);

            map.addListener('click', function(event) {
                placeMarker(event.latLng);
            });

            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }

                map.setCenter(place.geometry.location);
                map.setZoom(17); 

                placeMarker(place.geometry.location);
            });
        }

        function placeMarker(location) {
            if (marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
            document.getElementById('locationInput').value = location.lat() + ", " + location.lng();
        }

        document.getElementById('generateLink').addEventListener('click', function() {
            const locationInput = document.getElementById('locationInput').value;
            if (locationInput) {
                const link = `https://www.google.com/maps?q=${locationInput}`;
                document.getElementById('mapLink').value = link;
                window.open(link, '_blank');
            }
        });

        function searchLocation() {
            let searchQuery = document.getElementById("search-input").value.trim();
            if (searchQuery !== "") {
                let encodedQuery = encodeURIComponent(searchQuery);
                let geocoder = new google.maps.Geocoder();

                geocoder.geocode({ address: searchQuery }, function(results, status) {
                    if (status === "OK") {
                        map.setCenter(results[0].geometry.location);
                        map.setZoom(17);
                        placeMarker(results[0].geometry.location);
                    } else {
                        alert("Location not found: " + status);
                    }
                });
            }
        }