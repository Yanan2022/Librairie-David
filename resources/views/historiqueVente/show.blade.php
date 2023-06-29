@extends('welcome')
@section('title','Livraison')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="py-3">
                <h4 id="results"></h4>
            </div>
            <div id="map" style="height: 600px; width: 100%"></div>
        </div>
    </div>

    <script>
        var points = {
            depart: {
                lng: {{ $liv->long }},
                lat: {{ $liv->lat }}
            },
            arrivee: {
                lat: {{ $liv->lat_Arrive }},
                lng: {{ $liv->long_Arrive }}
            }
        };

        var vehicules = @json($vehicules);

        var map = L.map('map').setView([5.3203570, -4.0161070], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.Routing.control({
            language: 'fr',
            formatter:  new L.Routing.Formatter({
                language: 'fr' 
            }),
            waypoints: [
                points.depart,
                points.arrivee
            ],
            routeWhileDragging: true
        }).addTo(map);


        // We'll append our markers to this global variable
        var json_group = new L.FeatureGroup();
        // This is the circle on the map that will be determine how many markers are around
        var circle = L.circle(points.depart, 5000, {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.1,
                clickable: false
            }).addTo(map);

        // This figures out how many points are within out circle
        function pointsInCircle(meters_user_set = 5000) {
            var resultsSet = [];
                json_group.eachLayer(function (layer) {
                    // Lat, long of current point
                     let layer_lat_long = layer.getLatLng();

                    // Distance from our circle marker
                    // To current point in meters
                    let distance_from_layer_circle = layer_lat_long.distanceTo(points.depart);

                    // The user has selected
                    if (distance_from_layer_circle <= meters_user_set) {
                        resultsSet.push(layer_lat_long);
                    }
                });

            return resultsSet;
        };

        // This loops through the data in our JSON file
        // And puts it on the map
        vehicules.forEach(v => {
            // Add to our marker
            // Options for our circle marker
            var layer_marker = L.marker([v.lat, v.long]).addTo(map);

            // Add events to marker
            // layer_marker.on({
            //     // What happens when mouse hovers markers
            //     mouseover: function(e) {
            //         var layer_marker = e.target;
            //     },
            //     // What happens when mouse leaves the marker
            //     mouseout: function(e) {
            //         var layer_marker = e.target;
            //     }
            // });

            json_group.addLayer(layer_marker);
        });

        // Add our markers in our JSON file on the map
        map.addLayer(json_group);
        
        var r = pointsInCircle();
            document.getElementById("results").innerHTML = (r.length) ? "Il y a "+r.length+" véhicules disponibles à proximité." : "Il y n'a aucun véhicule disponible à proximité.";

    </script>
@endsection