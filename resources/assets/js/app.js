require("./bootstrap");
require("vue-toastr/src/vue-toastr.scss");
import "vue-select/dist/vue-select.css";
import Vue from "vue";

import VueRouter from "vue-router";

Vue.use(VueRouter);
/* main store */
import store from "./store/store.js";

/* import Generic Components */
import Box from "./components/Box.vue";
import Table from "./components/Table.vue";
import Modal from "./components/Modal.vue";
import Card from "./components/Card.vue";
import FilterBar from "./components/FilterBar.vue";
import ButtonPrimary from "./components/buttons/ButtonPrimary";

import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

/* ===================================== */

/* import plugins globally */
import Toastr from "vue-toastr";
import VueProgressBar from "vue-progressbar";

import { Form, HasError, AlertError } from "vform";

import moment from "moment";

import DataTable from "./components/DataTable.vue";
import Pagination from "./components/Pagination.vue";

/* ===================================== */

/* Register plugins globally */
Vue.use(VueProgressBar, {
  color: "rgb(143, 255, 199)",
  failedColor: "red",
  height: "100px"
});
Vue.use(Toastr, {
  defaultTimeout: 3000,
  defaultProgressBar: true,
  defaultType: "success",
  defaultPosition: "toast-top-right"
});

/* Register Custom generic Components Globally */
Vue.component("box", Box);
Vue.component("custom-table", Table);
Vue.component("btn-primary", ButtonPrimary);
Vue.component("modal", Modal);
Vue.component("card", Card);

import VeeValidate from "vee-validate";
Vue.use(VeeValidate);

/* Register plugin components globally */
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component("loading", Loading);
// Vue.component("pagination", require("laravel-vue-pagination"));
Vue.component("my-vuetable", require("./components/MyVuetable.vue").default);
import vSelect from "vue-select";

import CustomLoading from "./components/CustomLoading";

Vue.component("v-select", vSelect);

Vue.component("app", require("./views/App.vue").default);
Vue.component("app-loading", CustomLoading);
Vue.component("app-sidebar", require("./layout/Sidebar").default);
Vue.component("app-header", require("./layout/Header").default);
Vue.component("app-content", require("./layout/Content").default);
Vue.component("app-footer", require("./layout/Footer").default);

window.Fire = new Vue();

window.Form = Form;
const routes = [
  {
    path: "/home",
    component: require("./components/Dashboard.vue").default,
    name: "home"
  },
  {
    path: "/barangay/officials",
    name: "official-index",
    component: require("./views/Officials/Index.vue").default
  },
  {
    path: "/residents/list",
    name: "resident-index",
    component: require("./views/resident/Resident.vue").default
  },
  {
    path: "/residents/add",
    name: "resident-create",
    component: require("./views/resident/Create.vue").default
  },
  {
    path: "/residents/:id/edit",
    name: "resident-edit",
    component: require("./views/resident/Edit.vue").default
  },
  {
    path: "/barangay/puroks",
    name: "purok",
    component: require("./views/barangay/Purok.vue").default
  },
  {
    path: "/request/blotters",
    name: "blotter-index",
    component: require("./views/blotter/Index.vue").default
  },
  {
    path: "/request/blotter/new",
    name: "blotter-create",
    component: require("./views/blotter/Create.vue").default
  },
  {
    path: "/resident/voters",
    name: "voter-index",
    component: require("./views/resident/Voter.vue").default
  },
  {
    path: "*",
    name: "not-found",
    component: require("./views/auth/PageNotFound.vue").default
  }
];

const router = new VueRouter({
  mode: "history",
  routes, // short for `routes: routes`
  linkActiveClass: "active"
});

const app = new Vue({
  el: "#app",
  store,
  router
});
