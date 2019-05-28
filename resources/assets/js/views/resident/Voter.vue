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
                    class="form-control"
                    @input="getVoters()"
                  >
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-4">
            <button
              @click="newVoter"
              data-target="modalDialog"
              class="btn btn-primary btn-md pull-right"
            >
              <i class="fa fa-plus-circle"></i> New Voter
            </button>
          </div>
        </div>

        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
          <tbody>
            <tr v-for="voter in voters" :key="voter.id">
              <td>{{ voter.id }}</td>
              <td>{{ voter.id_number }}</td>
              <td>{{ voter.first_name }} {{ voter.middle_name }} {{ voter.last_name }}</td>
              <td>{{ voter.precint_number }}</td>
              <td>{{ voter.date_registered }}</td>
              <td>
                <button
                  class="btn btn-primary btn-sm"
                  @click="editVoter(voter)"
                  data-toggle="tooltip"
                  title="Edit Details"
                >
                  <span class="glyphicon glyphicon-pencil"></span>
                </button>
                <button
                  class="btn btn-danger btn-sm"
                  @click="deleteVoter(voter.id)"
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
          @prev="getVoters(pagination.prevPageUrl)"
          @next="getVoters(pagination.nextPageUrl)"
        ></pagination>
        <!-- <my-vuetable></my-vuetable> -->
      </template>
    </box>
    <modal title="Purok" :method="saveChanges">
      <template slot="modalBody">
        <div class="form-group">
          <label for="name">Voter ID Number</label>
          <input type="text" v-model="form.id_number" class="form-control input-md">
          <has-error :form="form" field="id_number" class="invalid-color"></has-error>
        </div>
        <div class="form-group">
          <label for="leader">Resident Name</label>
          <v-select
            v-model="resident_name"
            :value="resident_name"
            @input="getResidentId()"
            :options="residents"
          ></v-select>
          <has-error :form="form" field="resident_id" class="invalid-feedback"></has-error>
        </div>
        <div class="form-group">
          <label for="leader">Precint Number</label>
          <input type="text" v-model="form.precint_number" class="form-control input-md">
          <has-error :form="form" field="precint_number" class="invalid-color"></has-error>
        </div>
        <div class="form-group">
          <label for>Date Registered</label>
          <input type="date" v-model="form.date_registered" class="form-control input-md">
          <has-error :form="form" field="date_registered" class="invalid-color"></has-error>
        </div>
      </template>
    </modal>
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
import { mapGetters, mapActions, mapState } from "vuex";
export default {
  data() {
    let sortOrders = {};

    let columns = [
      { width: "10%", label: "ID", name: "id" },
      { width: "15%", label: "ID Number", name: "id_number" },
      { width: "30%", label: "Voter Name", name: "last_name" },
      { width: "15%", label: "Precint No", name: "precint_number" },
      { width: "15%", label: "Date Registered", name: "date_registered" },
      { width: "10%", label: "Actions", name: "actions" }
    ];

    columns.forEach(column => {
      sortOrders[column.name] = -1;
    });
    return {
      resident_data: "",
      residentForm: new Form({
        id: "",
        is_senior: false,
        is_voter: false,
        is_familyhead: false,
        is_pwa: false,
        resident_id: "",
        house_no: "",
        is_househead: false,
        first_name: "",
        middle_name: "",
        last_name: "",
        gender: "",
        title: "",
        email: "",
        alias_name: "",
        purok: "",
        street_address: "",
        birth_place: "",
        birth_date: "",
        contact_no: "",
        course_degree: "",
        employment_status: "",
        educational_attainment: "",
        occupation: "",
        civil_status: "",
        dialect: "",
        income_bracket: "",
        income_source: "",
        religion: "",
        height: "",
        weight: "",
        blood_type: ""
      }),
      resident_name: "",

      form: new Form({
        id: "",
        id_number: "",
        resident_id: "",
        precint_number: "",
        date_registered: "",
        precint_number: ""
      }),

      isLoading: true,
      isFullPage: false,
      voters: [],
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

  created() {
    this.loadingDelay();
    this.getResidentsName();
  },
  methods: {
    resetFilter() {
      this.tableData.search = "";
    },

    updateResidentVoterStatus(data) {
      axios.get("/api/residents/3").then(response => {
        this.resident_data = response.data.data;
      });
      console.log(this.resident_data);
      this.updateVoter(this.resident_data);
    },
    updateVoter(data) {
      axios.put("/api/updateVoterStatus/" + data.id).then(response => {
        console.log("update sucess");
      });
    },
    getResidentsName() {
      axios
        .get("/api/getResidentsName")
        .then(response => {
          Object.keys(response.data).forEach(item => {
            let data = response.data[item];
            let complete_name = `${data.first_name} ${data.middle_name} ${
              data.last_name
            }`;
            this.residents.push(complete_name);
          });
        })
        .catch(error => {
          console.log(error);
        });
    },
    getResidentId() {
      axios
        .get("/api/getResidentId?name=" + this.resident_name)
        .then(response => {
          this.form.resident_id = response.data[0].id;
        });
    },
    saveChanges(purok) {
      if (this.isNew) {
        this.form
          .post("/api/voters")
          .then(response => {
            let data = {
              id: this.form.resident_id,
              status: false
            };
            this.updateResidentVoterStatus(data);

            this.getVoters();
            setTimeout(() => {
              this.clearForm();
              this.$toastr.s("successfully added");
            }, 500);
          })
          .catch(error => {
            console.log(error);
          });
      } else {
        this.form
          .put("/api/voters/" + this.form.id)
          .then(() => {
            this.getVoters();
            $("#modalDialog").modal("hide");

            setTimeout(() => {
              this.$toastr.s("successfully updated");
            }, 500);
          })
          .catch(() => {
            this.$toastr.e("something went wrong");
          });
      }
      let data = {
        id: this.form.resident_id
      };
      this.updateResidentVoterStatus(data);
    },
    editVoter(data) {
      this.isNew = false;
      this.form.clear();
      this.form.reset();
      $("#modalDialog").modal("show");
      this.form.fill(data);
      this.resident_name = `${data.first_name} ${data.middle_name} ${
        data.last_name
      }`;
      this.getResidentId();
      console.log(data);
    },
    newVoter() {
      this.isNew = true;
      this.form.clear();
      this.form.reset();
      this.resident_name = "";
      $("#modalDialog").modal("show");
    },

    clearErrors() {
      this.form.clear();
    },
    clearForm() {
      this.form.reset();
      this.resident_name = "";
    },
    deleteVoter(id) {
      if (confirm("are you sure you want to continue?")) {
        axios
          .delete("/api/voters/" + id)
          .then(response => {
            let data = {
              id: this.form.resident_id,
              status: false
            };
            this.updateResidentVoterStatus(data);
            this.getVoters();
            setTimeout(() => {
              this.$toastr.s("successfully deleted");
            }, 600);
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    getVoters(url = "/api/voters") {
      this.tableData.draw++;
      axios
        .get(url, { params: this.tableData })
        .then(response => {
          let data = response.data;
          if (this.tableData.draw == data.draw) {
            this.voters = data.data.data;
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
      this.getVoters();
    },
    getIndex(array, key, value) {
      return array.findIndex(i => i[key] == value);
    },
    loadingDelay() {
      this.isLoading = true;
      this.getVoters();
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
</style>
