<template>
  <div class="tags">
    <span v-for="tag in tags" :key="`tag-${tag.id}`" class="tag">
      {{ tag.name }}
    </span>
  </div>
</template>

<script>
export default {
  name: "Tags",
  props: {
    tags: Array,
  },
};
</script>

<style scoped>
.tags {
  display: inline-block;
}
.tag {
  display: inline-block;
  padding: 10px;
  margin: 10px;
  font-size: 0.75em;
  background: lightblue;
  border-radius: 10px;
}
</style>