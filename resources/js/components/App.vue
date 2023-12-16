<template>
  <form>
    <div class="mb-3">
      <label for="formFile" class="form-label">Imagen del Lugar</label>
      <div id="preloadImagen">
        <img src="http://localhost/img/undraw_rocket.svg" alt="" class="img-fluid" v-on:click="">
      </div>
      <input class="form-control" type="file">
    </div>
    <div class="mb-3">
      <label for="nombreubicacion" class="form-label">Nombre Ubicacion</label>
      <input type="text" class="form-control" id="nombreubicacion" aria-describedby="emailHelp" placeholder="Nombre de la Ubicacion">
    </div>
    <div class="mb-3">
      <label for="fecha" class="form-label">Fecha</label>
      <input type="date" class="form-control" id="fecha" disabled>
    </div>
    <div class="mb-3">
      <label for="direccion" class="form-label">Direccion</label>
      <input type="text" class="form-control" id="direccion" placeholder="Introduzca la direccion">
    </div>
    <div class="mb-3">
      <label for="numerocontacto" class="form-label">Numero de Contacto</label>
      <input type="text" class="form-control" id="numerocontacto" placeholder="Introduzca el nombre de contacto">
    </div>
    <div class="mb-3">
      <label for="nota" class="form-label">Nota</label>
      <input type="text" class="form-control" id="nota" placeholder="Introduzca alguna nota">
    </div>

    <div class="mb-3">
        <label for="grupo" class="form-label">Grupo</label>
        <select class="form-select" aria-label="Default select example">
          <option selected>Open this select menu</option>
          <option value="1">One</option>
          <option value="2">red</option>
          <option value="3">Agregar Nuevo Grupo</option>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
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
            }

        },
        computed:{
            
            sicompleto(){
                let me=this;
                if (me.nombrealmacen!='' && me.direccion!='' && me.departamento!=0 && me.ciudad!='')
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

        },

        mounted() {
            //this.selectRubros();
        }
    }

</script>


<style scoped>
  #formFile{
    width: 50%;
    height: 150px;
  }

  #preloadImagen{
    width: 50%;
    height: 150px;
    border: solid 1px red;
  }
</style>