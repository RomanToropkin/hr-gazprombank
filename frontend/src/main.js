import Vue from 'vue'
import App from './App.vue'
import * as Tabs from 'vue-slim-tabs'
import router from './Router.js';


Vue.use(Tabs);


new Vue({
    el: '#app',
    router,
    render: h => h(App)
});

//Vue.config.keyCodes.backspace = 8;


