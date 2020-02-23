const state = {
    locked: false,
};

const getters = {
    locked: (state) => state.locked,
};

const actions = {
    //
};

const mutations = {
    locked(state, locked) {
        state.locked = locked;
    },
};

export default {
    namespaced: true,
    getters,
    mutations,
    state,
    actions,
};
