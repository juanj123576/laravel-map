const { default: Axios } = require('axios');

window.Vue = require('vue');
const app = window.App= new Vue({

    el: '#usuario',
    data:{
        nombre: '',
        password: '',
       direccion:'',
       email:'',


        usuario:{},
     usuarios:[],
        fincas:[],
        fincas2:[],
        fincasusuario:''

    }, created(){
      this.traerUsarios();
        this.traerFincasdireccion();

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

              Axios.get(`/usuariofincas/${usuario.id}`)
                  .then((res) =>{
                      this.fincas = res.data;
                      console.log(this.fincas);

                  })



          },
        traerFincasdireccion(){
            let direccion;
            Axios.get(`/fincasUsuario/`)
                .then((res) =>{
                    this.fincasusuario = res.data;
                    this.fincas2=res.data;
                    direccion=this.fincasusuario[0].direccion;


                })



        },
        verFincasUsuario(finca){
            window.location.href =`/page?direccion=`+finca.direccion  ;
        },
        enviardireccion(finca){

        $('#nombre').val(finca.direccion);
           console.log($('#nombre').val());


        },
        enviardireccion2(finca){

            $('#nombre2').val(finca.direccion);
            console.log($('#nombre2').val());


        }




    }

});
