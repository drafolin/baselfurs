<script lang="ts" setup>
type Link = {
    url: string
    name: string
}

type Category = {
    name: string
    links: Link[]
}

const links: Category[] = [
    {
        name: 'Telegram – Chats',
        links: [
            {
                name: 'Furry Chat Room (SFW) – CH',
                url: 'https://t.me/joinchat/BIiWsD9Vu_28gsFrSuUGog'
            }
        ]
    },
    {
        name: 'Telegram – Furmeets',
        links: [
            {
                name: 'Stammtisch (Basel Furry) – Basel',
                url: 'https://t.me/+6HzWgZE399tkMTVk'
            },
            {
                name: 'Berner Furry Plauderecke DE/EN – Bern',
                url: 'https://t.me/bernerplauderecke'
            },
            {
                name: 'Zürcher Furry-Stammtisch – News & Events – Zürich',
                url: 'https://t.me/StammiZH'
            },
            {
                name: 'Solothurner Stammtisch🇨🇭🇬🇧🇳🇱 – Solothurn',
                url: 'https://t.me/joinchat/CUzRrxMN05BPwpxU0XAIxA'
            },
            {
                name: 'Luzerner Furries – Luzern',
                url: 'https://t.me/+RP4UGPSuygRjYjNk'
            },
            {
                name: 'St. Gallen | stammtisch🐾 – St. Gallen',
                url: 'https://t.me/+vjBnSO5CPaw1YjQ0'
            },
            {
                name: 'Furmeet Laufental – Laufen',
                url: 'https://t.me/furmeetLaufen'
            }
        ]
    },
    {
        name: 'Telegram – Events',
        links: [
            {
                name: 'Fantasy Basel – Furry',
                url: 'https://t.me/FaBaFurry'
            },
            {
                name: 'Swiss Furry Cons and Walks',
                url: 'https://t.me/SwissFurrysConsandWalks'
            }
        ]
    },
    {
        name: 'Discord',
        links: [
            {
                name: 'SwissFurs Discord',
                url: 'https://discord.gg/r5Fuyt72ht'
            }
        ]
    }
]
</script>

<template>
    <main>
        <h1>Links</h1>
        <nav>
            <ul>
                <li v-for="category in links" :key="category.name">
                    <h2>{{ category.name }}</h2>
                    <ul>
                        <li v-for="link in category.links" :key="link.url">
                            <a :href="link.url" target="_blank">{{ link.name }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </main>
</template>

<style lang="scss" scoped>
main {
    nav {
        >ul {
            padding: 0;
            margin: 0;
            list-style: none;
            display: grid;
            justify-content: space-evenly;
            grid-template-columns: 1fr 1fr;

            @media screen and (max-width: 1024px) {
                grid-template-columns: 1fr;
                min-width: 80%;
                width: fit-content;
                margin: 0 auto;
            }

            >li {
                h2 {
                    margin: 0.75em 0 0.25em;
                }

                >ul {
                    list-style: '-';

                    @media screen and (max-width: 660px) {
                        padding-left: 1em;
                    }

                    >li {
                        padding: 0 0 0 1em;
                    }
                }
            }
        }
    }
}
</style>
