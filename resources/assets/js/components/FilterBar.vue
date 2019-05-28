<template>
  <div class="filter-bar">
    <form class="form-inline" @submit.prevent="doFilter">
      <div class="form-group">
        <label>Search for:</label>
        <input
          width="300px !important"
          type="text"
          placeholder="Search by Last Name, First Name or Middle Name"
          class="form-control input-sm"
          @keyup.enter="$emit('doFilter')"
        >
        <button class="btn btn-sm btn-primary" @click.prevent="search">Search</button>
        <button class="btn btn-default btn-sm" @click.prevent="resetFilter">Reset</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  props: ["text", "method"],
  data() {
    return {
      value: text,
      search: method
    };
  },

  methods: {
    resetFilter() {
      this.text = "";

      
    }
  }
};
</script>
<style scoped>
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
