const state = {
    user: window.user,
};

const getters = {
    authenticated: (state) => state.user && state.user.email_verified_at,
    user: (state) => state.user,
};

const actions = {
    //
};

const mutations = {
    login(state, user) {
        state.user = user;
    },

    logout(state) {
        state.user = null;
    },
};

export default {
    namespaced: true,
    getters,
    mutations,
    state,
    actions,
};
