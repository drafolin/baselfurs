<script setup lang="ts">
import { fetchOn } from '@/models/events';
import { isOnSameDay } from '@/models/utils';

let datePointer = new Date()
datePointer.setDate(1)
while (datePointer.getDay() !== 1) {
  datePointer.setDate(datePointer.getDate() - 1)
}
console.log(datePointer)
const days = new Map<Date, { dayEvents: any[], timeEvents: any[] }>();
while (datePointer.getMonth() <= new Date().getMonth() || datePointer.getDay() !== 1) {
  const events = datePointer.getDate() === 12 ? fetchOn(datePointer) : []
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
        <ul class="dayEvents"></ul>
        <ul class="timeEvents">
          <li v-for"event in day[1]"></li>
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
    aspect-ratio: 1 / 1;
    padding: .5em;
    box-shadow: 0 0 0 1px rgba(var(--foreground-rgb), .05);
    transition: box-shadow 300ms ease-in-out;

    &:hover {
      box-shadow: 0 0 0 1px rgba(var(--foreground-rgb), .2);
    }

    &.other-month {
      opacity: .2;
    }
  }
}
</style>
