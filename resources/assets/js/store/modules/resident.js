const state = {
    resident: []
};

const mutations = {
    SET_DATA(state, payload) {
        state.resident = payload;
    },
    UPDATE_DATA(state, { resident, newresident }) {
        Object.assign(resident, newresident);
    },
    ADD_DATA(state, payload) {
        state.resident.unshift(payload);
    },
    REMOVE_DATA(state, index) {
        state.resident.splice(index, 1);
    }
};
const getters = {
    getResidents(state) {
        return state.resident;
    }
};

const actions = {
    fetch({ commit }) {
        axios
            .get("/api/residents")
            .then(response => {
                console.log(response.data);
                commit("SET_DATA", response.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    getById({ commit }, id) {
        axios.get("/api/residents/" + id).then(response => {
            commit("SET_DATA", response.data.data);
        });
    },

    update({ state, commit }, payload) {
        axios
            .patch("/api/residents/" + payload.id)
            .then(response => {
                commit("UPDATE_DATA", response.data);
                console.log("Success");
            })
            .catch(error => {
                console.log(error);
            });
    },
    create({ commit }, payload) {
        return axios
            .post("/api/residents", payload)
            .then(response => {
                commit("ADD_DATA", response.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    delete({ state, commit }, payload) {
        const index = state.resident.indexOf(payload);
        commit("REMOVE_DATA", index);
        axios.delete("/api/residents/" + payload.id);
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
