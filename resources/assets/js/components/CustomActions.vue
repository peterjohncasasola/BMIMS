  <template>
  <div class="custom-actions">
    <button class="btn btn-sm btn-info">
      <i class="glyphicon glyphicon-zoom-in"></i>
    </button>
    <button class="btn btn-sm btn-warning">
      <i class="glyphicon glyphicon-pencil"></i>
    </button>
    <button class="btn btn-sm btn-danger">
      <i class="glyphicon glyphicon-trash"></i>
    </button>
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
  }
};
</script>

  <style>
.custom-actions button.ui.button {
  padding: 8px 8px;
}
.custom-actions button.ui.button > i.icon {
  margin: auto !important;
}
</style>
