<template>
  <div>
    <loading :active.sync="isLoading" :is-full-page="false"></loading>
    <box>
      <template slot="header">
        <div class="row">
          <div class="col-md-8">
            <div class="filter-bar">
              <!-- <form class="form-inline" @submit.prevent="doFilter">
                <div class="form-group">
                  <label>Search for:</label>
                  <input
                    type="text"
                    v-model="tableData.search"
                    placeholder
                    class="form-control"
                    @input="getBlotters()"
                  >
                </div>
              </form>-->
            </div>
          </div>
          <div class="col-md-4">
            <button
              @click="newBlotter"
              data-target="modalDialog"
              class="btn btn-primary btn-md pull-right"
            >
              <i class="fa fa-plus-circle"></i> New Blotter
            </button>
          </div>
        </div>

        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
          <tbody>
            <tr v-for="blotter in blotters" :key="blotter.id">
              <td>{{ blotter.case_no }}</td>
              <td>{{ blotter.case_name }}</td>
              <td>
                {{ blotter.complainant.first_name }}
                {{ blotter.complainant.middle_name }}
                {{ blotter.complainant.last_name }}
              </td>
              <td>
                {{ blotter.complained.first_name }}
                {{ blotter.complained.middle_name }}
                {{ blotter.complained.last_name }}
              </td>

              <td>{{ blotter.status }}</td>

              <td>{{ blotter.filing_date }}</td>
              <td>{{ blotter.officer.name }}</td>
              <td>
                <button
                  @click="editBlooter(blotter)"
                  class="btn btn-primary btn-sm"
                  data-toggle="tooltip"
                  title="Edit Details"
                >
                  <span class="glyphicon glyphicon-pencil"></span>
                </button>
                <button
                  class="btn btn-danger btn-sm"
                  @click="deleteBlotter(blotter)"
                  data-toggle="tooltip"
                  title="Delete Record"
                >
                  <span class="glyphicon glyphicon-trash"></span>
                </button>
              </td>
            </tr>
          </tbody>
        </datatable>

        <!-- <pagination
          :pagination="pagination"
          @prev="getBlotters(pagination.prevPageUrl)"
          @next="getBlotters(pagination.nextPageUrl)"
        ></pagination>-->
      </template>
    </box>
    <modal title="title" :method="saveChanges">
      <template slot="modalBody">
        <div class="row">
          <div class="col col-md-6">
            <div class="form-group">
              <label for>Case Number</label>
              <input
                type="text"
                class="form-control"
                v-model="form.case_no"
                id="case_no"
                name="case_no"
              >
              <has-error :form="form" field="case_no" class="invalid-feedback"></has-error>
            </div>
          </div>
          <div class="col col-md-6">
            <div class="form-group">
              <label for>Case Name</label>
              <input
                type="text"
                class="form-control"
                v-model="form.case_name"
                id="case_name"
                name="case_name"
              >
              <has-error :form="form" field="case_name" class="invalid-feedback"></has-error>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col col-md-6">
            <div class="form-group">
              <label for>Date of Filing</label>
              <input
                type="date"
                class="form-control"
                v-model="form.filing_date"
                id="filing_date"
                name="filing_date"
              >
              <has-error :form="form" field="filing_date" class="invalid-feedback"></has-error>
            </div>
          </div>
          <div class="col col-md-6">
            <div class="form-group">
              <label for>Status</label>
              <v-select
                v-model="form.status"
                :value="form.status"
                :options="['Pending','Ongoing','Resolved Issue','Filed to Action']"
              ></v-select>
              <has-error :form="form" field="status" class="invalid-feedback"></has-error>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col col-md-12">
            <div class="form-group">
              <label for>Complainant Resident</label>
              <v-select
                v-model="complainant_resident"
                @input="getResidentId('complainant',complainant_resident)"
                :value="complainant_resident"
                :options="residents"
              ></v-select>
              <has-error :form="form" field="complainant_residentid" class="invalid-feedback"></has-error>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col col-md-12">
            <div class="form-group">
              <label for>Complained Resident</label>
              <v-select
                v-model="complained_resident"
                @input="getResidentId('complained', complained_resident)"
                :value="complained_resident"
                :options="residents"
              ></v-select>
              <has-error :form="form" field="complained_residentid" class="invalid-feedback"></has-error>
              <span class="invalid-feedback">{{ comlained_error }}</span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for>Case Description</label>
              <textarea
                type="text"
                rows="5"
                class="form-control input-md"
                id="description"
                name="description"
                v-model="form.description"
                placeholder="Some description about the incidense or case."
              ></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col col-md-6">
            <div class="form-group">
              <label for>Officer In Charge</label>
              <v-select
                v-model="officer_in_charge"
                :value="officer_in_charge"
                @input="getOfficerId(officer_in_charge)"
                :options="officers"
              ></v-select>
              <has-error :form="form" field="officer_residentid" class="invalid-feedback"></has-error>
            </div>
          </div>
          <div class="col col-md-6">
            <div class="form-group">
              <label for>Action Taken</label>
              <input
                type="text"
                class="form-control"
                id="action_taken"
                name="action_taken"
                v-model="form.action_taken"
                placeholder
              >
              <has-error :form="form" field="action_taken" class="invalid-feedback"></has-error>
            </div>
          </div>
        </div>
      </template>
    </modal>
  </div>
</template>

<script>
// import { WebCam } from "vue-web-cam";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

