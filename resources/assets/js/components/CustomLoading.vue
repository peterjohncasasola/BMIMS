<template>
  <div>
    <loading :active.sync="isLoading" :is-full-page="true"></loading>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isLoading: true
    };
  },
  mounted() {
    this.displayLoading();
  },
  created() {
    this.displayLoading();
  },
  methods: {
    displayLoading() {
      this.isLoading = true;
      setTimeout(() => {
        this.isLoading = false;
      }, 3000);
    }
  }
};
</script>
