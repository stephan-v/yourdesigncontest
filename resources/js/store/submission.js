const state = {
    palette: [],
    submission: null,
};

const getters = {
    palette: (state) => state.palette,
    submission: (state) => state.submission,
};

const mutations = {
    palette(state, palette) {
        state.palette = palette;
    },

    submission(state, submission) {
        state.submission = submission;
    },
};

export default {
    namespaced: true,
    getters,
    mutations,
    state,
};
