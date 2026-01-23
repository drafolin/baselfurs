<script setup lang="ts">
import { ref, watch, computed } from 'vue';
import { Qalendar } from "@drafolin/qalendar";
import "@drafolin/qalendar/dist/style.css";
import { format } from "date-fns";
import type { Event } from "@/models/events";
import Star from "@/assets/icons/star.png";
import { router, Link } from '@inertiajs/vue3';

const props = defineProps<{ events: Event[], start: string, end: string }>();

type Period = { start: Date, end: Date, selectedDate: Date }
const colors = ["blue", "yellow", "green", "red", "pink", "purple", "turquoise", "brown"] as const

const events = computed(() =>
    props.events.map((v, i) => {
        return {
            ...v,
            id: v.identifier,
            time: {
                start: format(v.start_date, 'yyyy-MM-dd HH:mm'),
                end: format(v.end_date, 'yyyy-MM-dd HH:mm')
            },
            title: v.name,
            url: `/events/${v.identifier}`,
            description: v.short_description,
            location: v.address
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

            <template #link="p">
                <Link :href="p.href">
                {{ p.text }}
                </Link>
            </template>
        </Qalendar>
    </main>
</template>

<style lang="scss">
.calendar-root {
    font-family: Jost, Helvetica, Arial, sans-serif !important;

    .calendar-month__week:first-child {
        border-top: 1px solid #fff3 !important;
    }

    .calendar-month__week-day-name {
        font-size: 14px !important;
    }


    @media screen and (prefers-color-scheme: dark) {
        background-color: transparent !important;
        border: 1px solid #fff3 !important;

        .calendar-month__weekday {
            border-color: #fff3 !important;
        }
    }
}

.calendar-month__event {
    font-size: 12px !important;

    .calendar-month__event-icon {
        height: 8px;
        width: 8px;
        margin-right: 2px;
        border-radius: 0;

        .event-flyout & {
            height: 1em;
            width: 1em;
        }

        .qalendar-is-small & {
            height: 6px;
            width: 6px;
            margin: 0 1px;
        }
    }
}

.calendar-month__weekday {
    padding: .25rem;
}

.qalendar-is-small .calendar-month__event {
    height: 6px !important;
    width: 6px !important;
}
</style>
