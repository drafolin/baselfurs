<script setup lang="ts">
import { ref, watch } from 'vue';
import { Qalendar } from "@drafolin/qalendar";
import "@drafolin/qalendar/dist/style.css";
import { format } from "date-fns";
import type { Event } from "@/models/events.ts";
import Star from "@/assets/icons/star.png";

const { events: propEvents } = defineProps<{ events: Event[] }>();

type Period = { start: Date, end: Date, selectedDate: Date }
const colors = ["blue", "yellow", "green", "red", "pink", "purple", "turquoise", "brown"] as const
type CalendarEvent = {
    id: string,
    time: {
        start: string,
        end: string
    },
    color?: typeof colors[number],
    title?: string,
    isCustom?: ["month" | "week" | "day"]
}

type UpdatedModePayload = { period: Period }

const ptr = new Date();
ptr.setDate(1);
const start = new Date(ptr.valueOf());
ptr.setMonth(ptr.getMonth() + 1);
ptr.setDate(0);
const end = new Date(ptr.valueOf());


const range = ref<Period>({ start, end, selectedDate: new Date() });
const events = ref<CalendarEvent[]>(
    propEvents.map((v, i) => {
        return {
            ...v,
            id: v.identifier,
            time: {
                start: format(v.start_date, 'yyyy-MM-dd HH:mm'),
                end: format(v.end_date, 'yyyy-MM-dd HH:mm')
            },
            color: colors[i % colors.length],
            title: v.name,
        }
    })
);


// watch(range,
//   async () => {
//     events.value = await fetchRange(range.value).then(v => v.map((ev, i) => ({
//       ...ev,
//       time: {
//         start: format(ev.time.start, 'yyyy-MM-dd HH:mm'),
//         end: format(ev.time.end, 'yyyy-MM-dd HH:mm')
//       },
//       color: colors[i % colors.length]
//     })))
//   }, { immediate: true })


const HandleUpdatedMode = (v: { period: Period }) => { range.value = v.period }
</script>

<template>
    <main>
        <h1>Calendar</h1>
        <Qalendar :events="events" :config="{ defaultMode: 'month', locale: 'normal' }"
            @updated-period="(v: Period) => { range = v }" @updated-mode="HandleUpdatedMode">
            <template #eventIcon="props">
                <img :src="Star" alt="Featured" v-if="props.eventData.featured" class="calendar-month__event-icon" />
            </template>
        </Qalendar>
    </main>
</template>

<style lang="scss">
.calendar-month__event-icon {
    height: 1em;
    width: 1em;
    border-radius: 0;

    .calendar-month & {
        height: 8px;
        width: 8px;
        margin-right: 2px;
    }
}
</style>
