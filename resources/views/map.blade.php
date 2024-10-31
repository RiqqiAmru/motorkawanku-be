<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>map</title>
    <style>
        html,
        body,
        #map {
            height: 100%;
            width: 100%;
            padding: 0;
            margin: 0;
        }
    </style>
    <!-- Leaflet (JS/CSS) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <!-- Leaflet-KMZ -->
    <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
</head>

<body>
    <div id="map"></div>
    <script>
        var map = L.map('map', {
            preferCanvas: true // recommended when loading large layers.
        });
        // [-6.8908, 109.6756], 13
        map.setView([-6.8908, 109.6756], 13);

        var OpenTopoMap = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 17,
            attribution: '&copy; <a href=\'https://www.openstreetmap.org/copyright\'>OpenStreetMap</a>',
            opacity: 0.90
        });
        OpenTopoMap.addTo(map);

        // Instantiate KMZ layer (async)
        var kmz = L.kmzLayer().addTo(map);

        kmz.on('load', function(e) {
            control.addOverlay(e.layer, e.name);
            // e.layer.addTo(map);
        });

        // Add remote KMZ files as layers (NB if they are 3rd-party servers, they MUST have CORS enabled)
        kmz.load('sk2020.kmz');
        kmz.load('sk2024.kmz');

        var control = L.control.layers(null, null, {
            collapsed: false
        }).addTo(map);
    </script>
</body>

</html>
