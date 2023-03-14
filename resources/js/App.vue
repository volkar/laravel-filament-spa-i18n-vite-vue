<script setup lang="ts">
import {onMounted, ref, unref} from 'vue'
    import useApi from '@/use/useApi'
    import { useI18n } from 'vue-i18n'
    import { useSettingsStore } from '@/stores/settingsStore'
    import router from '@/router'

    // Components
    import LoadingBlock from '@/components/LoadingBlock.vue'
    import ErrorBlock from '@/components/ErrorBlock.vue'
    import MainMenu from '@/components/MainMenu.vue'

    // Light / dark mode
    const darkMode = ref(true);
    // Mode switcher
    const switchMode = (newMode : string) => {
        if (newMode === 'dark') {
            darkMode.value = true
            document.getElementById('html').classList.remove("light")
        } else {
            darkMode.value = false
            document.getElementById('html').classList.add("light")
        }
        // Save value to local storage
        localStorage.setItem('mode', newMode)
    }
    // Check for local storage
    if (localStorage.getItem('mode')) {
        switchMode(<string>localStorage.getItem('mode'))
    } else {
        // Check for browser preferences
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            // Browser set to prefer dark mode
            switchMode('dark')
        } else {
            switchMode('light')
        }
    }

    // Settings store
    const settingsStore = useSettingsStore()

    // Api composable
    const { data, isLoading, isLoaded, errors, getApi } = useApi()

    // Load initial settings async function
    const loadInitialSettings = async () => {
        // Get initial settings.
        // Single request per page load, so no cache use needed.
        await getApi('init');

        if (data.value.loaded === true) {
            // Initial settings loaded successfully, store them
            settingsStore.storeSettings(unref(data))
        }
    }

    // On App component mount load initial settings
    onMounted(() => {
        loadInitialSettings()
    })

    const i18n = useI18n({ useScope: 'global' })

    const languages = [
        {code: 'en', title: 'English'},
        {code: 'it', title: 'Italian'},
    ]

    const switchLanguage = (newLang : string) => {
        // Set locale
        i18n.locale.value = newLang
        // Set html lang attr
        document.documentElement.lang = newLang
        // Store locale (for "/" redirect later instead of default locale)
        localStorage.setItem('locale', newLang)
        // Push router with new locale
        const currentPath = router.currentRoute.value.fullPath
        const splitPath = currentPath.split("/")
        splitPath[1] = newLang
        router.push(splitPath.join('/'))
    }
</script>

<template>

    <div v-if="isLoading && !isLoaded">
        <LoadingBlock />
    </div>
    <div v-if="errors && !isLoading">
        <ErrorBlock>{{ errors }}</ErrorBlock>
    </div>

    <header role="banner" v-if="isLoaded && !errors">

        <img :src="settingsStore.logo" alt="Logo" id="logo">

        <div v-if="languages.length > 1" class="lang-block">
            <a href="#" v-for="l in languages" @click.prevent="switchLanguage(l.code)" v-bind:key="l.code" :class="{ active: l.code === $i18n.locale }">{{ l.title }}</a>

            <div class="theme-bar">
                <div class="theme-light" v-if="darkMode">
                    <a v-on:click="switchMode('light')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
                <div class="theme-light" v-if="!darkMode">
                    <a v-on:click="switchMode('dark')">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <MainMenu />

    </header>

    <main role="main" v-if="isLoaded && !errors">

        <RouterView />

        <hr />

        <div class="logo-links">
            <a href="https://vuejs.org" target="_blank">
                <img alt="Vue logo" class="logo vue" src="/gfx/vue.svg" />
            </a>
            <a href="https://pinia.vuejs.org" target="_blank">
                <img alt="Pinia logo" class="logo pinia" src="/gfx/pinia.svg" />
            </a>
            <a href="https://laravel.com" target="_blank">
                <img alt="Laravel logo" class="logo laravel" src="/gfx/laravel.svg" />
            </a>
            <a href="https://vitejs.dev" target="_blank">
                <img alt="Vite logo" class="logo vite" src="/gfx/vite.svg" />
            </a>
        </div>
    </main>

    <small><strong>{{ settingsStore.title }}</strong><br>{{ settingsStore.description }}<br>{{ settingsStore.phone }}</small>

</template>

<style scoped>
    #logo {
        width: 4em;
        height: auto;
        margin-bottom: 1.4em;
    }
    .lang-block {
        position: relative;
        text-align: center;
        margin-bottom: 1em;
    }
    .lang-block a {
        padding: 0.2em 1em;
        display: inline-block
    }
    .lang-block a.active {
        color: var(--scheme-color-text);
    }
    .theme-bar {
        position: absolute;
        top: 50%;
        transform: translate(0, -50%);
        right: 0;
        height: 100%;
    }
    .theme-bar svg {
        width: 1.2em;
        height: auto;
        cursor: pointer;
    }
</style>
