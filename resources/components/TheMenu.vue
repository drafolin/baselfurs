<script lang="ts" setup>
import { ref } from 'vue'
import { usePreferredColorScheme, useWindowSize } from '@vueuse/core'
import { Link } from '@inertiajs/vue3';

const { width } = useWindowSize()
const textColor = usePreferredColorScheme().value === 'dark' ? 'white' : 'black'
const deployed = ref<boolean>(false)

type Link = {
  url: string
  name: string
}

const links: Link[] = [
  {
    name: 'Home',
    url: '/'
  },
  {
    name: 'Links',
    url: '/links'
  },
  {
    name: 'Events',
    url: '/calendar'
  }
]
</script>

<template>
  <nav v-if="width > 660" class="desktop">
    <ul>
      <li v-for="link in links" :key="link.url">
        <Link :href="link.url">{{ link.name }}</Link>
      </li>
    </ul>
  </nav>

  <template v-else>
    <svg viewBox="0 0 30 40" xmlns="http://www.w3.org/2000/svg" @click.capture="deployed = !deployed">
      <line :class="deployed ? 'animation-to' : ''" :stroke="textColor" x1="0" x2="30" y1="20" y2="20" />
      <line :class="deployed ? 'animation-to' : ''" :stroke="textColor" x1="0" x2="30" y1="20" y2="20" />
      <line :class="deployed ? 'animation-to' : ''" :stroke="textColor" x1="0" x2="30" y1="20" y2="20" />
    </svg>

    <Teleport to="body">
      <Transition>
        <nav v-if="deployed" class="menu">
          <ul>
            <li v-for="link in links" :key="link.url">
              <Link :href="link.url" @click="deployed = false">{{ link.name }}</Link>
            </li>
          </ul>

          <a class="button" href="https://t.me/+6HzWgZE399tkMTVk">Telegram Chat</a>
        </nav>
      </Transition>

      <Transition>
        <div v-if="deployed" class="body-overlay" @click="deployed = false" />
      </Transition>
    </Teleport>
  </template>
</template>

<style lang="scss" scoped>
svg {
  width: 30px;
}

nav.desktop {
  ul {
    list-style: none;
    display: flex;
    flex-direction: row;

    li {
      padding: 0 0.5em;
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

@keyframes activate-1 {
  from {
    transform: rotate(0) translateY(-10px);
  }

  50% {
    transform: rotate(0) translateY(0);
  }

  to {
    transform: rotate(45deg) translateY(0);
  }
}

@keyframes deactivate-1 {
  from {
    transform: rotate(45deg) translateY(0);
  }

  50% {
    transform: rotate(0) translateY(0);
  }

  to {
    transform: rotate(0) translateY(-10px);
  }
}

@keyframes activate-2 {
  from {
    opacity: 1;
  }

  50% {
    opacity: 0;
  }

  to {
    opacity: 0;
  }
}

@keyframes deactivate-2 {
  from {
    opacity: 0;
  }

  50% {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}

@keyframes activate-3 {
  from {
    transform: rotate(0deg) translateY(10px);
  }

  50% {
    transform: rotate(0deg) translateY(0);
  }

  to {
    transform: rotate(-45deg) translateY(0);
  }
}

@keyframes deactivate-3 {
  from {
    transform: rotate(-45deg) translateY(0);
  }

  50% {
    transform: rotate(0) translateY(0);
  }

  to {
    transform: rotate(0) translateY(10px);
  }
}

svg {
  line {
    transform-origin: center;

    @for $i from 1 through 3 {
      &:nth-child(#{$i}) {
        animation: deactivate-#{$i} 500ms both;

        &.animation-to {
          animation: activate-#{$i} 500ms both;
        }
      }
    }
  }
}

.menu {
  position: fixed;
  top: 5rem;
  bottom: 0;
  width: fit-content;
  min-width: 70vw;
  right: 0;
  background-color: var(--background);
  box-shadow:
    rgba(0, 0, 0, 0.5) 0 5px 5px,
    inset rgba(0, 0, 0, 0.5) 0 10px 5px -5px;
  z-index: 8;
  padding: 2rem;
  margin: 0;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: stretch;

  &.v-enter-active,
  &.v-leave-active {
    transition: all 0.5s ease;
  }

  &.v-enter-from,
  &.v-leave-to {
    right: -100vw;
  }

  ul {
    list-style: none;
    display: flex;
    flex-direction: column;
    justify-content: start;
    align-items: start;
    margin: 0;
    padding: 0;

    li {
      padding: 0.75em 0;

      a {
        font-size: 1.3rem;
      }
    }
  }

  >a {
    text-align: center;
  }
}

.body-overlay {
  position: fixed;
  z-index: 7;
  top: 5rem;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.5);
  opacity: 1;

  &.v-enter-active,
  &.v-leave-active {
    transition: opacity 0.5s ease;
  }

  &.v-enter-from,
  &.v-leave-to {
    opacity: 0;
  }
}
</style>
