<script lang="ts" setup>
import type { Event } from '@/models/events'
import Star from '@/assets/icons/star.png'
import { format } from 'date-fns';

const props = defineProps<{
    events: Event[]
}>()
</script>

<template>
    <ul>
        <template v-for="(event, index) in props.events" :key="event.start_date.valueOf() + event.name">
            <hr v-if="index !== 0" />
            <li>
                <a :href="`/events/${event.identifier}`">
                    <div :class="event.featured ? 'featured' : ''">
                        <div class="date">
                            <span class="month">
                                {{ event.start_date.toLocaleString('default', { month: 'short' }) }}
                            </span>
                            <span class="date">
                                {{ event.start_date.getDate() }}
                            </span>
                        </div>
                        <div class="details">
                            <div>
                                <img v-if="event.featured" :src="Star" alt="Featured" aria-label="Featured" />
                                <span>
                                    {{
                                        format(event.start_date, 'HH:mm')
                                    }}
                                </span>
                                <span v-if="event.end_date">
                                    {{
                                        '&nbsp;- ' +
                                        format(event.end_date, 'HH:mm')
                                    }}
                                </span>
                            </div>
                            <div>
                                {{ event.name }}
                            </div>
                        </div>
                    </div>
                </a>
            </li>
        </template>
    </ul>
</template>

<style lang="scss" scoped>
ul {
    list-style: none;
    margin: 0 auto;
    padding: 0;
    width: fit-content;
    display: flex;
    align-items: stretch;
    min-width: 25em;
    flex-direction: column;

    @media screen and (max-width: 660px) {
        min-width: unset;
    }

    hr {
        width: 60%;
        margin: 0.5em auto;

        @media screen and (max-width: 660px) {
            width: 80%;
        }
    }

    li {
        margin: 0.5em 0;
        padding: 0;

        >a {
            color: var(--foreground);

            &:hover {
                text-decoration: none;

            }

            >div {
                display: flex;
                flex-direction: row;
                align-items: stretch;
                padding: 0.25em 1.5em;


                &.featured {
                    border-left: 2px solid var(--accent);
                }

                >.date {
                    display: flex;
                    flex-direction: column;
                    margin-right: 1.25em;
                    justify-content: space-evenly;

                    >.date {
                        font-size: 2rem;
                        font-weight: normal;
                    }
                }

                .details {
                    display: flex;
                    flex-direction: column;
                    align-items: start;
                    justify-content: space-evenly;

                    >div:first-child {
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                        justify-content: center;

                        img {
                            width: 1em;
                            margin: 0 0.25em;

                            @media screen and (prefers-color-scheme: dark) {
                                filter: invert(100%);
                            }
                        }
                    }
                }
            }
        }
    }
}
</style>
