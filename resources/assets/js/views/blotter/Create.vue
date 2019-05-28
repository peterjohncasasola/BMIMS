<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="row">
              <div class="col col-md-12">
                <div class="row">
                  <div class="col col-md-3">
                    <div class="form-group">
                      <label for>Case Number</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.first_name"
                        id="first_name"
                        name="first_name"
                      >
                      <has-error :form="form" field="first_name" class="invalid-feedback"></has-error>
                    </div>
                  </div>
                  <div class="col col-md-3">
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
                  <div class="col col-md-3">
                    <div class="form-group">
                      <label for>Date of Filing</label>
                      <input
                        type="date"
                        class="form-control"
                        v-model="form.description"
                        id="description"
                        name="description"
                      >
                      <has-error :form="form" field="description" class="invalid-feedback"></has-error>
                    </div>
                  </div>
                  <div class="col col-md-3">
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
                  <div class="col col-md-6">
                    <div class="form-group">
                      <label for>Officer In Charge</label>
                      <v-select
                        v-model="form.status"
                        :value="form.status"
                        :options="['Pending','Ongoing','Resolved Issue','Filed to Action']"
                      ></v-select>
                      <has-error :form="form" field="status" class="invalid-feedback"></has-error>
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
                        v-model="form.birth_place"
                        placeholder
                        :disabled="status === 'Resolved Issue'"
                      >
                      <has-error :form="form" field="action_taken" class="invalid-feedback"></has-error>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "CreateResident",
  data() {
    return {
      form: new Form({
        case_no: "",
        case_name: "",
        complainant_residentid: "",
        filing_date: "",
        complainant: "",
        complained_resident: "",
        complained_residentid: "",
        description: "",
        status: "",
        officer_in_charge: "",
        action_taken: "",
        officer_residentid: "",
        complainant: ""
      })
    };
  },
  computed: {},
  methods: {
    getResidentsName() {
      axios
        .get("/api/")
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

    saveResident() {
      this.form
        .post("/api/residents")
        .then(response => {
          console.log(response.data);
          this.voter_form.resident_id = response.data.id;
        })
        .catch(err => {
          console.log(err);
        });
      if (this.form.is_voter) {
        this.voter_form.post("/api/voters").then(response => {
          this.clearForm();
          this.clearErrors();
          this.$toastr.s("resident successfully added");
        });
      }
    },
    clearErrors() {
      this.form.clear();
      this.voter_form.clear();
    },
    clearForm() {
      this.form.reset();
      this.voter_form.reset();
    }
  },

  created() {
    //this.fetchPuroks();
  }
};
</script>

<style scoped>
.col-md-1 {
  width: 1%;
}
.col-md-10 {
  width: 98%;
}
</style>
