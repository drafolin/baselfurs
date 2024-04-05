<script lang="ts" setup>
import MeetPic from '@/assets/meetpic.jpg'
import EventList from '@/components/EventList.vue'
import { fetchNext } from '@/models/events'

const events = fetchNext(3)
</script>

<template>
  <main>
    <section class="welcome">
      <div class="sub">
        <div class="sub">
          <h1>Welcome to the Basel furries!</h1>
          <p>We are a fuzzy community in the Basel area</p>
        </div>
        <div class="sub calendar-container">
          <h2>Calendar - Events</h2>

          <EventList :events="events" class="calendar" />

          <button class="primary">Open Calendar</button>
        </div>
      </div>

      <div class="pic">
        <img
          :src="MeetPic"
          alt="A picture of the furmeet, with two fursuited furs in the foreground"
          class="meet-pic"
        />
      </div>
    </section>

    <section class="learn-more"></section>

    <section class="organizers"></section>
  </main>
</template>

<style lang="scss" scoped>
main {
  > section {
    display: flex;
    flex-direction: row;
    min-height: calc(100vh - 7rem);
    align-items: stretch;

    div.sub {
      display: flex;
      flex-direction: column;
      align-items: stretch;
      justify-content: center;
      text-align: center;
      padding: 1em;
    }

    > div.sub {
      padding: 1em 6.25em;
    }

    .calendar-container {
      .calendar {
        width: 80%;
        margin: auto;
      }

      button {
        width: fit-content;
        margin: 3em auto 0;
      }
    }
  }
}

div.pic {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.meet-pic {
  width: 30em;
}
</style>
