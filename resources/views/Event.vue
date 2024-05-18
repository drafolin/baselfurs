<script setup lang="ts">
import { JsonEvent } from '@/models/events';
import { ref } from 'vue';
import "leaflet/dist/leaflet.css";
import { LMap, LTileLayer, LMarker } from "@vue-leaflet/vue-leaflet";

const props = defineProps<JsonEvent>()

const startDate = new Date(props.start_date);
const endDate = new Date(props.end_date);

const zoom = ref(15);


const map = ref<typeof LMap>(null)
</script>

<template>
    <main>
        <h1>{{ props.name }}</h1>
        <div class="time">
            {{ startDate.toLocaleDateString("normal", { month: 'long', day: 'numeric' }) }}
            {{ startDate.toLocaleTimeString("normal", { hour: '2-digit', minute: '2-digit' }) }}
            -
            {{ endDate.toLocaleDateString("normal", { month: 'long', day: 'numeric' }) }}
            {{ endDate.toLocaleTimeString("normal", { hour: '2-digit', minute: '2-digit' }) }}
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
