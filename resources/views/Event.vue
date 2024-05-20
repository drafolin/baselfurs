<script setup lang="ts">
import { JsonEvent } from '@/models/events';
import { ref } from 'vue';
import "leaflet/dist/leaflet.css";
import { useForm } from '@inertiajs/vue3'
import { LMap, LTileLayer, LMarker } from "@vue-leaflet/vue-leaflet";

const props = defineProps<JsonEvent>()

const startDate = new Date(props.start_date);
const endDate = new Date(props.end_date);

const zoom = ref(15);


const map = ref<typeof LMap>(null)

const attendance = useForm({
    email: "",
    name: "",
    contact: "",
    more_info: "",
    amount_of_people: 1
})

const attendanceSuccess = ref(false);
</script>

<template>
    <main>
        <h1>{{ props.name }}</h1>
        <div v-if="props.registration_required" class="warning">
            This event requires a registration.
        </div>
        <div class="time">
            {{ startDate.toLocaleDateString("normal", { month: 'long', day: 'numeric' }) }}
            {{ startDate.toLocaleTimeString("normal", { hour: '2-digit', minute: '2-digit' }) }}
            -
            {{ endDate.toLocaleDateString("normal", { month: 'long', day: 'numeric' }) }}
            {{ endDate.toLocaleTimeString("normal", { hour: '2-digit', minute: '2-digit' }) }}
        </div>
        <div class="keyval" v-if="props.origin_url">
            <ul>
                <li v-if="props.origin_url">
                    Origin website: <a :href="props.origin_url">{{ props.origin_url }}</a>
                </li>
            </ul>
        </div>
        <div v-html="props.description" />
        <h2>Location</h2>
        <div class="address">
            <div class="map">
                <l-map :use-global-leaflet="false" style="z-index: 0;" ref="map" v-model:zoom="zoom"
                    :center="[props.lat, props.lng]">
                    <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" layer-type="base"
                        name="OpenStreetMap"></l-tile-layer>
                    <l-marker :lat-lng="[props.lat, props.lng]" />
                </l-map>
            </div>
            <div class="text">
                <h3>Address</h3>
                <a target="_blank"
                    :href="`https://www.google.com/maps/place/${props.lat},${props.lng}/@${props.lat},${props.lng},15z`">
                    <div v-for="addressLine in props.address.split(',')">{{ addressLine }}</div>
                </a>
            </div>
        </div>
        <div v-if="props.registration_location !== 'Remote'">
            <h2>Interested ?</h2>
            <div v-if="attendanceSuccess" class="attendance-success">
                Your attendance has been registered successfully!
            </div>
            <form @submit.prevent="attendance.post(`/events/${props.identifier}/attend`, {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    attendanceSuccess = true
                }
            })">
                <div class="data">
                    <label class="required">
                        <span class="label">Name</span>
                        <input type="text" name="name" required v-model="attendance.name">
                        <span class="hint">
                            May be your fursona name or username.
                        </span>
                    </label>

                    <label class="required">
                        <span class="label">Amount of people</span>
                        <input type="number" name="amount_of_people" required v-model="attendance.amount_of_people">
                        <span class="hint">
                            How many furs will be there with you, including you.
                        </span>
                    </label>

                    <label class="required">
                        <span class="label">Contact</span>
                        <input type="text" name="contact" required v-model="attendance.contact">
                        <span class="hint">
                            How we may contact you if anything happens.
                        </span>
                    </label>

                    <label class="required">
                        <span class="label">E-mail</span>
                        <input type="email" name="email" required v-model="attendance.email">
                        <span class="hint">
                            Mainly used for identifying you and backup communication.
                        </span>
                    </label>

                    <label style="grid-column-start:1; grid-column-end: 3">
                        <span class="label">Additional information</span>
                        <textarea name="more_info" v-model="attendance.more_info" />
                        <span class="hint">
                            Additional information we may need to know about.
                        </span>
                    </label>
                </div>

                <template v-if="props.registration_location !== 'Local'">
                    <p class="warning" v-if="props.registration_required">
                        This registration form is solely used for organization. Please
                        check the <a :href="props.origin_url">origin website</a> for the actual registration.
                    </p>
                    <p class="warning" v-else>
                        This form is used by us for organization. The official form is
                        over on the <a :href="props.origin_url">origin website</a>.
                    </p>
                </template>
                <button type="submit" :disabled="attendance.processing">Attend</button>
            </form>
        </div>
    </main>
</template>

<style lang="scss" scoped>
main>div {
    margin-bottom: 2em;

    &.address {
        display: flex;
        flex-direction: row;
        justify-content: start;
        width: 100%;

        h3 {
            margin-top: 0;
        }

        .map {
            flex-grow: 1;
            height: 300px;
            max-height: 30vw;
            width: 30vw;
            padding-right: 5vw;

            @media screen and (min-width: 660px) {
                max-width: 40vw;
            }
        }
    }
}

.attendance-success {
    background-color: rgba(20, 200, 70, 0.05);
    padding: 0.5em;
    border-radius: var(--border-radius);
    border: 1px solid rgba(20, 200, 70, 0.75);
    margin-bottom: 1em;
}

.warning {
    background-color: rgba(255, 150, 0, .05);
    color: rgb(255, 150, 0);
    border: 1px solid rgba(255, 150, 0, .75);
    border-radius: var(--border-radius);
    padding: .5em;
}

form {
    .data {
        display: grid;
        grid-template-columns: 1fr;
        grid-column-gap: 2rem;
        grid-row-gap: 1rem;
        margin-bottom: 2rem;

        @media screen and (min-width: 660px) {
            grid-template-columns: 1fr 1fr;
        }
    }

    label {
        display: flex;
        flex-direction: column;
        align-items: start;

        &.required span.label::after {
            content: '*';
            color: red;
        }

        input,
        textarea {
            width: 100%;
            padding: .75em;
            border: 1px solid color-mix(in oklab, var(--foreground), var(--background) 85%);
            border-radius: var(--border-radius);
        }

        .hint {
            font-size: .7em;
            opacity: 0.6;
        }
    }
}
</style>

<style lang="scss">
.map {
    img {
        border-radius: 0;
    }

    a {
        text-decoration: none !important;
    }
}
</style>
