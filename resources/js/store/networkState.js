import { defineStore } from 'pinia'

export const useNetworkStore = defineStore('networkStore',{
    state: () => ({
        error: null,
        errorStatus:null,
        isError:false,
        success: null,
        successStatus:null,
        isSuccess:false
    }),
    persist: true,

    getters: {
        getError(state){
            return this.error
        },
        getErrorStatus(state){
            return this.errorStatus
        },
        getIsError(state){
            return this.isError
        },
        getSuccess(state){
            return this.success
        },
        getSuccessStatus(state){
            return this.successStatus
        },
        getIsSuccess(state){
            return this.isSuccess
        },
    },

    actions: {
        setError(data) {
            this.error = data
        },
        setErrorStatus(data) {
            this.errorStatus = data
        },
        setIsError(data){
            this.isError = data
        },
        setSuccess(data) {
            this.success = data
        },
        setSuccessStatus(data) {
            this.successStatus = data
        },
        setIsSuccess(data){
            this.isSuccess = data
        },
        reset(){
            this.error = null,
            this.errorStatus = null,
            this.isError = false,
            this.success = null,
            this.successStatus=null,
            this.isSuccess=false
        }
    }

})