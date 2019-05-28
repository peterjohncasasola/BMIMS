<template>
  <div>
    <!-- <filter-bar></filter-bar> -->
    <vuetable
      ref="vuetable"
      :api-mode="true"
      :data="record"
      api-url="/api/residents"
      :fields="fields"
      pagination-path
      :css="css.table"
      :sort-order="sortOrder"
      :multi-sort="true"
      detail-row-component="my-detail-row"
      :append-params="moreParams"
      @vuetable:cell-clicked="onCellClicked"
      @vuetable:pagination-data="onPaginationData"
    ></vuetable>
    <div class="vuetable-pagination">
      <vuetable-pagination-info ref="paginationInfo" info-class="pagination-info"></vuetable-pagination-info>
      <vuetable-pagination
        ref="pagination"
        :css="css.pagination"
        @vuetable-pagination:change-page="onChangePage"
      ></vuetable-pagination>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import Vuetable from "vuetable-2/src/components/Vuetable";
import VuetablePagination from "vuetable-2/src/components/VuetablePagination";
import VuetablePaginationInfo from "vuetable-2/src/components/VuetablePaginationInfo";
import CustomActions from "./CustomActions";
import DetailRow from "./DetailRow";
import FilterBar from "./FilterBar";

Vue.component("custom-actions", CustomActions);
Vue.component("my-detail-row", DetailRow);
Vue.component("filter-bar", FilterBar);

export default {
  props: ["record"],
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo
  },
  data() {
    return {
      fields: [
        {
          name: "__sequence",
          title: "#",
          titleClass: "text-right",
          dataClass: "text-right"
        },
        // {
        //   name: "__checkbox",
        //   titleClass: "text-center",
        //   dataClass: "text-center"
        // },
        {
          name: "first_name",
          sortField: "first_name"
        },
        {
          name: "middle_name",
          sortField: "middle_name",
          title: "Middle Name"
        },

        {
          name: "last_name",
          sortField: "last_name",
          title: "Last Name"
        },

        {
          name: "street_address",
          sortField: "street_address",
          title: "Street Address"
        },
        {
          name: "birth_date",
          title: "Date of Birth",
          sortField: "birth_date",
          titleClass: "text-center",
          dataClass: "text-center",
          callback: "formatDate|DD-MM-YYYY"
        },
        // {
        //   name: "nickname",
        //   sortField: "nickname",
        //   callback: "allcap"
        // },

        // {
        //   name: "salary",
        //   sortField: "salary",
        //   titleClass: "text-center",
        //   dataClass: "text-right",
        //   callback: "formatNumber"
        // },
        {
          name: "__component:custom-actions",
          title: "Actions",
          titleClass: "text-center",
          dataClass: "text-center"
        }
      ],
      css: {
        table: {
          tableClass: "table table-bordered table-hover",
          ascendingIcon: "glyphicon glyphicon-chevron-up",
          descendingIcon: "glyphicon glyphicon-chevron-down",
          loading: "loading",
          detailRowClass: "vuetable-detail-row"
        },
        pagination: {
          wrapperClass: "pagination",
          activeClass: "active",
          disabledClass: "disabled",
          pageClass: "page",
          linkClass: "link",
          icons: {
            first: "fa fa-chevron-left",
            prev: "fa fa-chevron-left",
            next: "fa fa-chevron-right",
            last: "fa fa-chevron-right"
          }
        },
        icons: {
          first: "glyphicon glyphicon-step-backward",
          prev: "glyphicon glyphicon-chevron-left",
          next: "glyphicon glyphicon-chevron-right",
          last: "glyphicon glyphicon-step-forward"
        }
      },
      sortOrder: [
        { field: "last_name", sortField: "last_name", direction: "asc" }
      ],
      moreParams: {}
    };
  },
  methods: {
    allcap(value) {
      // return value.toUpperCase();
    },
    genderLabel(value) {
      return value === "M"
        ? '<span class="label label-success"><i class="glyphicon glyphicon-male"></i> Male</span>'
        : '<span class="label label-danger"><i class="glyphicon glyphicon-female"></i> Female</span>';
    },
    formatDate(value, fmt = "D MMM YYYY") {
      return value == null ? "" : moment(value, "YYYY-MM-DD").format(fmt);
    },
    onPaginationData(paginationData) {
      this.$refs.pagination.setPaginationData(paginationData);
      this.$refs.paginationInfo.setPaginationData(paginationData);
    },
    onChangePage(page) {
      this.$refs.vuetable.changePage(page);
    },
    onCellClicked(data, field, event) {
      console.log("cellClicked: ", field.name);
      this.$refs.vuetable.toggleDetailRow(data.id);
    }
  },

  events: {
    "filter-set"(filterText) {
      console.log("filtered");
      this.moreParams = {
        filter: filterText
      };
      Vue.nextTick(() => this.$refs.vuetable.refresh());
    },
    "filter-reset"() {
      this.moreParams = {};
      Vue.nextTick(() => this.$refs.vuetable.refresh());
    }
  }
};
</script>
<style>
.pagination {
  margin: 0;
  float: right;
}
.pagination a.page {
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 2px;
}
.pagination a.page.active {
  color: white;
  background-color: #337ab7;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 2px;
}
.pagination a.btn-nav {
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 7px;
  margin-right: 2px;
}
.pagination a.btn-nav.disabled {
  color: lightgray;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 7px;
  margin-right: 2px;
  cursor: not-allowed;
}
.pagination-info {
  float: left;
}
</style>
