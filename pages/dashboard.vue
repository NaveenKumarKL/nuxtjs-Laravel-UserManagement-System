<template>
  <div class="container">
    <h1 class="im">im dashboard {{ $auth.user.name }}</h1>
    <n-link to="/about" flat>about</n-link>
    <h2>im naveen</h2>
    <!-- <n-link to="/login">login</n-link> -->
  </div>
</template>

<script>
export default {
  middleware: "auth"
};
</script>

<style scoped>
.im {
  color: red;
}
h2 {
  color: green;
}
</style>
