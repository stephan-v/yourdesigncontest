import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

/*
 |--------------------------------------------------------------------------
 | Load all modules in the directory and subdirectories.
 |--------------------------------------------------------------------------
 |
 | We dynamically load all store modules from this directory and subdirectories.
 | Excluding this index.js file.
 |
 */

const files = require.context('.', true, /\.js$/);

const modules = {};

files.keys().forEach((key) => {
    if (key === './index.js') return;
    modules[key.split('/').pop().slice(0, -3)] = files(key).default;
});

/*
 |--------------------------------------------------------------------------
 | Initiate the Vuex store with our store modules.
 |--------------------------------------------------------------------------
 |
 | Store modules allow us to divide our Vuex store into smaller modules.
 |
 */

const store = new Vuex.Store({
    modules,
    strict: process.env.NODE_ENV !== 'production',
});

export default store;
