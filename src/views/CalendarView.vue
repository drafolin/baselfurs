<script setup lang="ts">
import { fetchRange, type Event } from '@/models/events';
import { ref, watchEffect } from 'vue';
import { isOnSameDay } from '@/models/utils';
import FullCalendar from '@/components/FullCalendar.vue';


type Period = { start: Date, end: Date, selectedDate: Date }
type UpdatedModePayload = { period: Period }

const ptr = new Date();
ptr.setDate(1);
const start = new Date(ptr);
ptr.setMonth(ptr.getMonth() + 1);
ptr.setDate(0);
const end = new Date(ptr);

const range = ref<Period>({ start, end, selectedDate: new Date() });
const events = ref<Event[]>([]);

watchEffect(
  async () => {
    events.value = await fetchRange(range.value)
  })
</script>

<template>
  <main>
    <h1>Calendar</h1>
    <FullCalendar :options="{ events }" />
  </main>
</template>

<style lang="scss"></style>
