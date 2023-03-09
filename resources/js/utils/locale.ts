const defaultLocale = 'en'
const availableLocales = ['en', 'it']

export const getInitialLocale = () => {
    const currentQuery = window.location.pathname
    const splitQuery = currentQuery.split('/')
    if (splitQuery[1] && availableLocales.indexOf(splitQuery[1]) >= 0) {
        // Locale from url
        return  splitQuery[1]
    } else {
        // Locale from storage or default locale
        const storedLocale = localStorage.getItem('locale')
        return storedLocale ? storedLocale : defaultLocale
    }
}

export const getDefaultLocale = () => {
    return defaultLocale
}

export const getAvailableLocales = () => {
    return availableLocales
}
