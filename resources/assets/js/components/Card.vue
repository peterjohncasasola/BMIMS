<template>
  <div class="col-md-2 col-sm-2" id="spacing">
    <div :class="classType">
      <div class="box-header">
        <h4 class="box-title">{{title}}</h4>
      </div>
      <div class="box-body">
        <slot name="content"></slot>
      </div>
    </div>
  </div>
</template>

<style scoped>
.box-title {
  font-size: 18px;
}
#spacing {
  padding-left: 3px;
}
</style>

<script>
export default {
  props: ["title", "box-type", "status"],
  data() {
    return {
      classType: ""
    };
  },
  mounted() {
    this.checkStatus();
  },
  methods: {
    checkStatus() {
      if (this.status === "Available") {
        this.classType = "box box-primary";
      } else if (this.status === "Occupied") {
        this.classType = "box box-danger";
      }
    }
  }
};
</script>
