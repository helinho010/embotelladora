<template>
    <div id="mapContainer" style="height:400px; width:100%"></div>
</template>
  
  <script>
  import "leaflet/dist/leaflet.css";
  import { LMap, LTileLayer } from "@vue-leaflet/vue-leaflet";
  import L from "leaflet";
  import icon from 'leaflet/dist/images/marker-icon.png';
  import iconShadow from 'leaflet/dist/images/marker-shadow.png';

let DefaultIcon = L.icon({
    iconUrl: icon,
    shadowUrl: iconShadow
});

L.Marker.prototype.options.icon = DefaultIcon;
  
  export default {
    components: {
      LMap,
      LTileLayer,
    },

    data() {
      return {
        zoom: 50,
        latitud:-16.515072,
        longitud:-68.1443328,
        nombre_ubicacion:"",
        fecha:"",
        direccion:"Villa Pabon calle Tte. Rosendo Villa #1515",
        numero_contacto:"",
        nota:"Señora de los gatos",
        grupo_seleccionado:0,
        grupos:[],
        clientes:[],
        valor_color:"#563d7c",
        map:null,


        prueba:"",
      };
    },

    methods :{
      
      listarGrupos() {
        let me = this;
        var url = '/listarGrupos';
        axios.get(url).then(function (response) {
          me.grupos = response.data;
        })
          .catch(function (error) {
            console.log(error.message);
          });
      },

      listarClientes(){
        let me = this;
        let url = '/listarClientes';
        axios.get(url).then(function (response) {
          me.clientes = response.data;
          console.log(me.clientes);
        })
          .catch(function (error) {
            console.log(error.message);
          });
      },

      cargarMapaClientes(){
        let me = this;
        let url = '/listarClientes';
        axios.get(url).then(function (response) {
          me.clientes = response.data;
          me.map = L.map("mapContainer").setView([-16.49430,-68.12749], 13);
          L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
          attribution:
            '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
          }).addTo(me.map);
          me.clientes.forEach(cliente => {
          L.marker([cliente.latitud,cliente.longitud], {title: cliente.direccion, alt:"Que sera esto"})
                .addTo(me.map)
                .bindPopup('<div class="alert alert-primary" role="alert">'+
                  'Nota: '+cliente.nota + '<br>' +
                  'Celular: '+cliente.numero_contacto + '<br>' +
                  '<a class="text-success" href="https://maps.google.com/?q='+ cliente.latitud +","+cliente.longitud+'">Ir a la Ubicacion</a>'+ 
                  '</div>')
                .openPopup();  
        });
        console.log("Icono")
        console.log(L.Icon.Default.prototype._getIconUrl());

        })
          .catch(function (error) {
            console.log(error.message);
          });
        
        
          
      },
    },

    mounted(){
      this.cargarMapaClientes();     
    }
  };
  </script>
  
<style>

</style>