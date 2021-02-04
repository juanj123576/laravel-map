const { default: Axios } = require('axios');

window.Vue = require('vue');
import Map from './Map.vue';
const app = window.App = new Vue({

    el: '#finca',
    components: {
        Map
    },
    data:{
      fincas:[],
        finca:{nombre:'',municipio:'',departamento:''},
        mapName: "map",


    }, created(){

        this.traerFincas();




    },

    methods:
        {

            init: function(){
                this.$broadcast('MapsApiLoaded');
            },

            traerFincas(){
                Axios.get('/fincas')
                    .then((res) =>{
                        this.fincas = res.data;
                        console.log(res.data);
                    })
            },
            verFinca(usuario){
                /*console.log(usuario);*/
                window.location.href =`/page?direccion=`+usuario.direccion  ;

                /* Axios.get('/page')
                 .then((res) =>{

                 })*/
            },
            agregarFinca(){
                const fincaNuevo = this.finca;
                this.finca = {nombre:'',municipio:'',departamento:''};
                Axios.post('/enviarfinca', fincaNuevo)
                    .then((res) =>{
                        const fincaServidor = res.data;
                        this.fincas.push(fincaServidor);

                    })
            },



        }

});
