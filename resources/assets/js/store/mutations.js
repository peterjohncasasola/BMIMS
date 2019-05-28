let mutations = {
    SET_PUROK(state, payload) {
        state.puroks = payload;
    },
    UPDATE_PUROK(state, { payload, newPayload }) {
        Object.assign(payload, newPayload);
    },
    ADD_PUROK(state, payload) {
        state.puroks.unshift(payload);
    },
    REMOVE_PUROK(state, index) {
        state.puroks.splice(index, 1);
    }
};

export default mutations;
