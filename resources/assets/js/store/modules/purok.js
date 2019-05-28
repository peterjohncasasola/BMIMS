const state = {
    puroks: []
};

const mutations = {
    SET_DATA(state, payload) {
        state.puroks = payload;
    },
    UPDATE_DATA(state, { purok, newPurok }) {
        Object.assign(purok, newPurok);
    },
    ADD_DATA(state, payload) {
        state.puroks.unshift(payload);
    },
    REMOVE_DATA(state, index) {
        state.puroks.splice(index, 1);
    }
};
const getters = {
    getPuroks(state) {
        return state.puroks;
    }
};

const actions = {
    async fetch({ commit }) {
        await axios
            .get("/api/purok")
            .then(response => {
                console.log(response.data);
                commit("SET_DATA", response.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    getById({ commit }, id) {
        return axios.get("/api/purok/" + id).then(response => {
            commit("SET_DATA", response.data);
        });
    },

    update({ state, commit }, payload) {
        axios
            .patch("/api/purok/" + payload.id)
            .then(response => {
                console.log("Success");
            })
            .catch(error => {
                console.log(error);
            });
    },
    create({ commit }, payload) {
        return axios
            .post("/api/purok", payload)
            .then(response => {
                commit("ADD_DATA", response.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    delete({ state, commit }, payload) {
        const index = state.puroks.indexOf(payload);
        commit("REMOVE_DATA", index);
        axios.delete("/api/purok/" + payload.id);
    },
    commit_data({ commit }, payload) {
        commit("ADD_DATA", payload);
    }
};

export default {
    namespaced: true,
    state,
    mutations,
    getters,
    actions
};
