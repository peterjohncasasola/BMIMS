<template>
  <div>
    <loading :active.sync="isLoading" :is-full-page="false"></loading>
    <div></div>
    <box>
      <template slot="header">
        <div class="row">
          <div class="col-md-8">
            <div class="filter-bar">
              <form class="form-inline" @submit.prevent="doFilter">
                <div class="form-group">
                  <label>Search for:</label>
                  <input
                    type="text"
                    v-model="tableData.search"
                    placeholder="Search by Last Name, First Name or Middle Name"
                    class="form-control"
                    @input="getResidents()"
                  >
                  <!-- <button class="btn btn-md btn-primary" @click.prevent="getResidents">Search</button> -->
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-4">
            <router-link
              :to="{name: 'resident-create'}"
              id="btnNew"
              class="btn btn-primary btn-md pull-right"
            >
              <i class="fa fa-plus-circle"></i> New Resident
            </router-link>
          </div>
        </div>

        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
          <tbody>
            <tr v-for="resident in residents" :key="resident.id">
              <td>{{ resident.id }}</td>
              <td>{{ resident.first_name }}</td>
              <td>{{ resident.middle_name }}</td>
              <td>{{ resident.last_name }}</td>
              <td>{{ resident.birth_date }}</td>
              <td>{{ resident.purok }}</td>

              <td>
                <router-link
                  :to="{ name: 'resident-edit', params: { id: resident.id }}"
                  class="btn btn-primary btn-sm"
                  data-toggle="tooltip"
                  title="Edit Details"
                >
                  <span class="glyphicon glyphicon-pencil"></span>
                </router-link>
                <button
                  class="btn btn-danger btn-sm"
                  @click="deleteResident(resident.id)"
                  data-toggle="tooltip"
                  title="Delete Record"
                >
                  <span class="glyphicon glyphicon-trash"></span>
                </button>
              </td>
            </tr>
          </tbody>
        </datatable>

        <pagination
          :pagination="pagination"
          @prev="getResidents(pagination.prevPageUrl)"
          @next="getResidents(pagination.nextPageUrl)"
        ></pagination>
        <!-- <my-vuetable></my-vuetable> -->
      </template>
    </box>
  </div>
</template>

<script>
// import { WebCam } from "vue-web-cam";
import Loading from "vue-loading-overlay";
import DataTable from "../../components/DataTable.vue";
import Pagination from "../../components/Pagination.vue";
import FilterBar from "../../components/FilterBar.vue";
// Import stylesheet
import "vue-loading-overlay/dist/vue-loading.css";
import { mapGetters, mapActions, mapMutations } from "vuex";
export default {
  data() {
    let sortOrders = {};
    let columns = [
      { width: "15%", label: "ID", name: "id" },
      { width: "15%", label: "First Name", name: "first_name" },
      { width: "15%", label: "Middle Name", name: "middle_name" },
      { width: "15%", label: "Last Name", name: "last_name" },
      { width: "15%", label: "Date Of Birth", name: "birth_date" },
      { width: "15%", label: "Purok", name: "purok", sortable: false },
      { width: "10%", label: "Actions", name: "actions", sortable: false }
    ];

    columns.forEach(column => {
      sortOrders[column.name] = -1;
    });
    return {
      isLoading: true,
      isFullPage: false,
      residents: [],
      columns: columns,
      outOfsync: false,
      sortKey: "first_name",
      sortOrders: sortOrders,
      tableData: {
        draw: 0,
        length: 20,
        search: "",
        column: 0,
        dir: "desc"
      },
      pagination: {
        lastPage: "",
        currentPage: "",
        total: "",
        lastPageUrl: "",
        nextPageUrl: "",
        prevPageUrl: "",
        from: "",
        to: ""
      }
    };
  },
  components: {
    datatable: DataTable,
    pagination: Pagination,
    filterbar: FilterBar
  },
  computed: {},
  created() {
    this.loadingDelay();
  },
  methods: {
    resetFilter() {
      this.tableData.search = "";
    },
    deleteResident(id) {
      if (confirm("are you sure you want to continue?")) {
        axios
          .delete("/api/residents/" + id)
          .then(response => {
            this.getResidents();
            setTimeout(() => {
              this.$toastr.s("successfully deleted");
            }, 600);
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    getResidents(url = "/api/residents") {
      this.tableData.draw++;
      axios
        .get(url, { params: this.tableData })
        .then(response => {
          let data = response.data;
          if (this.tableData.draw == data.draw) {
            this.residents = data.data.data;
            this.configPagination(data.data);
          }
        })
        .catch(error => {});
    },
    configPagination(data) {
      this.pagination.lastPage = data.last_page;
      this.pagination.currentPage = data.current_page;
      this.pagination.total = data.total;
      this.pagination.lastPage = data.last_page;
      this.pagination.nextPageUrl = data.next_page_url;
      this.pagination.prevPageUrl = data.prev_page_url;
      this.pagination.from = data.from;
      this.pagination.to = data.to;
    },
    sortBy(key) {
      this.sortKey = key;
      this.sortOrders[key] = this.sortOrders[key] * -1;
      this.tableData.column = this.getIndex(this.columns, "name", key);
      this.tableData.dir = this.sortOrders[key] === 1 ? "asc" : "desc";
      this.getResidents();
    },
    getIndex(array, key, value) {
      return array.findIndex(i => i[key] == value);
    },
    loadingDelay() {
      this.isLoading = true;
      this.getResidents();
      setTimeout(() => {
        this.isLoading = false;
      }, 1500);
    }
  }
};
</script>

<style scoped>
#limit {
  width: 80px !important;
}
#btnNew {
  margin-bottom: 20px;
}

.filter-bar {
  padding-bottom: 20px;
  padding-top: -5px;
}
.form-group {
  margin-left: 10px;
}
.form-control {
  width: 250px;
}
</style>
