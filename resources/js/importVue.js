import { createApp } from 'vue'

import App from './components/App.vue';
import mapa_clientes from './components/MapaClientes.vue';

createApp(App).mount("#app");
createApp(mapa_clientes).mount("#mapaClientes");




// const app = createApp({})

// import mapa_clientes from './components/MapaClientes.vue';

// app.component('#mapaClientes',mapa_clientes)

// .mount('\\#app');