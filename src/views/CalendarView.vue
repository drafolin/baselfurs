<script setup lang="ts">
import { fetchOn } from '@/models/events';
import type { Event } from '@/models/events';
import { isOnSameDay } from '@/models/utils';
import StarIcon from '@/assets/icons/star.png';

let datePointer = new Date();
datePointer.setDate(1);
while (datePointer.getDay() !== 1) {
  datePointer.setDate(datePointer.getDate() - 1);
}
type DateEvents = {
  dayEvents: Event[];
  timeEvents: Event[];
};
const days = new Map<Date, DateEvents>();
while ((datePointer.getMonth() <= new Date().getMonth()) || (datePointer.getDay() !== 1)) {
  const events = datePointer.getDate() === 12 ? fetchOn(datePointer) : [];

  days.set(new Date(datePointer), {
    dayEvents: events.filter(v =>
      !isOnSameDay(v.dateFrom, datePointer) ||
      (v.dateTo ? !isOnSameDay(v.dateTo!, datePointer) : false)
    ),
    timeEvents: events.filter(v =>
      isOnSameDay(v.dateFrom, datePointer) &&
      (v.dateTo ? isOnSameDay(v.dateTo, datePointer) : true)
    )
  })
  datePointer.setDate(datePointer.getDate() + 1)
}

</script>

<template>
  <main>
    <h1>Calendar</h1>
    <ul class="calendar">
      <li :key="day[0].valueOf()" v-for="day in days.entries()"
        :class="day[0].getMonth() === new Date().getMonth() ? 'current-month' : 'other-month'">
        <div class="date">{{ day[0].getDate() }}</div>
        <ul class="day-events">
          <li v-for="dayEvent in day[1].dayEvents">

          </li>
        </ul>
        <ul class="time-events">
          <li :key="timeEvent.name" v-for="timeEvent in day[1].timeEvents"
            :class="timeEvent.featured ? 'featured' : ''">
            <div class="meta">
              <img v-if="timeEvent.featured" :src="StarIcon" class="icon" />
              <span class="time-from">
                {{
                  timeEvent.dateFrom.toLocaleTimeString("default", {
                    hour: "2-digit",
                    minute: "2-digit"
                  })

                }}
              </span>
              <template v-if="timeEvent.dateTo">
                <span class="time-separator">-</span>
                <span class="time-to">
                  {{
                    timeEvent.dateTo.toLocaleTimeString("default", {
                      hour: "2-digit",
                      minute: "2-digit"
                    })
                  }}
                </span>
              </template>
            </div>
            <div class="name">
              {{ timeEvent.name }}
            </div>
          </li>
        </ul>
      </li>
    </ul>
  </main>
</template>

<style lang="scss" scoped>
.calendar {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  grid-gap: 1px;
  border: 1px solid rgba(var(--foreground-rgb), .05);

  >li {
    min-height: 168px;
    padding: .5em;
    box-shadow: 0 0 0 1px rgba(var(--foreground-rgb), .05);
    transition: box-shadow 300ms ease-in-out;

    &:hover {
      box-shadow: 0 0 0 1px rgba(var(--foreground-rgb), .2);
    }

    &.other-month {
      opacity: .2;
    }

    >ul {
      >li {
        padding: .25em;

        &.featured {
          border-left: 2px solid rgba(var(--foreground-rgb), .5);
        }

        &:not(.featured) {
          margin-left: 2px;
        }

        >.meta {
          font-size: 10px;

          .icon {
            height: 1em;
            margin-right: .25em;
          }

          .time-separator {
            margin: 0 .25em;
          }
        }

        >.name {
          font-size: 12px;
        }
      }
    }
  }
}
</style>
