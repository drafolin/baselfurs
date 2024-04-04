<script lang="ts" setup>
import Icon from '@/assets/icon-192x192.png'
</script>

<template>
  <header>
    <RouterLink to="/">
      <img :src="Icon" alt="Basel Furs" class="icon" />
    </RouterLink>
    <h1>Basel Furs</h1>
    <nav>
      <ul>
        <li>
          <RouterLink to="/">Home</RouterLink>
        </li>
        <li></li>
      </ul>
    </nav>
  </header>
</template>

<style lang="scss" scoped>
header {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  justify-items: center;
  align-items: center;
  padding: 0 1.75em;
  box-shadow: black 0 0 10px;
  position: fixed;
  width: 100vw;
  height: 7rem;
  background-color: var(--background);

  :first-child {
    justify-self: start;
  }

  :last-child {
    justify-self: end;
  }

  .icon {
    height: 4em;
  }

  nav {
    ul {
      list-style: none;
      display: flex;
      flex-direction: row;

      li {
        a {
          font-size: 1.5em;
        }
      }
    }
  }
}
</style>
