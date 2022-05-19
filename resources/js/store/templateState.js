import { defineStore } from 'pinia'

export const useTemplateStateStore = defineStore('templateStore',{
    state: () => ({
        template: {
            logo:null,
            logoThumbnail:null
        }
    }),

    getters: {
        logo(state){
            return this.template.logo
        },
        logoThumbnail(state){
            return this.template.logoThumbnail
        },
        baseUrl(){
            return window.location.origin
        },
        getImagePath(type){
            return `${window.location.origin}/image/${type}/`
        }

    },

    actions: {
        setLogo(data) {
            this.template.logo = data
        },
        setLogoThumbnail(data) {
            this.template.logoThumbnail = data
        },
    }

})