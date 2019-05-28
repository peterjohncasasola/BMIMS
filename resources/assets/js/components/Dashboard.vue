<template>
  <div>
    <div class="row">
      <loading :active.sync="isLoading" :is-full-page="true"></loading>

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>
              {{ count.residents }}
              <sup style="font-size: 20px"></sup>
            </h3>
            <p>Residents</p>
          </div>
          <div class="icon">
            <i class="fa fa-group"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>
              {{ count.voter }}
              <sup style="font-size: 20px"></sup>
            </h3>

            <p>Total Voters</p>
          </div>
          <div class="icon">
            <i class="fa fa-group"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>
              {{ count.male }}
              <sup style="font-size: 20px"></sup>
            </h3>

            <p>Total Male</p>
          </div>
          <div class="icon">
            <i class="fa fa-male"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>
              {{ count.female }}
              <sup style="font-size: 20px"></sup>
            </h3>
            <p>Total Female</p>
          </div>
          <div class="icon">
            <i class="fa fa-female"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>
              {{ count.familyHead }}
              <sup style="font-size: 20px"></sup>
            </h3>
            <p>Family Head</p>
          </div>
          <div class="icon">
            <i class="fa fa-group"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>
              {{ count.voter }}
              <sup style="font-size: 20px"></sup>
            </h3>

            <p>Senior Citizens</p>
          </div>
          <div class="icon">
            <i class="fa fa-group"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>
              {{ count.voter }}
              <sup style="font-size: 20px"></sup>
            </h3>

            <p>Total Male Voters</p>
          </div>
          <div class="icon">
            <i class="fa fa-male"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>
              {{ count.femaleVoter }}
              <sup style="font-size: 20px"></sup>
            </h3>
            <p>Total Female Voters</p>
          </div>
          <div class="icon">
            <i class="fa fa-female"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <div class="row">
      <div class="col-lg-9">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Latest Blotters</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th>Case No</th>
                    <th>Case Name</th>
                    <th>Complainant</th>
                    <th>Complained Person</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="blotter in blotters" :key="blotter.id">
                    <td>
                      <a href="#">{{ blotter.case_no }}</a>
                    </td>
                    <td>{{ blotter.case_name }}</td>
                    <td>{{ blotter.complainant.first_name }} {{ blotter.complainant.last_name }}</td>
                    <td>{{ blotter.complained.first_name }} {{ blotter.complained.last_name }}</td>
                    <td>{{ blotter.status }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.box-body -->
          <div class="box-footer clearfix">
            <router-link
              :to="{name: 'blotter-index'}"
              class="btn btn-sm btn-default btn-flat pull-right"
            >View All</router-link>
          </div>
          <!-- /.box-footer -->
        </div>
      </div>
      <div class="col-lg-3">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>
              {{ count.blotters }}
              <sup style="font-size: 20px"></sup>
            </h3>
            <p>Total Blotters</p>
          </div>
          <div class="icon">
            <i class="fa fa-group"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>
              {{ count.pwa }}
              <sup style="font-size: 20px"></sup>
            </h3>
            <p>Person With Disability (PWA)</p>
          </div>
          <div class="icon">
            <i class="fa fa-group"></i>
          </div>
          <a href="#" class="small-box-footer">
            More info
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";

export default {
  data() {
    return {
      count: "",
      blotters: "",
      isLoading: true
    };
  },

  methods: {
    getCount() {
      axios.get("/api/countRecords").then(response => {
        this.count = response.data.total;
        console.log(this.count);
      });
    },
    getLatestBlotters() {
      axios.get("/api/blotters").then(response => {
        this.isLoading = false;
        this.blotters = response.data;
      });
    }
  },

  created() {
    this.getCount();
    this.getLatestBlotters();
  }
};
</script>
