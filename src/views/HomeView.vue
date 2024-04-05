<script lang="ts" setup>
import MeetPic from '@/assets/meetpic.jpg'
import EventList from '@/components/EventList.vue'
import { fetchNext } from '@/models/events'
import Rolino from '@/assets/organizers/rolino.jpeg'
import Misaki from '@/assets/organizers/misaki.jpg'
import Joyce from '@/assets/organizers/joyce.jpg'

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

    <section class="organizers">
      <h2>Our Local Furries</h2>
      <ul>
        <li>
          <a href="https://t.me/Rolino">
            <img :src="Rolino" alt="Rolino" />
          </a>
          <p class="name">Rolino</p>
          <ul>
            <li>Stammtisch Organizer Basel</li>
            <li>Programmer</li>
          </ul>
        </li>
        <li>
          <a href="https://t.me/Misaki_theswisswolf">
            <img :src="Misaki" alt="Misaki" />
          </a>
          <p class="name">Misaki</p>
          <ul>
            <li>Organizer Furmeet Laufental</li>
            <li>IT Engineer</li>
          </ul>
        </li>
        <li>
          <a href="https://t.me/SnugglyJoyce">
            <img :src="Joyce" alt="Joyce" />
          </a>
          <p class="name">Joyce</p>
          <ul>
            <li>Organizer Furmeet Laufental</li>
          </ul>
        </li>
      </ul>
    </section>
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

    &.organizers {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;

      h2 {
        font-size: 3rem;
      }

      > ul {
        list-style: none;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-column-gap: 2em;
        width: 60%;
        margin: 0 auto;

        li {
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: start;

          a {
            width: 100%;

            img {
              width: 100%;
              aspect-ratio: 1;
              object-fit: cover;
            }
          }

          .name {
            font-weight: 500;
            font-size: 1.5rem;
            margin: 0.5em;
          }

          ul {
            padding: 0;
            margin: 0;
          }
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
