<template>
  <div class="dataTables_wrapper form-inline dt-bootstrap">
    <div class="row">
      <div class="col-sm-12">
        <table id="table" class="table table-bordered table-striped dataTable" role="grid">
          <thead>
            <tr role="row">
              <th
                v-for="column in columns"
                :key="column.name"
                @click="$emit('sort', column.name)"
                :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                :style="'width:'+ column.width +';'+'cursor:pointer;'"
              >{{column.label}}</th>
            </tr>
          </thead>
          <slot></slot>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["columns", "sortKey", "sortOrders"]
};
</script>