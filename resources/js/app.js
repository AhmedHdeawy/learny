require('./bootstrap');
window.Vue = require('vue');


// Moment
import moment from 'moment';

// API
import api from './api';
window.dashboardAPI = api;

// Globale
import global from './global';
window.globalVars = global;

// Vue Router
import VueRouter from 'vue-router';
Vue.use(VueRouter)
import {routes} from './router';

// V-Form
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

// Global variable
window.Fire = new Vue();

// DateTime
import Datetime from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'
Vue.use(Datetime)

// Vue Select
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

// Sweet Alert
import Swal from 'sweetalert2'
window.Swal = Swal;

// handle sweet alert
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;

// Spinner
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
import BounceLoader from 'vue-spinner/src/BounceLoader.vue'
import MoonLoader from 'vue-spinner/src/MoonLoader.vue'
Vue.component('pulse-loader', PulseLoader);
Vue.component('bounce-loader', BounceLoader);
Vue.component('moon-loader', MoonLoader);

// Configure Vue Router
const router = new VueRouter({
    mode: 'history',
    routes,
  	saveScrollPosition: true,
  	history:true,
  	scrollBehavior (to, from, savedPosition) {
  		if (savedPosition) {
  			return savedPosition
  		} else {
  			return { x: 0, y: 0 }
  		}
  	}
});


// Filter text to make it Upper Case
Vue.filter('upText', function(value){
    return value.charAt(0).toUpperCase() + value.slice(1);
});

Vue.filter('formateCreatedAt', function(created_at){
    return moment(created_at).format('MMMM Do YY');
});


// Configure Common Components

// import imageUpload from './components/common/imageUpload';

Vue.component(
    'image-upload',
    require('./components/common/imageUpload')
);

Vue.component(
    'pagination',
    require('laravel-vue-pagination')
);



// Make Vue Instance
const app = new Vue({
    el: '#app',
    router,
    data: {
        search: ''
    },
    methods: {
        getSearch(){
            Fire.$emit('searching');
        }
    }
});
