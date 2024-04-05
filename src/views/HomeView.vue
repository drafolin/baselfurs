<script lang="ts" setup>
import MeetPic from '@/assets/meetpic.jpg'
import EventList from '@/components/EventList.vue'
import { fetchNext } from '@/models/events'
import { useRouter } from 'vue-router'

const events = fetchNext(3)

const router = useRouter()
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

          <RouterLink class="primary button" to="/calendar">Open Calendar</RouterLink>
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

    <section class="learn-more">
      <div>
        <h2>Want to get to know the fandom better?</h2>
        <p>
          Then join one of our numerous chats, groups and channels and write with us! Everyone is
          welcome!
        </p>
        <RouterLink class="primary button" to="/links">Links list</RouterLink>
      </div>
    </section>

    <section class="organizers"></section>
  </main>
</template>

<style lang="scss" scoped>
main {
  > section {
    display: flex;
    flex-direction: row;
    min-height: calc(100vh - 7rem);
    padding: 3em 0;

    &:first-child {
      padding: 0 0 3em;
    }

    &:last-child {
      padding: 0;
    }

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

    &.welcome {
      align-items: stretch;

      .calendar-container {
        .calendar {
          width: 80%;
          margin: auto;
        }

        .button {
          width: fit-content;
          margin: 3em auto 0;
        }
      }
    }

    &.learn-more {
      > div {
        background-color: rgba(var(--accent-rgb), 0.1);
        width: 100%;
        height: fit-content;
        padding: 5em 25em;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        border-radius: var(--sm-border-radius);

        h2 {
          font-size: 2.5rem;
        }

        button {
          margin-top: 3em;
        }
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
