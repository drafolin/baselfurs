<script setup lang="ts">
import type { Event } from "@/models/events";
import FullCalendar from "@fullcalendar/vue3"
import dayGridPlugin from "@fullcalendar/daygrid"

const { options } = defineProps<{ options: { events: Event[] } }>()

const calendarOptions = {
  timeZone: 'UTC',
  plugins: [dayGridPlugin],
  initialView: 'dayGridMonth',
  ...options
}
</script>

<template>
  <FullCalendar :options="calendarOptions" />
</template>
