<template>
  <div>
    <loading :active.sync="isLoading" :is-full-page="true"></loading>
    <box title="Purok and Leaders">
      <template slot="header">
        <button
          v-on:click="newPurok"
          data-target="modalDialog"
          class="btn btn-primary btn-md pull-right"
        >
          <i class="fa fa-plus-circle"></i> New Purok
        </button>
      </template>
      <template slot="body">
        <!-- <v-select
          :options="select_data"
          v-model="selectedData"
          :value="selectedData"
          taggable
          multiple
          @input="logsSelectedData"
        ></v-select>-->
        <custom-table>
          <template slot="columns">
            <th width="3%">#</th>
            <th width="15%">Purok</th>
            <th width="22%">Leader</th>
            <th width="22%">Actions</th>
          </template>
          <template slot="rows">
            <tr v-for="purok in purok_data.data" :key="purok.id">
              <td>{{ purok.id }}</td>
              <td>{{ purok.name }}</td>
              <td>{{ purok.leader }}</td>
              <td>
                <router-link
                  :to="{ name: 'resident-edit', params: { id: purok.id }}"
                  tag="button"
                  class="btn btn-primary btn-sm"
                >
                  <span class="glyphicon glyphicon-zoom-in"></span>
                </router-link>
                <button
                  class="btn btn-primary btn-sm"
                  @click="editPurok(purok)"
                  data-toggle="tooltip"
                  title="Edit Details"
                >
                  <span class="glyphicon glyphicon-pencil"></span>
                </button>
                <button
                  class="btn btn-danger btn-sm"
                  @click="deletePurok(purok)"
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
    <modal title="Purok" :method="saveChanges">
      <template slot="modalBody">
        <div class="form-group">
          <label for="name">Purok Name</label>
          <input
            type="text"
            name="name"
            id="name"
            v-model="form.name"
            class="form-control input-md"
          >
          <has-error :form="form" field="name" class="invalid-color"></has-error>
        </div>
        <div class="form-group">
          <label for="leader">Purok Leader</label>
          <input
            type="text"
            name="leader"
            id="leader"
            :class="{ 'is-invalid': form.errors.has('leader') }"
            v-model="form.leader"
            class="form-control input-md"
          >
          <has-error :form="form" field="leader" class="invalid-color"></has-error>
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
      isLoading: false,
      fullPage: false,
      isNew: true,
      selectedData: [],
      purok_data: {},
      form: new Form({
        id: "",
        name: "",
        leader: ""
      }),
    };
  },
  components: {
    Loading
  },
  computed: {
    ...mapGetters("purok", ["getPuroks"])
  },
  created() {
    this.loadingDelay();
  },
  methods: {
    ...mapActions("purok", ["fetch", "delete", "update", "commit_data"]),
    loadingDelay() {
      this.isLoading = true;
      this.getData();
      setTimeout(() => {
        this.isLoading = false;
      }, 1500);
    },

    getData(page = 1) {
      axios.get("/api/purok?page=" + page).then(response => {
        this.purok_data = response.data;
      });
    },
    deletePurok(purok) {
      if (confirm("Delete this record")) {
        this.delete(purok).then(() => {
          this.getData();
          setTimeout(() => {
            this.$toastr.s("successfully deleted");
          }, 1000);
        });
      }
    },
    saveChanges(purok) {
      if (this.isNew) {
        this.form
          .post("/api/purok")
          .then(response => {
            this.clearForm();
            this.getData();
            setTimeout(() => {
              this.$toastr.s("successfully added");
            }, 500);
          })
          .catch(() => {
            this.$toastr.e("something went wrong..");
          });
      } else {
        this.form
          .put("/api/purok/" + this.form.id)
          .then(() => {
            this.clearForm();
            this.getData();
            $("#modalDialog").modal("hide");
            setTimeout(() => {
              this.$toastr.s("successfully updated");
            }, 500);
          })
          .catch(() => {
            this.$toastr.e("something went wrong");
          });
      }
    },
    editPurok(data) {
      this.isNew = false;
      this.form.clear();
      this.form.reset();
      $("#modalDialog").modal("show");
      this.form.fill(data);
    },
    newPurok() {
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
