<script setup lang="ts">
    import { onMounted } from 'vue'
    import useApi from '@/use/useApi'

    // Components
    import LoadingBlock from '@/components/LoadingBlock.vue'
    import ErrorBlock from '@/components/ErrorBlock.vue'

    // Api composable
    const { data, isLoading, isLoaded, errors, getApiWithCache } = useApi()

    // Get data from api on component mounted
    onMounted(() => {
        // Get data from api with cache time of 300 seconds
        getApiWithCache('categories', 300)
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
            <h1>{{ $t("mainmenu.categories") }}</h1>
            <div class="categories">
                <div v-for="category in data" :key="category.id" class="category">
                    <RouterLink :to="{name: 'Category', params: {slug: category.slug }}">{{ category.title[$i18n.locale] }}</RouterLink> (<strong>{{ category.projectsCount }}</strong>)
                </div>
            </div>
        </div>
    </article>
</template>


<style scoped>
    .categories {
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
        align-items: flex-start;
    }
    .category {
        padding: 1em;
        background-color: var(--scheme-color-border);
        text-align: left;
        margin: 0 1em 1em 1em;
    }
</style>
