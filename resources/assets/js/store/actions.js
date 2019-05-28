let actions = {
    GET_PUROKS({ commit }) {
        axios
            .get("/api/purok")
            .then(response => {
                console.log(response.data);
                commit("SET_DATA", response.data.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    getById({ commit }, id) {
        axios.get("/api/purok/" + id).then(response => {
            commit("SET_DATA", response.data);
        });
    },

    UPDATE_PUROK({ state, commit }, payload) {
        axios
            .patch("/api/purok/" + payload.id)
            .then(response => {
                console.log("Success");
            })
            .catch(error => {
                console.log(error);
            });
    },
    SAVE_PUROK({ commit }, payload) {
        return axios
            .post("/api/purok", payload)
            .then(response => {
                commit("ADD_DATA", response.data);
            })
            .catch(error => {
                console.log(error);
            });
    },
    DELETE_PUROK({ state, commit }, payload) {
        const index = state.purok.indexOf(payload);
        axios.delete("/api/purok/" + payload.id);
        commit("REMOVE_DATA", index);
    },
    COMMIT_PUROK({ commit }, payload) {
        commit("ADD_DATA", payload);
    }
};

export default actions;
