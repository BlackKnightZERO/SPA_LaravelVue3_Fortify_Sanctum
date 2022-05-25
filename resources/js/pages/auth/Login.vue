<template>
  <div class="mt-16 w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800 bg-slate-200">
        
        <div class="px-6 py-4">
            <h2 class="text-3xl font-bold text-center text-gray-700 dark:text-white">Carnival</h2>

            <h3 class="mt-1 text-xl font-medium text-center text-gray-600 dark:text-gray-200">Welcome Back</h3>

            <p class="mt-1 text-center text-gray-500 dark:text-gray-400">Login or create account</p>

            <form @submit.prevent="submitForm">
                <div class="w-full mt-4">
                    <input 
                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" 
                    type="email" placeholder="Email Address" aria-label="Email Address"
                    autofocus v-model="emailRef"
                    />
                </div>

                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" 
                    type="password" placeholder="Password" aria-label="Password" 
                    v-model="passwordRef"
                    />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a href="#" class="text-sm text-gray-600 dark:text-gray-200 hover:text-gray-500">Forget Password?</a>

                    <button class="px-4 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded hover:bg-gray-600 focus:outline-none" 
                    type="submit"
                    ref="loginBtnRef"
                    :disabled="isDisabledRef"
                    >Login</button>
                </div>
            </form>
        </div>

        <div class="flex items-center justify-center py-4 text-center bg-gray-50 dark:bg-gray-700">
            <span class="text-sm text-gray-600 dark:text-gray-200">Don't have an account? </span>
            <router-link to="/register" class="mx-2 text-sm font-bold text-blue-500 dark:text-blue-400 hover:underline">Register</router-link>
        </div>
    </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { useAuthStore } from '../../store/authState'
import { useNetworkStore } from '../../store/networkState'
import { ref, onMounted } from 'vue'
import axios from 'axios'

    const router = useRouter()
    const authStore = useAuthStore()
    const networkStore = useNetworkStore()

    const emailRef = ref('')
    const passwordRef = ref('')

    const loginBtnRef = ref(null)
    const isDisabledRef = ref(false)

    const submitForm = async () => {
        loginBtnRef.value.innerHTML='Logging in..'
        isDisabledRef.value=true
        login()
        loginBtnRef.value.innerHTML='Login'
        isDisabledRef.value=false
    }

    const login = async () => {
        await axios({
            method: 'POST',
            url: '/api/login',
            data: {
                email: emailRef.value,
                password: passwordRef.value,
            }
        }).then(response => {
            networkStore.setSuccess('Login successful')
            networkStore.setIsSuccess(true)
            networkStore.setSuccessStatus(200)
            authStore.setAuth(response.data.data)
            router.push('/dashboard')
        }).catch(error => {

            let txt = ''
            if (error.response) {
                // console.log(`error.response`);
                if(error.response.status==422){
                    for (const [key, value] of Object.entries(error.response.data.errors)) {
                        txt += `${key}: ${value}`
                        txt += `\n  `
                    }
                    networkStore.setError(txt)
                    networkStore.setErrorStatus(422)
                    networkStore.setIsError(true)
                } else if (error.response.status === 401) {
                    networkStore.setError(error.response.data.message)
                    networkStore.setErrorStatus(401)
                    networkStore.setIsError(true)
                }
            } else if (error.request) {
                console.log(`error.request`)
                console.log(error.request)
            } else {
                console.log('Error', error.message)
            }

        })

    }
</script>

<script>
// import { useRouter } from 'vue-router'
// import { useAuthStore } from '../../store/authState'
// import { useNetworkStore } from '../../store/networkState'
// import { ref, onMounted } from 'vue'

// import axios from 'axios'
// export default {
//     setup() {

//         const router = useRouter()
//         const authStore = useAuthStore()
//         const networkStore = useNetworkStore()

//         const emailRef = ref('')
//         const passwordRef = ref('')

//         const loginBtnRef = ref(null)
//         const isDisabledRef = ref(false)


//         onMounted(() => {
//             // console.log(loginBtnRef)
//         })          

//         const submitForm = async () => {
//             loginBtnRef.value.innerHTML='Logging in..'
//             isDisabledRef.value=true
//             login()
//             loginBtnRef.value.innerHTML='Login'
//             isDisabledRef.value=false
//         }

//         const login = async () => {
//             await axios({
//                 method: 'POST',
//                 url: '/api/login',
//                 data: {
//                     email: emailRef.value,
//                     password: passwordRef.value,
//                 }
//             }).then(response => {
//                 networkStore.setSuccess('Login successful')
//                 networkStore.setIsSuccess(true)
//                 networkStore.setSuccessStatus(200)
//                 authStore.setAuth(response.data.data)
//                 router.push('/dashboard')
//             }).catch(error => {

//                 let txt = ''
//                 if (error.response) {
//                     // console.log(`error.response`);
//                     if(error.response.status==422){
//                         for (const [key, value] of Object.entries(error.response.data.errors)) {
//                             txt += `${key}: ${value}`
//                             txt += `\n  `
//                         }
//                         networkStore.setError(txt)
//                         networkStore.setErrorStatus(422)
//                         networkStore.setIsError(true)
//                     } else if (error.response.status === 401) {
//                         networkStore.setError(error.response.data.message)
//                         networkStore.setErrorStatus(401)
//                         networkStore.setIsError(true)
//                     }
//                 } else if (error.request) {
//                     console.log(`error.request`)
//                     console.log(error.request)
//                 } else {
//                     console.log('Error', error.message)
//                 }

//             })

//         }

//         return { 
//             emailRef, 
//             passwordRef, 
//             submitForm, 
//             loginBtnRef, 
//             isDisabledRef,
//         }
//     },
// }
</script>

<style>

</style>