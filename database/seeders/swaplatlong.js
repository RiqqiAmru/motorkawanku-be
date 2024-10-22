import lama from "./kecPekalonganCoordinate.json" with {type:'json'};
import fs from 'fs'
function swapCoordinates(geojson) {
    // Iterate over all features in the GeoJSON object
    geojson.forEach((feature) => {
        // Access the coordinates array
        feature.geometry.coordinates = feature.geometry.coordinates.map(
            (multiPolygon) =>
                multiPolygon.map((polygon) =>
                    polygon.map((coordinate) =>
                        // Swap the [longitude, latitude] to [latitude, longitude]
                        [coordinate[1], coordinate[0]]
                    )
                )
        );
    });
    return geojson;
}


let baru = swapCoordinates(lama);
fs.writeFileSync('baru.json',JSON.stringify(baru))

