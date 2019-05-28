<template>
  <div>
    <nav>
      <ul class="pagination justify-content-end">
        <br>
        <span class>{{ pagination.from }} - {{ pagination.to }} of {{ pagination.total }}</span>

        <li class="page-item">
          <button
            class="btn btn-sm btn-default"
            :disabled="!pagination.prevPageUrl"
            @click="$emit('prev')"
          >Previous</button>
        </li>

        <li class="page-item">
          <button
            class="btn btn-sm btn-default"
            :disabled="!pagination.nextPageUrl"
            @click="$emit('next')"
          >Next</button>
        </li>
      </ul>
    </nav>
  </div>
</template>
<script>
export default {
  props: ["pagination"]
};
</script>