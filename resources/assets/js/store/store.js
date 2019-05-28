import Vuex from "vuex";
import Vue from "vue";

import actions from "./actions";
import getters from "./getters";
import state from "./state";
import mutations from "./mutations";

/* import modules */
/* import modules */
import purok from "./modules/purok";
import resident from "./modules/resident";

Vue.use(Vuex);

export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions: {},
    modules: { purok, resident }
});
