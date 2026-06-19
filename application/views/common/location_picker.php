<?php
// Default values (can be overridden)
$label   = $label   ?? 'Select Location';
$mapId   = $mapId   ?? 'map';
$inputId = $inputId ?? 'autocomplete';
$latId   = $latId   ?? 'latitude';
$lngId   = $lngId   ?? 'longitude';
?>
<div class="location-picker mb-4">
    <label><?= $label ?></label>

    <input
        type="text"
        id="<?= $inputId ?>"
        class="form-control mb-2"
        placeholder="Search your location..."
        autocomplete="off"
    >

    <div id="<?= $mapId ?>" style="width:100%; height:300px; border-radius:8px;"></div>

</div>

<script>
(function () {

    let map, marker, autocomplete;

    window.initMap_<?= $mapId ?> = function () {

        const defaultLocation = { lat: 26.9124, lng: 75.7873 }; // Jaipur

        map = new google.maps.Map(document.getElementById('<?= $mapId ?>'), {
            center: defaultLocation,
            zoom: 13
        });

        marker = new google.maps.Marker({
            map: map,
            position: defaultLocation,
            draggable: true
        });

        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('<?= $inputId ?>'),
            { types: ['geocode'] }
        );

        autocomplete.addListener('place_changed', function () {
            const place = autocomplete.getPlace();
            if (!place.geometry) return;

            const loc = place.geometry.location;
            map.setCenter(loc);
            map.setZoom(15);
            marker.setPosition(loc);
            update(loc.lat().toFixed(6), loc.lng().toFixed(6));
        });

        marker.addListener('dragend', function (e) {
            update(e.latLng.lat().toFixed(6), e.latLng.lng().toFixed(6));
        });

        function update(lat, lng) {
            document.getElementById('<?= $latId ?>').value = lat;
            document.getElementById('<?= $lngId ?>').value = lng;
        }
    };

})();
</script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCobHx38xPOGViCcqgs2uz_1UT94ls3Y_w&libraries=places">
</script>

