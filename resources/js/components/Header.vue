<template>
  <header>
    <a href="">BoolPress</a>

    <nav>
      <ul>
        <router-link :to="{name: 'home'}">Home</router-link></li>
        <router-link :to="{name: 'about'}">About</router-link></li>
        <router-link :to="{name: 'blog'}">Blog</router-link></li>
       
      </ul>
    </nav>
  </header>
</template>

<script>
export default {
  name: "Header",
};
</script>

<style lang="scss" scoped>
.active {
  color: red;
}

header {
  background: lightblue;
}
</style>