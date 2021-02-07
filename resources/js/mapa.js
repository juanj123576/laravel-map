const { default: Axios } = require('axios');

window.Vue = require('vue');
const appp = window.App= new Vue({
data:{

},  create() {
        this.createMap();
    },
    methods: {
        createMap: function(){
            let map;

            map = new google.maps.Map($('map'), {
                center: {lat: -12.1430911, lng: -77.0227697},
                zoom: 12
            });
        }
    }

})

