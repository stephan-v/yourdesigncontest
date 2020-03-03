import Axios from 'axios';
import Echo from 'laravel-echo';
import Vue from 'vue';
import vClickOutside from 'v-click-outside';

/**
 * Autoload the Vue components and register them globally.
 *
 * This will allow for components to be added and used without having to manually register them.
 */

const components = require.context('./components', true, /[A-Z]\w+\.vue$/);

components.keys().forEach((path) => {
    const component = components(path);

    // Grab the fileName for the component(ComponentName.vue).
    const fileName = path.split('/').pop();

    // Strip the extension(ComponentName).
    const componentName = fileName.slice(0, -4);

    // Dynamically register the component.
    Vue.component(componentName, component.default || component);
});

/**
 * Register the Axios instance globally.
 *
 * Set the API token for Axios requests.
 */

window.axios = Axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token = document.head.querySelector('meta[name="api-token"]');

if (token) {
    // eslint-disable-next-line
    window.axios.defaults.headers.common['Authorization'] = `Bearer ${token.content}`;
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

if (!process.env.MIX_PUSHER_APP_KEY.length) {
    console.error('A PUSHER_APP_KEY has not been provided in your .env file.');
}

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
});

/**
 * Global v-click-outside directive.
 */
Vue.use(vClickOutside);
