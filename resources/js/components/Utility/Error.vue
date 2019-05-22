<template>
  <span class="error-block">
    <slot></slot>
  </span>
</template>

<script>
export default {
  props: ['errors'],
}
</script>
<style lang="scss" scoped>
span.error-block {
  color: red;
}
</style>
