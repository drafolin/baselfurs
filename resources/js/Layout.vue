
<script lang="ts" setup>
import TheHeader from '@/components/TheHeader.vue'
import TheFooter from '@/components/TheFooter.vue'
</script>

<template>
  <TheHeader />

  <slot />

  <TheFooter />
</template>

<style lang="scss">
main {
    max-width: 1600px;
    margin: 0 auto;
}
</style>
