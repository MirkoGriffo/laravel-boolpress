<template>
  <div class="container">
    <div v-if="post">
      <h1>{{ post.title }}</h1>
      <div class="post-info">
        {{ post.category.name }}
        <Tags :tags="post.tags" />
      </div>
      <div>{{ post.content }}</div>
    </div>
    <div v-else>
      <Loader />
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Loader from "../components/Loader.vue";
import Tags from "../components/Tags.vue";
export default {
  name: "PostDetail",
  components: {
    Loader,
    Tags,
  },
  data() {
    return {
      post: null,
    };
  },
  created() {
    this.getPostDetails();
  },
  methods: {
    getPostDetails() {
      axios
        .get(`http://127.0.0.1:8001/api/posts/${this.$route.params.slug}`)
        .then((res) => {
          this.post = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style scoped>
</style>