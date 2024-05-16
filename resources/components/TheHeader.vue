<script lang="ts" setup>
import Icon from '@/assets/icon-192x192.png'
import TheMenu from '@/components/TheMenu.vue'
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <header>
    <Link href="/">
      <img :src="Icon" alt="Basel Furs" class="icon" />
    </Link>
    <span class="title">Basel Furs</span>
    <TheMenu />
  </header>
</template>

<style lang="scss" scoped>
header {
  display: grid;
  grid-template-columns: 1fr auto 1fr;
  justify-items: center;
  align-items: center;
  padding: 0.25rem 1.75em;
  box-shadow: rgba(0, 0, 0, 0.4) 0 0 10px;
  position: fixed;
  width: 100vw;
  height: 5rem;
  background-color: var(--background);
  z-index: 10;

  @media screen and (max-width: 660px) {
    grid-template-columns: 1fr 3fr 1fr;
  }

  :first-child {
    justify-self: start;
  }

  :last-child {
    justify-self: end;
  }

  .icon {
    height: 3rem;

    @media screen and (max-width: 660px) {
      height: auto;
      width: 2.5rem;
    }
  }

  span.title {
    font-size: 2.5rem;

    @media screen and (max-width: 660px) {
      font-size: 1.5rem;
    }
  }
}
</style>
