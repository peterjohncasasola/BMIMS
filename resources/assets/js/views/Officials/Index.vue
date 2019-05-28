<template>
  <div>
    <!-- <loading :active.sync="isLoading" :is-full-page="true"></loading> -->
    <box title="Barangay Officials">
      <template slot="header">
        <button
          @click="newOfficial"
          data-target="modalDialog"
          class="btn btn-primary btn-md pull-right"
        >
          <i class="fa fa-plus-circle"></i> New Official
        </button>
      </template>
      <template slot="body">
        <custom-table>
          <template slot="columns">
            <th width="3%">#</th>
            <th width="25%">Name</th>
            <th width="15%">Position</th>
            <th width="20%">Year Elected</th>
            <th width="10%">Year End</th>
            <th width="10%">Status</th>
            <th width="22%">Actions</th>
          </template>
          <template slot="rows">
            <tr v-for="official in officials" :key="official.id">
              <td>{{ official.id }}</td>
              <td>{{ official.name }}</td>
              <td>{{ official.position }}</td>
              <td>{{ official.year_elected }}</td>
              <td>{{ official.year_end }}</td>
              <td>{{ official.status }}</td>
              <td>
                <router-link
                  :to="{ name: 'official-edit', params: { id: official.id }}"
                  tag="button"
                  class="btn btn-primary btn-sm"
                >
                  <span class="glyphicon glyphicon-zoom-in"></span>
                </router-link>
                <button
                  class="btn btn-primary btn-sm"
                  @click="editOfficial(official)"
                  data-toggle="tooltip"
                  title="Edit Details"
                >
                  <span class="glyphicon glyphicon-pencil"></span>
                </button>
                <button
                  class="btn btn-danger btn-sm"
                  @click="deleteOfficial(official)"
                  data-toggle="tooltip"
                  title="Delete Record"
                >
                  <span class="glyphicon glyphicon-trash"></span>
                </button>
              </td>
            </tr>
          </template>
        </custom-table>
      </template>
    </box>
    <modal title="title" :method="saveChanges">
      <template slot="modalBody">
        <div class="form-group">
          <label for="name">Official Name</label>
          <v-select :options="residents" v-model="form.name" :value="form.name"></v-select>
          <has-error :form="form" field="name" class="invalid-feedback"></has-error>
        </div>
        <div class="form-group">
          <label for="position">Position</label>
          <v-select
            :options="['Captain','Councilor 1','Councilor 2','Councilor 3',
            'Councilor 4','Councilor 5','Councilor 6','Councilor 7','Secretary']"
            v-model="form.position"
            :value="form.position"
          ></v-select>
          <has-error :form="form" field="position" class="invalid-color"></has-error>
        </div>
        <div class="form-group">
          <label for="leader">Year Elected</label>
          <input type="text" v-model="form.year_elected" class="form-control input-md">
          <has-error :form="form" field="year_elected" class="invalid-color"></has-error>
        </div>
        <div class="form-group">
          <label for>End Date</label>
          <input type="text" v-model="form.year_end" class="form-control input-md">
          <has-error :form="form" field="year_end" class="invalid-color"></has-error>
        </div>

        <div class="form-group">
          <label for>Status</label>
          <v-select :options="['Current','Former']" v-model="form.status" :value="form.status"></v-select>
          <has-error :form="form" field="status" class="invalid-feedback"></has-error>
        </div>
      </template>
    </modal>
  </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

import { mapGetters, mapActions } from "vuex";

export default {
  data() {
    return {
      title: "",
      isLoading: false,
      fullPage: false,
      isNew: true,
      officials: {},
      residents: [],
      form: new Form({
        id: "",
        name: "",
        year_elected: "",
        year_end: "",
        position: "",
        status: ""
      })
    };
  },

  components: {
    Loading
  },

  created() {
    this.loadingDelay();
    this.fetchOfficials();
  },
  methods: {
    loadingDelay() {
      this.isLoading = true;
      this.getData();
      setTimeout(() => {
        this.isLoading = false;
      }, 1000);
    },
    fetchOfficials() {
      axios.get("/api/officials").then(response => {
        console.log(response.data);
        this.officials = response.data;
      });
    },
    getData() {
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
    deleteOfficial(official) {
      if (confirm("delete this record")) {
        axios
          .delete("/api/officials/" + official.id)
          .then(response => {
            this.fetchOfficials();
            setTimeout(() => {
              this.$toastr.s("successfully deleted");
            }, 600);
          })
          .catch(error => {
            console.log(error);
            this.$toastr.e("something went wrong");
          });
      }
    },
    saveChanges() {
      if (this.isNew) {
        this.form
          .post("/api/officials")
          .then(response => {
            this.clearForm();
            this.fetchOfficials();
            setTimeout(() => {
              this.$toastr.s("successfully added");
            }, 500);
          })
          .catch(() => {
            this.$toastr.e("something went wrong..");
          });
      } else {
        this.form
          .put("/api/officials/" + this.form.id)
          .then(() => {
            this.clearForm();
            this.fetchOfficials();
            $("#modalDialog").modal("hide");
            setTimeout(() => {
              this.$toastr.s("successfully updated");
            }, 100);
          })
          .catch(error => {
            console.log(error);
          });
      }
    },
    editOfficial(data) {
      this.isNew = false;
      this.form.clear();
      this.form.reset();
      $("#modalDialog").modal("show");
      this.form.fill(data);
    },
    newOfficial() {
      this.isNew = true;
      this.form.clear();
      this.form.reset();
      $("#modalDialog").modal("show");
    },

    clearErrors() {
      this.form.clear();
    },
    clearForm() {
      this.form.reset();
    }
  }
};
</script>

<style scoped>
.invalid-color {
  color: red;
}
</style>
