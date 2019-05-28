<template>
  <div @click="onClick">
    <div class="col col-md-1"></div>
    <div class="row">
      <div class="col col-md-5">
        <div class="inline field">
          <label>Middle Name:</label>
          <span>{{rowData.house_no}}</span>
        </div>

        <div class="inline field">
          <label>Middle Name:</label>
          <span>{{rowData.occupation}}</span>
        </div>
        <br>
        <div class="inline field">
          <label>Birth Place:</label>
          <span>{{rowData.birth_place}}</span>
        </div>
        <br>

        <div class="inline field">
          <label>Birthdate:</label>
          <span>{{rowData.street_address}}</span>
        </div>
        <br>

        <div class="inline field">
          <label>Gender:</label>
          <span>{{rowData.gender}}</span>
        </div>
        <br>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    rowData: {
      type: Object,
      required: true
    },
    rowIndex: {
      type: Number
    }
  },
  methods: {
    onClick(event) {
      console.log("my-detail-row: on-click", event.target);
    }
  }
};
</script>
