const state = {
    component: '',
};

const getters = {
    component: (state) => state.component,
};

const mutations = {
    component(state, component) {
        state.component = component;
    },

    close() {
        state.component = '';
    },
};

export default {
    namespaced: true,
    getters,
    mutations,
    state,
};
