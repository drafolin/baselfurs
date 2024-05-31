<script lang="ts" setup>
import RoliBoop from '@/assets/roliboop.webp'
import { Link } from '@inertiajs/vue3';

const year = new Date().getFullYear()
</script>

<template>
    <footer>
        <section class="links">
            <div class="img">
                <div>Furry &mdash; Basel</div>
                <img :src="RoliBoop" alt="Rolino's booping you" />
            </div>

            <div class="lnks">
                <div class="awoo">
                    <h2>Awoo~</h2>
                    <ul>
                        <li>
                            <a href="https://t.me/+6HzWgZE399tkMTVk" target="_blank">Basler furry telegram</a>
                        </li>
                        <li>
                            <Link href="/calendar">Calendar</Link>
                        </li>
                    </ul>
                </div>

                <div class="link">
                    <h2>Affiliates</h2>
                    <ul>
                        <li>
                            <a href="https://xn--brenhhle-0za8p.community/" target="_blank">Bärenhöhle</a>
                        </li>
                        <li>
                            <a href="https://furryfandom.ch/" target="_blank">FurryFandom.ch</a>
                        </li>
                        <li>
                            <a href="https://discord.gg/avvujWhq9x" target="_blank">Swiss Furry Fandom Discord</a>
                        </li>
                    </ul>
                </div>

                <div class="privacy">
                    <h2>Privacy</h2>
                    <ul>
                        <li>
                            <!-- TODO: Router Link -->
                            <a href="/">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="mailto:rolinothewolf@gmail.com">Contact us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="copy">
            <span class="copy"> &copy; 2024{{ year === 2024 ? '' : `-${year}` }} </span>
            <a href="https://drafolin.ch" target="_blank">Dråfølin</a>
        </section>
    </footer>
</template>

<style lang="scss" scoped>
footer {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    width: 100vw;
    padding: 100px;

    @media screen and (max-width: 660px) {
        padding: 1rem;
        margin-top: 3rem;
    }

    section {
        width: 100%;
    }

    section.links {
        display: grid;
        grid-template-columns: 1fr 1fr;
        justify-items: center;

        @media screen and (max-width: 660px) {
            grid-template-columns: 1fr;
        }

        :first-child {
            justify-self: start;
        }

        :last-child {
            justify-self: end;
        }

        .img {
            display: flex;
            align-items: center;
            flex-direction: column;

            @media screen and (max-width: 660px) {
                width: 100%;
            }

            img {
                height: 10em;
            }
        }

        .lnks {
            display: flex;
            flex-direction: row;
            width: 100%;
            justify-content: space-between;
            flex-wrap: wrap;

            @media screen and (max-width: 660px) {
                flex-direction: column;
            }

            >div {
                padding: 0 0.5em;

                h2 {
                    margin: 0;
                    padding: 0.5em 0;
                }

                ul {
                    list-style: none;
                    display: flex;
                    flex-direction: column;
                    padding: 0;
                    margin: 0;

                    li {
                        margin: 0.25em;
                    }
                }
            }
        }
    }

    section.copy {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
        margin-top: 5em;

        span.copy {
            margin: auto 0.5em;
        }
    }
}
</style>
