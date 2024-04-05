<script lang="ts" setup>
import { ref, type VNodeRef } from 'vue'
import { useCssVar } from '@vueuse/core'

const el = ref<VNodeRef | null>(null)
const textColor = useCssVar('--foreground', el)
</script>

<template>
  <svg :ref="el" viewBox="0 0 30 40" xmlns="http://www.w3.org/2000/svg">
    <line :stroke="textColor" x1="0" x2="30" y1="10" y2="10" />
    <line :stroke="textColor" x1="0" x2="30" y1="20" y2="20" />
    <line :stroke="textColor" x1="0" x2="30" y1="30" y2="30" />
  </svg>
</template>

<style lang="scss" scoped>
svg {
  width: 30px;
}
</style>
