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

const ptr = new Date();
ptr.setDate(1);
const start = new Date(ptr.valueOf());
ptr.setMonth(ptr.getMonth() + 1);
ptr.setDate(0);
const end = new Date(ptr.valueOf());

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

const refreshEvents = (start: Date, end: Date) => {
    router.get('/calendar', {
        start: format(start, 'yyyy-MM-dd HH:mm'),
        end: format(end, 'yyyy-MM-dd HH:mm')
    }, {
        replace: true,
        preserveState: true,
        preserveScroll: true,

    })
}

const locale = window.navigator.language;
</script>

<template>
    <main>
        <h1>Calendar</h1>
        <Qalendar :events="events" :config="{ defaultMode: 'month', locale: locale }"
            @updated-period="(v: Period) => refreshEvents(v.start, v.end)"
            @updated-mode="(v) => refreshEvents(v.period.start, v.period.end)"
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
