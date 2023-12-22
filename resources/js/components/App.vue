<template>
  <form>
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label for="formFile" class="form-label">Imagen del Lugar</label>
            <div id="preloadImagen">
              <img alt="" class="img-fluid" v-on:click="" :src="preview">  <!-- src="http://localhost/img/undraw_rocket.svg" -->
            </div>
            <input class="form-control file_upload" type="file" accept="image/*" @change="previewImage" id="mi-img">
          </div>
        </div>
      <div class="col lat-log">
        <div>Latitud: {{ latitud }}</div>
        <div>Longitud: {{ longitud }}</div>
      </div>
    </div>
    <div class="mb-3">
      <label for="nombreubicacion" class="form-label">Nombre Ubicacion <span class="requerido" v-show="nombre_ubicacion == ''">(*)</span></label>
      <input type="text" class="form-control" id="nombreubicacion" aria-describedby="emailHelp" placeholder="Nombre de la Ubicacion" v-model="nombre_ubicacion">
      <span class="requerido texto-error" v-show="nombre_ubicacion == ''">El campo es requerido</span>
    </div>
    <div class="mb-3">
      <label for="fecha" class="form-label">Fecha</label>
      <input type="text" class="form-control" id="fecha" v-model="fecha" readonly>
    </div>
    <div class="mb-3">
      <label for="direccion" class="form-label">Direccion <span class="requerido" v-show="direccion == ''">(*)</span></label>
      <input type="text" class="form-control" id="direccion" placeholder="Introduzca la direccion" v-model="direccion">
      <span class="requerido texto-error" v-show="direccion == ''">El campo es requerido</span>
    </div>
    <div class="mb-3">
      <label for="numerocontacto" class="form-label">Numero de Contacto <span class="requerido" v-show="numero_contacto == ''">(*)</span></label>
      <input type="text" class="form-control" id="numerocontacto" placeholder="Introduzca el nombre de contacto" v-model="numero_contacto">
      <span class="requerido texto-error" v-show="numero_contacto == ''">El campo es requerido</span>
    </div>
    <div class="mb-3">
      <label for="nota" class="form-label">Nota</label>
      <input type="text" class="form-control" id="nota" placeholder="Introduzca alguna nota" v-model="nota">
    </div>

    <div class="mb-3">
        <label for="grupo" class="form-label">Grupo <span class="requerido" v-show="grupo_seleccionado == ''">(*)</span></label>
        <select class="form-select" aria-label="Default select example" v-model="grupo_seleccionado">
          <option value="0" selected disabled>Seleccione una opcion ...</option>
          <option v-for="grupo in grupos" :value="grupo.id">{{ grupo.nombre}}</option>
        </select>
        <span class="requerido texto-error" v-show="grupo_seleccionado == ''">El campo es requerido</span>
    </div>
    
    <button type="submit" class="btn btn-primary" :disabled="!sicompleto" @click="registrarCliente">Guardar</button>
  </form>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import Swal from 'sweetalert2';

export default {
        data(){
            return{
                pagination:{
                    'total' :0,
                    'current_page':0,
                    'per_page':0,
                    'last_page':0,
                    'from':0,
                    'to':0
                },
                longitud:0,
                latitud:0,
                nombre_ubicacion:"",
                fecha:"",
                direccion:"",
                numero_contacto:"",
                nota:"",
                grupo_seleccionado:0,
                grupos:[],
                valor_color:"#563d7c",
                
                preview: null,
                image: null,
                preview_list: [],
                image_list: [],
            }

        },
        computed:{
            
            sicompleto(){
                let me=this;
                if (me.longitud!=0 && me.latitud !=0 && me.direccion!='' && me.numero_contacto!="" && me.grupo_seleccionado!=0 && me.nombre_ubicacion != "")
                    return true;
                else
                    return false;
            },
        },
        methods :{

            caracteresPermitidosTelefono(ex){
                let me=this;
                if(ex.keyCode==32 || ex.keyCode==43 || ex.keyCode==8 || ex.keyCode == 45 || (ex.keyCode >= 48 && ex.keyCode <= 57) )
                {
                    me.telefono = me.telefono+ex.key;
                } 
            },

            fechaActual(){
              let me = this;
              var url='/obtenerFechaActual';
                axios.get(url).then(function(response){
                    me.fecha=response.data;
                })
                .catch(function(error){
                    console.log(error.message);
                });
            },

            listarGrupos(){
              let me = this;
              var url='/listarGrupos';
                axios.get(url).then(function(response){
                    me.grupos = response.data;
                })
                .catch(function(error){
                    console.log(error.message);
                });
            },

            selectDepartamentos(){
                let me=this;
                var url='/depto/selectdepto';
                axios.get(url).then(function(response){
                    var respuesta=response.data;
                    me.arrayDepto=respuesta;
                })
                .catch(function(error){
                    error401(error);
                    console.log(error);
                });
            },

            selectAll: function (event) {
                setTimeout(function () {
                    event.target.select()
                }, 0)
            },

            obtenerMiUbicacion() {
              let me = this;
              if (navigator.geolocation) {
                var success = function (position) {
                  me.latitud = position.coords.latitude;
                  me.longitud = position.coords.longitude;
                  console.log(position);
                }
                navigator.geolocation.getCurrentPosition(success, function (msg) {
                  console.error(msg);
                });
              }
            },

            registrarCliente(){
              let me=this;
              var formData = new FormData();
              console.log("Imgen para enviar");
              console.log(document.getElementById('mi-img').files[0]);
              formData.append('file', document.getElementById('mi-img').files[0]);
              formData.append('latitud', me.latitud);
              formData.append('longitud', me.longitud);
              formData.append('nombre_ubicacion', me.nombre_ubicacion);
              formData.append('fecha', me.fecha);
              formData.append('direccion', me.direccion);
              formData.append('numero_contacto', me.numero_contacto);
              formData.append('nota', me.nota);
              formData.append('id_grupo', me.grupo_seleccionado);
               
                axios.post('/crearCliente',formData,{
                  headers: {
                    'Content-Type': 'multipart/form-data'
                  }
                })
                .then(function(response){
                  Swal.fire({
                    title: "Cliente almacenado correctamente",
                    icon: "success"
                  });
                    console.log(response);
                })
                .catch(function(error){
                    console.log(error);
                });
            },


            previewImage: function (event) {
              var input = event.target;
              if (input.files) {
                var reader = new FileReader();
                reader.onload = (e) => {
                  this.preview = e.target.result;
                }
                this.image = input.files[0];
                reader.readAsDataURL(input.files[0]);
              }
            },

        },

        mounted() {
            
            this.fechaActual();
            this.obtenerMiUbicacion();
            this.listarGrupos();
        }
    }

</script>


<style scoped>
  #formFile{
    width: 50%;
    height: 150px;
  }

  #preloadImagen{
    width: 100%;
    border: solid 1px silver;
  }

  .file_upload {
   opacity: 0.0;

   /* IE 8 */
   -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";

   /* IE 5-7 */
   filter: alpha(opacity=0);
 
   /* Netscape or and older firefox browsers */
   -moz-opacity: 0.0;

   /* older Safari browsers */
   -khtml-opacity: 0.0;

   position: absolute;
   top: 0;
   left: 0;
   bottom: 0;
   right: 0;
   width: 100%;
   height:100%;
}

.lat-log{
  position: relative;
  margin: auto;
  font-weight: 800;
}

.requerido{
  color: red;
}
.texto-error {
  margin: 0;
  font-size: 11px;
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}
</style>