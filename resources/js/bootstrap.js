import Axios from 'axios';
import Echo from 'laravel-echo';
import Vue from 'vue';

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
 * @type {AxiosStatic}
 */

window.axios = Axios;

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
});
