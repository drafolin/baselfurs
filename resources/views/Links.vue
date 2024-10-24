<script lang="ts" setup>
type Link = {
    url: string
    name: string
    position: number
}

type Category = {
    name: string
    links: Link[]
    position: number
}

const {links} = defineProps<{ links: Category[] }>()
links.forEach(link => link.links.sort((a, b) => a.position - b.position))
links.sort((a, b) => a.position - b.position)
</script>

<template>
    <main>
        <h1>Links</h1>
        <nav>
            <ul>
                <li v-for="category in links" :key="category.position">
                    <h2>{{ category.name }}</h2>
                    <ul>
                        <li v-for="link in category.links" :key="link.position">
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
        > ul {
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

            > li {
                h2 {
                    margin: 0.75em 0 0.25em;
                }

                > ul {
                    list-style: '-';

                    @media screen and (max-width: 660px) {
                        padding-left: 1em;
                    }

                    > li {
                        padding: 0 0 0 1em;
                    }
                }
            }
        }
    }
}
</style>
