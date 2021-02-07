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
        finca:{nombre:'',municipio:'',departamento:'',direccion:''},
        modoEditar: false,



    }, created(){

        this.traerFincas();




    },

    methods:
        {

            init: function(){
                this.$emit('MapsApiLoaded');
            },

            traerFincas(){
                Axios.get('/fincas')
                    .then((res) =>{
                        this.fincas = res.data;
                        console.log(res.data);
                    })
            }, cambiarEditar(item){
                this.finca.nombre = item.nombre;
                this.finca.municipio = item.municipio;
                this.finca.departamento= item.departamento;
                this.finca.id = item.id;
                this.modoEditar = true;
            },
            cambiarAgregar(){

                this.modoEditar = false;
            },
            editarFinca(finca){
                const params = {nombre: finca.nombre, direccion: finca.direccion,municipio:finca.municipio,departamento:finca.departamento};
                axios.put(`/fincas/${finca.id}`, params)
                    .then(res=>{
                        this.modoEditar = false;
                        const index = this.fincas.findIndex(item => item.id === finca.id);
                        this.fincas[index] = res.data;
                    })
            },
            agregarFinca(){
                if(this.finca.nombre.trim() === '' && this.finca.direccion.trim() === ''&& this.finca.municipio.trim() === '' && this.finca.departamento.trim() === ''  ){
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                const fincaNuevo = this.finca;
                this.finca = {nombre:'',municipio:'',departamento:'',direccion: ''};
                Axios.post('/enviarfinca', fincaNuevo)
                    .then((res) =>{
                        const fincaServidor = res.data;
                        this.fincas.push(fincaServidor);

                    })
            },



        }

});
