import { defineStore } from 'pinia'

export type promisesStoreType = {
    promises: any[],
}

export const useCachePromiseStore = defineStore({
    id: 'promise',
    state: () => ({
        promises: [],
    } as promisesStoreType),
    getters: {
        getCachedPromise: (state) => {
            return (promiseKey : string) => {
                const result : any = state.promises.filter((promise : any) => promise.key === promiseKey)
                if (Array.isArray(result) && result.length === 1) {
                    return result[0].promise
                }
                return false
            }
        },
    },
    actions: {
        addCachedPromise(key : string, promise : Promise<any>) {
            const i : any = this.promises.findIndex((_element : any) => _element.key === key);
            if (i > -1) {
                this.promises[i] = {key: key, promise: promise};
            } else {
                this.promises.push({key: key, promise: promise});
            }
        },
        removeCachedPromise(key : string) {
            const i = this.promises.findIndex(_element => _element.key === key);
            if (i > -1) {
                this.promises.splice(i, 1);
            }
        }
    }
})
