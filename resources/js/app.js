/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import {createApp} from 'vue';
import {createStore} from 'vuex';
import MedianViewersComponent from './components/MedianViewersComponent.vue';
import TotalStreamsComponent from './components/TotalStreamsComponent.vue';
import TotalViewersComponent from './components/TotalViewersComponent.vue';
import TotalEvenAndOddsComponent from './components/TotalEvenAndOddsComponent.vue';
import SameViewersStreamsComponent from './components/SameViewersStreamsComponent.vue';
import TopHundredStreamsComponent from './components/TopHundredStreamsComponent.vue';

const store = createStore({
    state() {
        return {
            url: "https://app.streamstats.test/api/",
            api_version: 'v1',
            streams: []
        }
    },
    getters: {
        getApiUrl(state) {
            return state.url
        },
        getStreamsUrl(){
            return this.getters.getApiUrl+'streams'
        }
    },
    mutations: {
        toggleApiVersion(state) {
            if (state.api_version === 'v1') {
                state.api_version = 'v2';
            } else {
                state.api_version = 'v1';
            }
        }
    }
})

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});
app.use(store)
app.component('total-streams-component', TotalStreamsComponent);
app.component('median-viewers-component', MedianViewersComponent);
app.component('total-viewers-component', TotalViewersComponent);
app.component('total-even-and-odds-component', TotalEvenAndOddsComponent);
app.component('same-viewers-streams-component', SameViewersStreamsComponent);
app.component('top-hundred-streams-component', TopHundredStreamsComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.globEager('./**/*.vue')).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
