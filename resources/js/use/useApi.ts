import { ref, unref } from 'vue'
import ky from 'ky'
import { useCacheResponseStore } from '@/stores/cacheResponseStore'
import { useCachePromiseStore } from '@/stores/cachePromiseStore'

const api = ky.extend({
    prefixUrl: '/api/'
});

export default function useApi() {

    const data : any = ref(false)
    const isLoading = ref(false)
    const isLoaded = ref(false)
    const errors : any = ref(false)

    // Simple get request without cache
    const getApi = async (url : string) => {

        isLoading.value = true

        return new Promise(function (resolve, reject) {
            // Retrieve data
            api.get(unref(url)).json()
                .then((newData: any) => {
                    data.value = newData.data
                    isLoading.value = false
                    isLoaded.value = true
                    // Resolve
                    resolve(newData.data)

                })
                .catch((err) => {
                    errors.value = err
                    isLoading.value = false
                    // Reject
                    reject(err)
                })
        })
    }

    // Get request with caching with defined amount of time
    const getApiWithCache = async (url : string, seconds : number) => {

        isLoading.value = true

        const cache = useCacheResponseStore()
        const promises = useCachePromiseStore()

        // Key for cache responses/promises storages
        const cacheKey = unref(url)

        // Check the cache
        const cachedResponse = cache.getCachedResponse(cacheKey)

        if (!cachedResponse) {
            // Check cached promises and return it if available
            const cachedPromise = promises.getCachedPromise(cacheKey)
            if (cachedPromise !== false) {
                return cachedPromise
            }
        }

        const newPromise = new Promise(function(resolve, reject) {

            if (cachedResponse) {
                // Cached, assign cached data
                data.value = cachedResponse
                isLoading.value = false
                isLoaded.value = true

                // Resolve promise
                resolve(cachedResponse)
            } else {
                // Retrieve data
                api.get(unref(url)).json()
                    .then((newData : any) => {
                        // Add to the cache
                        if (cacheKey !== undefined) {
                            cache.addCachedResponse(cacheKey, newData.data, seconds)
                        }

                        // Remove promise from the cache
                        promises.removeCachedPromise(cacheKey)

                        data.value = newData.data
                        isLoading.value = false
                        isLoaded.value = true

                        // Resolve promise
                        resolve(newData.data)

                    })
                    .catch((err) => {
                        errors.value = err
                        isLoading.value = false
                        // Reject promise
                        reject(err)
                    })
            }
        });

        if (!cachedResponse) {
            // Cache new promise
            promises.addCachedPromise(cacheKey, newPromise)
        }

        return newPromise
    }

    // postApi, putApi, deleteApi can be added here (without cache)

    return {
        data,
        isLoading,
        isLoaded,
        errors,
        getApi,
        getApiWithCache,
    }
}
