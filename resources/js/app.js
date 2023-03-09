import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { createI18n } from 'vue-i18n'

import App from '@/App.vue'
import router from '@/router'

import { getInitialLocale, getDefaultLocale } from '@/utils/locale'

const app = createApp(App)
const pinia = createPinia()

// Translations
import en from '@/translations/en.json'
import it from '@/translations/it.json'

const messages = {
    en: en,
    it: it,
}

const i18n = createI18n({
    legacy: false,
    allowComposition: true,
    locale: getInitialLocale(),
    fallbackLocale: getDefaultLocale(),
    messages,
})

app.use(pinia)
app.use(router)
app.use(i18n)
app.mount('#app')
