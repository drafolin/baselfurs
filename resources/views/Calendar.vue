<script setup lang="ts">
import { ref, watch, computed } from 'vue';
import { Qalendar } from "@drafolin/qalendar";
import "@drafolin/qalendar/dist/style.css";
import { format } from "date-fns";
import type { Event } from "@/models/events";
import Star from "@/assets/icons/star.png";
import { router } from '@inertiajs/vue3'

const props = defineProps<{ events: Event[], start: string, end: string }>();

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
const events = computed(() =>
    props.events.map((v, i) => {
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
const HandleUpdatedMode = (v: { period: Period }) => { range.value = v.period }
</script>

<template>
    <main>
        <h1>Calendar</h1>
        <Qalendar :events="events" :config="{ defaultMode: 'month', locale: 'normal' }" @updated-period="(v: Period) => {
            router.get('/calendar', {
                start: format(v.start, 'yyyy-MM-dd HH:mm'),
                end: format(v.end, 'yyyy-MM-dd HH:mm')
            }, {
                replace: true,
                preserveState: true,
                preserveScroll: true,

            })
        }" @updated-mode="HandleUpdatedMode"
            :selectedDate="new Date((new Date(props.start).valueOf() + new Date(props.end).valueOf()) / 2)">
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
