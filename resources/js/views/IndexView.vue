<script setup lang="ts">
    import TextPage from '@/components/TextPage.vue'
    const getApiQuery = 'pages/index'
</script>

<template>
    <article>
        <TextPage :url="getApiQuery" :key="getApiQuery"></TextPage>
    </article>
</template>
