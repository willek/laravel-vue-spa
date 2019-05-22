<template>
  <div>
    <h1>Vue Router Demo App</h1>
    <p>
      <router-link :to="{ name: 'home' }">Home</router-link> |
      <router-link :to="{ name: 'books.index' }">Books</router-link>
    </p>
    <router-view></router-view>
  </div>
</template>

<script>
export default {}
</script>
