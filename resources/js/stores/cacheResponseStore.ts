import { defineStore } from 'pinia'

export type responsesStoreType = {
    responses: any[],
}

export const useCacheResponseStore = defineStore({
    id: 'cache',
    state: () => ({
        responses: [],
    } as responsesStoreType),
    getters: {
        getCachedResponse: (state) => {
            return (responseKey : string) => {
                const i : number = state.responses.findIndex((_element : any) => _element.key === responseKey)
                if (i > -1) {
                    if (Math.floor(Date.now() / 1000) >= state.responses[i].expire) {
                        // Expired. Remove element and return false
                        state.responses.splice(i, 1);
                        return false
                    }
                    return state.responses[i].data
                } else {
                    return false
                }
            }
        },

    },
    actions: {
        addCachedResponse(responseKey : string, data : any, seconds : number) {
            const i : number = this.responses.findIndex((_element : any) => _element.key === responseKey)
            const dataToStore = {key: responseKey, data: data, expire: Math.floor(Date.now() / 1000) + seconds}
            if (i > -1) {
                // Found. Replace
                this.responses[i] = dataToStore
            } else {
                // Add
                this.responses.push(dataToStore);
            }
        }
    }
})
