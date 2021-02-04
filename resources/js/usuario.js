const { default: Axios } = require('axios');

window.Vue = require('vue');
const app = new Vue({

    el: '#usuario',
    data:{
        nombre: '',
        password: '',
       direccion:'',
       email:'',
     marcadores:[],
     usuarios:[],

    }, created(){
      this.traerUsarios();
    },

    methods:
    {



          traerUsarios(){
            Axios.get('/usuarios')
            .then((res) =>{
              this.usuarios = res.data;
            })

          },
          verFinca(usuario){
            /*console.log(usuario);*/
            window.location.href =`/page?direccion=`+usuario.direccion  ;

           /* Axios.get('/page')
            .then((res) =>{

            })*/
          },


    }

});
