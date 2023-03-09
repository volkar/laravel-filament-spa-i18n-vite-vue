<script setup lang="ts">
    import { onMounted } from 'vue'
    import useApi from '@/use/useApi'
    // Components
    import LoadingBlock from '@/components/LoadingBlock.vue'
    import ErrorBlock from '@/components/ErrorBlock.vue'

    // Component props
    const props = defineProps(['url', 'key'])

    // Get api data
    const { data, isLoading, isLoaded, errors, getApiWithCache } = useApi()
    onMounted(() => {
        // Get data from api with cache time of 300 seconds
        getApiWithCache(props.url, 300)
    })
</script>

<template>
    <div v-if="isLoading && !isLoaded">
        <LoadingBlock />
    </div>
    <div v-if="errors && !isLoading">
        <ErrorBlock>{{ errors }}</ErrorBlock>
    </div>
    <div v-if="isLoaded && !errors">
        <h1>{{ data.title[$i18n.locale] }}</h1>
        <div v-html="data.content[$i18n.locale]"></div>
    </div>
</template>
