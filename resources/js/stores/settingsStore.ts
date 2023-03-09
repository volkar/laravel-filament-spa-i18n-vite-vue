import { defineStore } from 'pinia'

export type settingsStoreType = {
    title: string,
    logo: string,
    description: string,
    phone: string,
}

export const useSettingsStore = defineStore('settings', {
    state: () => ({
        title: "",
        logo: "",
        description: "",
        phone: "",
    } as settingsStoreType),
    actions: {
        storeSettings(settings : object) {
            // Store values in the state
            Object.keys(settings).forEach(key => {
                if (key !== 'loaded') {
                    if (this.hasOwnProperty(key)) {
                        this[key as keyof typeof this] = settings[key as keyof typeof settings]
                    }
                }
            });
        }
    }
})
