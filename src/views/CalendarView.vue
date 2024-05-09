<script setup lang="ts">
let datePointer = new Date()
datePointer.setDate(1)
while (datePointer.getDay() !== 1) {
  datePointer.setDate(datePointer.getDate() - 1)
}
console.log(datePointer)
const days = new Map<Date, any[]>();
while (datePointer.getMonth() <= new Date().getMonth() || datePointer.getDay() !== 1) {
  days.set(new Date(datePointer), [])
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
        <ul class="timeEvents"></ul>
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
