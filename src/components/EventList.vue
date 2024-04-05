<script lang="ts" setup>
import type { Event } from '@/models/events'
import Star from '@/assets/icons/star.png'

const props = defineProps<{
  events: Event[]
}>()
</script>

<template>
  <ul>
    <template v-for="event in props.events" :key="event.dateFrom.valueOf() + event.name">
      <li>
        <div :class="event.featured ? 'featured' : ''">
          <div class="date">
            <span class="month">
              {{ event.dateFrom.toLocaleString('default', { month: 'short' }) }}
            </span>
            <span class="date">
              {{ event.dateFrom.getDate() }}
            </span>
          </div>
          <div class="details">
            <div>
              <img v-if="event.featured" :src="Star" alt="Featured" aria-label="Featured" />
              <span>
                {{
                  event.dateFrom.getHours().toString().padStart(2, '0') +
                  ':' +
                  event.dateFrom.getMinutes().toString().padStart(2, '0')
                }}
              </span>
              <span v-if="event.dateTo">
                {{
                  '&nbsp;- ' +
                  event.dateTo.getHours().toString().padStart(2, '0') +
                  ':' +
                  event.dateTo.getHours().toString().padStart(2, '0')
                }}
              </span>
            </div>
            <div>
              {{ event.name }}
            </div>
          </div>
        </div>
      </li>
      <hr />
    </template>
  </ul>
</template>

<style lang="scss" scoped>
ul {
  list-style: none;
  margin: 0;
  padding: 0;

  li {
    margin: 0.5em 0;
    padding: 0;

    > div {
      display: flex;
      flex-direction: row;
      align-items: stretch;
      padding: 0.25em 1.5em;

      &.featured {
        border-left: 2px solid var(--accent);
      }

      > .date {
        display: flex;
        flex-direction: column;
        margin-right: 1.25em;
        justify-content: space-evenly;

        > .date {
          font-size: 2rem;
          font-weight: normal;
        }
      }

      .details {
        display: flex;
        flex-direction: column;
        align-items: start;
        justify-content: space-evenly;

        > div:first-child {
          display: flex;
          flex-direction: row;
          align-items: center;
          justify-content: center;

          img {
            width: 1em;
            margin: 0 0.25em;

            @media screen and (prefers-color-scheme: dark) {
              filter: invert(100%);
            }
          }
        }
      }
    }
  }

  hr {
    width: 60%;
    margin: 0.5em auto;
  }
}
</style>
