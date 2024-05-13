<script setup lang="ts">
import { fetchRange } from '@/models/events';
import { ref, watch } from 'vue';
import { isOnSameDay } from '@/models/utils';
import { Qalendar } from "qalendar";
import "qalendar/dist/style.css";
import { format } from "date-fns";


type Period = { start: Date, end: Date, selectedDate: Date }
type Event = {
  id: string,
  time: {
    start: string,
    end: string
  }
}
type UpdatedModePayload = { period: Period }

const ptr = new Date();
ptr.setDate(1);
const start = new Date(ptr);
ptr.setMonth(ptr.getMonth() + 1);
ptr.setDate(0);
const end = new Date(ptr);

const range = ref<Period>({ start, end, selectedDate: new Date() });
const events = ref<Event[]>([]);

const colors = ["blue", "yellow", "green", "red"]

watch(range,
  async () => {
    events.value = await fetchRange(range.value).then(v => v.map((ev, i) => ({
      ...ev,
      time: {
        start: format(ev.time.start, 'yyyy-MM-dd HH:mm'),
        end: format(ev.time.end, 'yyyy-MM-dd HH:mm')
      },
      color: colors[i % colors.length]
    })))
  }, { immediate: true })


const HandleUpdatedMode = (v: { period: Period }) => { range.value = v.period }
</script>

<template>
  <main>
    <h1>Calendar</h1>
    <Qalendar :events="events" :config="{ defaultMode: 'month' }" @updated-period="(v: Period) => { range = v }"
      @updated-mode="HandleUpdatedMode" />
  </main>
</template>

<style lang="scss">
.calendar-month__weekday {
  min-height: 2.5em;

  .calendar-month__day-date[data-v-e7ff2963]:first-child {
    aspect-ratio: 1/1;
    padding: .5em;
  }
}
</style>
