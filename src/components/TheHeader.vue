<script lang="ts" setup>
import Icon from '@/assets/icon-192x192.png'
</script>

<template>
  <header>
    <RouterLink to="/">
      <img :src="Icon" alt="Basel Furs" class="icon" />
    </RouterLink>
    <span class="title">Basel Furs</span>
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
  padding: 0.25rem 1.75em;
  box-shadow: black 0 0 10px;
  position: fixed;
  width: 100vw;
  height: 5rem;
  background-color: var(--background);
  z-index: 10;

  :first-child {
    justify-self: start;
  }

  :last-child {
    justify-self: end;
  }

  .icon {
    height: 3rem;
  }

  span.title {
    font-size: 2.5rem;
  }

  nav {
    ul {
      list-style: none;
      display: flex;
      flex-direction: row;

      li {
        padding: 0;
        margin: 0;
        transition: all 300ms ease-in-out;

        a {
          font-size: 1.5em;
        }

        &:hover {
          transform: scale(1.2);
        }
      }
    }
  }
}
</style>
