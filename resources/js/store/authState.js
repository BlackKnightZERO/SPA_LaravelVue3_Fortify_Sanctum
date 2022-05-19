import { defineStore } from 'pinia'

export const useAuthStore = defineStore('authStore',{
    state: () => ({
        auth: {

        },
        isAutheticated:false
    }),
    persist: true,

    getters: {
        getAuth(state){
            return this.auth
        },
        getAuthStatus(state){
            return this.isAutheticated
        },
    },

    actions: {
        setAuth(data) {
            this.auth = data
            this.isAutheticated = true
        },
        resetAuth(){
            this.auth = {}
            this.isAutheticated = false
        }

    },

})