import DataTable from "../../components/DataTable.vue";
import Pagination from "../../components/Pagination.vue";
import FilterBar from "../../components/FilterBar.vue";
// Import stylesheet
export default {
  data() {
    let sortOrders = {};
    let columns = [
      { width: "4%", label: "No", name: "case_no" },
      { width: "15%", label: "Case Name", name: "case_name" },
      { width: "15%", label: "Complainant", name: "complainant" },
      { width: "18%", label: "Complained Person", name: "" },
      { width: "8%", label: "Status", name: "status" },
      { width: "12%", label: "Filed Date", name: "filing_date" },
      { width: "15%", label: "Officer In Charge", name: "officer_in_charge" }
    ];

    columns.forEach(column => {
      sortOrders[column.name] = -1;
    });
    return {
      officers: [],
      comlained_error: "",
      complained_resident: "",
      complainant_resident: "",
      officer_in_charge: "",

      form: new Form({
        id: "",
        complainant_residentid: "",
        case_no: "",
        case_name: "",
        filing_date: "",
        complainant: "",
        complainant_details: "",
        complained_residentid: "",
        action_taken: "",
        status: "",
        description: "",
        officer_residentid: ""
      }),
      isLoading: true,
      isFullPage: false,
      blotters: [],
      residents: [],
      columns: columns,
      outOfsync: false,
      sortKey: "filling_date",
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
    pagination: Pagination
  },
  computed: {},
  created() {
    this.loadingDelay();
    this.getResidents();
    this.getOfficers();
    this.getAllBlotters();
  },
  methods: {
    getAllBlotters() {
      axios.get("/api/blotters").then(response => {
        this.blotters = response.data;
      });
    },
    getOfficerId(name) {
      console.log(name);
      axios.get("/api/getOfficerId?name=" + name).then(response => {
        this.form.officer_residentid = response.data[0].id;
        console.log(this.form.officer_residentid + " officer id");
      });
    },
    getResidentId(person, name) {
      axios.get("/api/getResidentId?name=" + name).then(response => {
        if (person === "complainant") {
          this.form.complainant_residentid = response.data[0].id;
          console.log(this.form.complainant_residentid + " complainant id");
        } else {
          this.form.complained_residentid = response.data[0].id;
          console.log(this.form.complained_residentid + " complained id");
        }

        if (
          this.form.complainant_residentid === this.form.complained_residentid
        ) {
          this.comlained_error =
            "the complainant cant be complained her/his self";
        } else {
          this.comlained_error = "";
        }
      });
    },
    getOfficers() {
      axios
        .get("/api/getOfficers")
        .then(response => {
          Object.keys(response.data).forEach(item => {
            let data = response.data;
            console.log(data);
            this.officers.push(data[item].name);
          });
        })
        .catch(error => {
          console.log(error);
        });
    },
    getResidents() {
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
    newBlotter() {
      this.isNew = true;
      this.form.clear();
      this.form.reset();
      $("#modalDialog").modal("show");
    },
    resetFilter() {
      this.tableData.search = "";
    },
    getBlotters(url = "/api/blotters") {
      this.tableData.draw++;
      axios
        .get(url, { params: this.tableData })
        .then(response => {
          let data = response.data;
          if (this.tableData.draw == data.draw) {
            this.blotters = data.data.data;
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
      this.getBlotters();
    },
    getIndex(array, key, value) {
      return array.findIndex(i => i[key] == value);
    },
    loadingDelay() {
      this.isLoading = true;
      this.getAllBlotters();
      setTimeout(() => {
        this.isLoading = false;
      }, 1500);
    },
    deleteBlotter(blotter) {
      if (confirm("delete this record")) {
        axios
          .delete("/api/blotters/" + blotter.id)
          .then(response => {
            this.getAllBlotters();
            setTimeout(() => {
              this.$toastr.s("successfully deleted");
            }, 1000);
          })
          .catch(error => {
            this.$toastr.e("something went wrong");
          });
      }
    },
    saveChanges() {
      if (this.isNew) {
        console.log(this.form);
        this.form
          .post("/api/blotters")
          .then(response => {
            this.getAllBlotters();
            this.clearForm();
            setTimeout(() => {
              this.$toastr.s("successfully added");
            }, 1000);
          })
          .catch(() => {
            this.$toastr.e("something went wrong..");
            this.$toastr.e(this.form.errors.errors.error);
          });
      } else {
        this.form
          .put("/api/blotters/" + this.form.id)
          .then(() => {
            this.clearForm();
            this.getAllBlotters();
            $("#modalDialog").modal("hide");
            setTimeout(() => {
              this.$toastr.s("successfully updated");
            }, 1000);
          })
          .catch(error => {
            this.$toastr.e(this.form.errors.errors.error);
            console.log(this.form.errors.errors.error);
            console.log(error);
          });
      }
    },
    editBlooter(data) {
      console.log(data);
      this.isNew = false;

      this.complainant_resident = `${data.complainant.first_name} ${
        data.complainant.middle_name
      } ${data.complainant.last_name}`;

      this.complained_resident = `${data.complained.first_name} ${
        data.complained.middle_name
      } ${data.complained.last_name}`;

      this.officer_in_charge = `${data.officer.name}`;

      $("#modalDialog").modal("show");
      this.form.fill(data);
      this.form.complainant = "";
      console.log(this.form);
    },
    newBlotter() {
      this.isNew = true;
      this.form.clear();
      this.form.reset();
      this.officer_in_charge = "";
      this.complained_resident = "";
      this.complainant_resident = "";
      $("#modalDialog").modal("show");
    },

    clearErrors() {
      this.form.clear();
    },
    clearForm() {
      this.form.reset();
      this.officer_in_charge = "";
      this.complained_resident = "";
      this.complainant_resident = "";
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
