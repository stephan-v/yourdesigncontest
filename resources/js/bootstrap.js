import Axios from 'axios';
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
