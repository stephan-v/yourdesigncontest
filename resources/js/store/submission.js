const state = {
    palette: [],
};

const getters = {
    palette: (state) => state.palette,
};

const actions = {
    //
};

const mutations = {
    palette(state, palette) {
        state.palette = palette;
    },
};

export default {
    namespaced: true,
    getters,
    mutations,
    state,
    actions,
};
