<template>
    <div>
        <h3>Map</h3>
        <div id="map"></div>
    </div>
</template>


<script>
export default {
    data() {
        return {
            map: null
        };
    },

    events: {
        MapsApiLoaded: function(){
            this.createMap();
        }
    },

    methods: {
        createMap: function(){
            this.map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -12.1430911, lng: -77.0227697},
                zoom: 12
            });
        }
    }
};
</script>


<style >
#map{
    with: 500px;
    height: 500px;
}
</style>
