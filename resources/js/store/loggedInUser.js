import { defineStore } from 'pinia'

export const useLoggedInUserStore = defineStore('authStore',{
    state: () => ({
        user: {

        }
    }),

    getters: {
        auth(state){
            return this.user
        },
        authName(state){
            return this.user.name
        },
        authEmail(state){
            return this.user.email
        },
        authImage(state){
            return `${window.location.origin}/image/user/${this.user.image}`
        },
        authPhone(state){
            return this.user.phone
        },
    },

    actions: {
        setUser(data) {
            this.user = data
        }
    }

})