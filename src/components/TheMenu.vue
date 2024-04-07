<script lang="ts" setup>
import { ref, type VNodeRef } from 'vue'
import { useCssVar, useWindowSize } from '@vueuse/core'

const { width } = useWindowSize()
const el = ref<VNodeRef | null>(null)
const textColor = useCssVar('--foreground', el)
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
  }
]
</script>

<template>
  <nav v-if="width > 660">
    <ul>
      <li v-for="link in links" :key="link.url">
        <RouterLink :to="link.url">{{ link.name }}</RouterLink>
      </li>
    </ul>
  </nav>

  <div v-else>
    <svg
      :ref="el"
      viewBox="0 0 30 40"
      xmlns="http://www.w3.org/2000/svg"
      @click.capture="deployed = !deployed"
    >
      <line
        :class="deployed ? 'animation-to' : ''"
        :stroke="textColor"
        x1="0"
        x2="30"
        y1="20"
        y2="20"
      />
      <line
        :class="deployed ? 'animation-to' : ''"
        :stroke="textColor"
        x1="0"
        x2="30"
        y1="20"
        y2="20"
      />
      <line
        :class="deployed ? 'animation-to' : ''"
        :stroke="textColor"
        x1="0"
        x2="30"
        y1="20"
        y2="20"
      />
    </svg>

    <Transition>
      <ul v-if="deployed" class="menu">
        <li v-for="link in links" :key="link.url">
          <RouterLink :to="link.url" @click="deployed = false">{{ link.name }}</RouterLink>
        </li>
      </ul>
    </Transition>

    <Transition>
      <div v-if="deployed" class="body-overlay" @click="deployed = false" />
    </Transition>
  </div>
</template>

<style lang="scss" scoped>
svg {
  width: 30px;
}

nav {
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
  list-style: none;
  display: flex;
  flex-direction: column;
  justify-content: start;
  align-items: start;
  margin: 0;

  &.v-enter-active,
  &.v-leave-active {
    transition: all 0.5s ease;
  }

  &.v-enter-from,
  &.v-leave-to {
    right: -100vw;
  }

  li {
    padding: 0.75em 0;

    a {
      font-size: 1.3rem;
    }
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
