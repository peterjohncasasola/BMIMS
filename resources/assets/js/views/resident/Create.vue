<template>
  <div>
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <form @submit.prevent="saveResident">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a href="#resident-tab" data-toggle="tab">Resident Profile</a>
                  </li>
                  <li>
                    <a
                      href="#household-tab"
                      data-toggle="tab"
                      v-if="form.is_househead"
                    >House Hold Details</a>
                  </li>
                  <!-- <li class>
                    <a href="#otherdetails-tab" data-toggle="tab">Other Details</a>
                  </li>-->
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="resident-tab">
                    <br>
                    <div id="createform">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col col-md-12">
                            <div class="row">
                              <div class="col col-md-12">
                                <div class="row">
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" v-model="form.is_househead">
                                          HouseHold Head
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" v-model="form.is_familyhead">
                                          Head of the Family
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" v-model="form.is_voter">
                                          Registered Voter
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" v-model="form.is_pwa">
                                          Person with Disability (PWA)
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <div class="checkbox">
                                        <label>
                                          <input type="checkbox" v-model="form.is_senior">
                                          Senior Citizen
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col col-md-6">
                                    <div class="form-group">
                                      <label for>HouseHold No</label>
                                      <input
                                        type="text"
                                        class="form-control"
                                        id="house_no"
                                        v-model="form.house_no"
                                        name="house_no"
                                      >
                                      <has-error
                                        :form="form"
                                        field="house_no"
                                        class="invalid-feedback"
                                      ></has-error>
                                    </div>
                                  </div>
                                  <div class="col col-md-6">
                                    <div class="form-group">
                                      <label for>Street/Unit/Bldg/Village</label>
                                      <input
                                        type="text"
                                        class="form-control"
                                        id="street_address"
                                        name="street_address"
                                        v-model="form.street_address"
                                        placeholder
                                      >
                                      <has-error
                                        :form="form"
                                        field="street_address"
                                        class="invalid-feedback"
                                      ></has-error>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col col-md-6">
                                    <div class="form-group">
                                      <label for>Sitio/Purok</label>
                                      <v-select
                                        :options="purok_data"
                                        v-model="form.purok"
                                        :value="form.purok"
                                      ></v-select>
                                      <has-error
                                        :form="form"
                                        field="purok"
                                        class="invalid-feedback"
                                      ></has-error>
                                    </div>
                                  </div>
                                  <div class="col col-md-6">
                                    <div class="form-group">
                                      <label for>Resident ID Number</label>
                                      <input
                                        type="text"
                                        v-model="form.resident_id"
                                        class="form-control"
                                        id="resident_id"
                                        name="resident_id"
                                        placeholder
                                      >
                                      <has-error
                                        :form="form"
                                        field="resident_id"
                                        class="invalid-feedback"
                                      ></has-error>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- <div class="row">
                            <div class="col-md-3">
                              <div class="row">
                                <div class="col col-md-12">
                                  <div class="form-group">
                                    <img
                                      id="profile-pic"
                                      class="img-responsive"
                                      src="../../../../public/img/profile.png"
                                      alt="User profile picture"
                                      width="220px"
                                      height="220px"
                                    >
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>-->
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col col-md-4">
                            <div class="form-group">
                              <label for>First Name</label>
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
                          <div class="col col-md-4">
                            <div class="form-group">
                              <label for>Middle Name</label>
                              <input
                                type="text"
                                class="form-control"
                                v-model="form.middle_name"
                                id="middle_name"
                                name="middle_name"
                              >
                              <has-error :form="form" field="middle_name" class="invalid-feedback"></has-error>
                            </div>
                          </div>
                          <div class="col col-md-4">
                            <div class="form-group">
                              <label for>Last Name</label>
                              <input
                                type="text"
                                class="form-control"
                                id="last_name"
                                name="last_name"
                                v-model="form.last_name"
                              >
                              <has-error :form="form" field="last_name" class="invalid-feedback"></has-error>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col-md-12">
                            <div class="form-group">
                              <label for>Place of Birth</label>
                              <input
                                type="text"
                                class="form-control"
                                id="birth_date"
                                name="birth_date"
                                v-model="form.birth_place"
                                placeholder
                              >
                              <has-error :form="form" field="birth_place" class="invalid-feedback"></has-error>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col-md-4">
                            <div class="form-group">
                              <label for>Gender</label>
                              <v-select
                                v-model="form.gender"
                                :value="form.gender"
                                :options="['Male','Female']"
                              ></v-select>
                              <has-error :form="form" field="gender" class="invalid-feedback"></has-error>
                            </div>
                          </div>

                          <div class="col col-md-4">
                            <div class="form-group">
                              <label for>Date Of Birth</label>
                              <input
                                type="date"
                                class="form-control"
                                v-model="form.birth_date"
                                id="birth_date"
                                name="birth_date"
                              >
                              <has-error :form="form" field="birth_date" class="invalid-feedback"></has-error>
                            </div>
                          </div>
                          <div class="col col-md-4">
                            <div class="form-group">
                              <label for>Civil Status</label>
                              <v-select
                                :value="form.civil_status"
                                v-model="form.civil_status"
                                :options="['Single','Single Parent','Married','Widow','Annulled','Seperated']"
                              ></v-select>
                              <has-error :form="form" field="civil_status" class="invalid-feedback"></has-error>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col-md-6">
                            <div class="form-group">
                              <label for>Email Address</label>
                              <input
                                type="email"
                                class="form-control"
                                v-model="form.email"
                                id="email"
                                name="email"
                              >
                              <has-error :form="form" field="email" class="invalid-feedback"></has-error>
                            </div>
                          </div>
                          <div class="col col-md-6">
                            <div class="form-group">
                              <label for>Contact No</label>
                              <input
                                type="text"
                                v-model="form.contact_no"
                                class="form-control"
                                id="contact_no"
                                name="contact_no"
                              >
                              <has-error :form="form" field="contact_no" class="invalid-feedback"></has-error>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col-md-6">
                            <div class="form-group">
                              <label for>Employment Status</label>
                              <v-select
                                :value="form.employment_status"
                                v-model="form.employment_status"
                                :options="['Self Employed','Employed','Unemployed','Out of School Youth','Retired']"
                              ></v-select>
                              <has-error
                                :form="form"
                                field="employment_status"
                                class="invalid-feedback"
                              ></has-error>
                            </div>
                          </div>
                          <div class="col col-md-6">
                            <div class="form-group">
                              <label for>Occupation</label>
                              <input
                                type="text"
                                class="form-control"
                                v-model="form.occupation"
                                id="occupation"
                                name="occupation"
                              >
                              <has-error :form="form" field="occupation" class="invalid-feedback"></has-error>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col-md-6">
                            <div class="form-group">
                              <label for>Educational Attaintment</label>
                              <input
                                type="text"
                                class="form-control"
                                v-model="form.educational_attainment"
                                id="educational_attainment"
                                name="educational_attainment"
                              >
                              <has-error
                                :form="form"
                                field="educational_attainment"
                                class="invalid-feedback"
                              ></has-error>
                            </div>
                          </div>
                          <div class="col col-md-6">
                            <div class="form-group">
                              <label for>Degree/Course</label>
                              <input
                                type="text"
                                class="form-control"
                                v-model="form.course_degree"
                                id="degree"
                                name="degree"
                              >
                              <has-error
                                :form="form"
                                field="course_degree"
                                class="invalid-feedback"
                              ></has-error>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col-md-6">
                            <div class="form-group">
                              <label for>Income Bracket</label>
                              <input
                                type="text"
                                class="form-control"
                                id="income_bracket"
                                v-model="form.income_bracket"
                                name="income_bracket"
                              >
                              <span class="invalid-feedback"></span>
                            </div>
                          </div>
                          <div class="col col-md-6">
                            <div class="form-group">
                              <label for>Income Source</label>
                              <input
                                type="text"
                                class="form-control"
                                id="income_source"
                                v-model="form.income_source"
                                name="income_source"
                              >
                              <span class="invalid-feedback"></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col-md-6">
                            <div class="form-group">
                              <label for>Dialect</label>
                              <input
                                type="text"
                                class="form-control"
                                v-model="form.dialect"
                                id="dialect"
                                name="dialect"
                              >
                              <span class="invalid-feedback"></span>
                            </div>
                            <has-error :form="form" field="dialect" class="invalid-feedback"></has-error>
                          </div>
                          <div class="col col-md-6">
                            <div class="form-group">
                              <label for>Religion</label>
                              <input
                                type="text"
                                class="form-control"
                                v-model="form.religion"
                                id="religion"
                                name="religion"
                              >
                              <has-error :form="form" field="religion" class="invalid-feedback"></has-error>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col col-md-4">
                            <div class="form-group">
                              <label for>Height (CM)</label>
                              <input
                                v-model="form.height"
                                type="number"
                                class="form-control"
                                id="height"
                                name="height"
                              >
                              <has-error :form="form" field="height" class="invalid-feedback"></has-error>

                              <span class="invalid-feedback"></span>
                            </div>
                          </div>
                          <div class="col col-md-4">
                            <div class="form-group">
                              <label for>Weight (KG)</label>
                              <input
                                v-model="form.weight"
                                type="number"
                                class="form-control"
                                id="weight"
                                name="weight"
                              >
                              <has-error :form="form" field="weight" class="invalid-feedback"></has-error>
                            </div>
                          </div>
                          <div class="col col-md-4">
                            <div class="form-group">
                              <label for>Blood Type</label>
                              <v-select
                                :options="['AB-','B-','A-','O-','B+','AB+','A+','O+']"
                                v-model="form.blood_type"
                                :value="form.blood_type"
                              ></v-select>
                              <has-error :form="form" field="blood_type" class="invalid-feedback"></has-error>
                            </div>
                          </div>
                        </div>
                        <div v-if="form.is_voter" class="row">
                          <div class="col col-md-4">
                            <div class="form-group">
                              <label for>Voters ID No</label>
                              <input
                                type="text"
                                class="form-control"
                                v-model="voter_form.id_number"
                                id="id_number"
                                name="id_number"
                              >
                              <span class="invalid-feedback"></span>
                            </div>
                          </div>
                          <div class="col col-md-4">
                            <div class="form-group">
                              <label for>Precint No</label>
                              <input
                                type="text"
                                v-model="voter_form.precint_number"
                                class="form-control"
                              >
                              <span class="invalid-feedback"></span>
                            </div>
                          </div>
                          <div class="col col-md-4">
                            <div class="form-group">
                              <label for>Date Registered</label>
                              <input
                                type="date"
                                v-model="voter_form.date_registered"
                                class="form-control"
                                id="date_registered"
                                name="date_registered"
                              >
                              <span class="invalid-feedback"></span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row"></div>
                      <br>
                      <div class="box-footer">
                        <router-link
                          :to="{name: 'resident-index' }"
                          class="btn btn-default pull-right"
                        >Cancel</router-link>
                        <input
                          type="submit"
                          class="btn btn-primary pull-right"
                          name="save"
                          id="save"
                          value="Submit"
                          style="margin-right: 10px;"
                        >
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" v-if="form.is_househead" id="household-tab">
                    <br>
                  </div>
                  <div class="tab-pane" id="otherdetails-tab">
                    <br>
                  </div>
                </div>
                <!-- /.tab-content -->
              </div>
            </form>
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
      purok_data: [],
      voter_form: new Form({
        id: "",
        id_number: "",
        resident_id: "",
        precint_number: "",
        date_registered: ""
      }),
      form: new Form({
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
      })
    };
  },
  computed: {},
  methods: {
    fetchPuroks() {
      axios.get("/api/getAllPuroks").then(res => {
        Object.keys(res.data).forEach(item => {
          console.log(res.data);
          this.purok_data.push(res.data[item].name);
        });
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
    this.fetchPuroks();
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
#createform {
  margin-left: 5px;
  margin-right: 5px;
}
#profile-pic {
  margin-left: 15px;
  width: 140px;
  height: 160px;
  margin-bottom: 18px;
  border-radius: 5px;
}
</style>
