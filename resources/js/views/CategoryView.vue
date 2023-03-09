<script setup lang="ts">
    import useApi from '@/use/useApi'
    import { onMounted } from 'vue'
    import { useRoute } from 'vue-router'

    // Components
    import LoadingBlock from '@/components/LoadingBlock.vue'
    import ErrorBlock from '@/components/ErrorBlock.vue'

    // Api composable
    const { data, isLoading, isLoaded, errors, getApiWithCache } = useApi()

    // Get data from api on component mounted
    onMounted(() => {
        const route = useRoute()
        // Get data from api with cache time of 300 seconds
        getApiWithCache('categories/' + route.params.slug, 300)
    })
</script>

<template>
    <article>
        <div v-if="isLoading && !isLoaded">
            <LoadingBlock />
        </div>
        <div v-if="errors && !isLoading">
            <ErrorBlock>{{ errors }}</ErrorBlock>
        </div>
        <div v-if="isLoaded && !errors">
            <h1>{{ data.title[$i18n.locale] }}</h1>

            <div class="projects">
                <div v-for="project in data.projects" :key="project.id">
                    <h2>{{ project.title[$i18n.locale] }}</h2>
                    <img :src="project.cover" :alt="project.title">
                    <p>{{ project.content[$i18n.locale] }}</p>
                </div>
            </div>

            <RouterLink :to="{name: 'Categories'}">{{ $t('button.all_categories') }}</RouterLink>
        </div>
    </article>
</template>

<style scoped>
    .projects {
        display: flex;
        flex-flow: row wrap;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5em;
    }

    h2 {
        margin-bottom: 0.8em;
        font-size: 1.2em;
    }

    @media only screen and (orientation: landscape) and (min-width: 768px) {
        h2 {
            font-size: 2em;
        }
    }
    .projects > div {
        flex: 0 0 47%;
    }

    .projects > div > img {
        width: 100%;
        height: auto;
        margin-bottom: 0.8em;
    }
</style>
