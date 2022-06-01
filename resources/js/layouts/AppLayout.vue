<template>
    
    <div>
      <Header v-if="authStatus" />
      <div class="container mx-auto px-4">
        <Alert v-show="isAlert" :msg="alertMsg" :type="alertType" />  
        <router-view></router-view>
      </div>
    </div>

</template>

<script setup>
import Header from '../components/Header.vue'
import Alert from '../components/Alert.vue'

import { useAuthStore } from '../store/authState'
import { useNetworkStore } from '../store/networkState'
import { ref, computed, onMounted, watch } from 'vue'
import axios from 'axios'

    const authStore = useAuthStore()
    const networkStore = useNetworkStore()
    const isAlert = ref(false)
    const alertMsg = ref('')
    const alertType = ref('success')

    onMounted(async () => {
        axios({
            method: 'GET',
            url: '/sanctum/csrf-cookie',
        }).then(response => {
            // console.log(response)
        });
    })

    watch(networkStore, (cb) => {

        if(cb.getIsError || cb.getIsSuccess) {
            isAlert.value = true
            if(cb.getIsError) {
                alertMsg.value = cb.getError
                alertType.value = 'error'
            } else if(cb.getIsSuccess) {
                alertMsg.value = cb.getSuccess
                alertType.value = 'success'
            }
        } else {
            isAlert.value = false
        }

        setTimeout(() => {
            cb.reset()
        }, "3000")

        
    })

    const auth = computed({
        get() {
            return authStore.getAuth
        },
        set(newValue) {

        }
    })

    const authStatus = computed({
        get() {
            return authStore.getAuthStatus
        },
        set(newValue) {

        }
    })
    
</script>

<script>
// import Header from '../components/Test/Header.vue'
// import Alert from '../components/Test/Alert.vue'

// import { useAuthStore } from '../store/authState'
// import { useNetworkStore } from '../store/networkState'
// import { ref, computed, onMounted, watch } from 'vue'
// import axios from 'axios'

// export default {
//     components:{
//       Header,
//       Alert
//     },
//     mounted() {
//         console.log('app-layout-mounted')
//     },

//     setup() {
//         const authStore = useAuthStore()
//         const networkStore = useNetworkStore()
//         const isAlert = ref(false)
//         const alertMsg = ref('')
//         const alertType = ref('success')

//         onMounted(async () => {
//             axios({
//                 method: 'GET',
//                 url: '/sanctum/csrf-cookie',
//             }).then(response => {
//                 // console.log(response)
//             });
//         })

//         watch(networkStore, (cb) => {

//             if(cb.getIsError || cb.getIsSuccess) {
//                 isAlert.value = true
//                 if(cb.getIsError) {
//                     alertMsg.value = cb.getError
//                     alertType.value = 'error'
//                 } else if(cb.getIsSuccess) {
//                     alertMsg.value = cb.getSuccess
//                     alertType.value = 'success'
//                 }
//             } else {
//                 isAlert.value = false
//             }

//             setTimeout(() => {
//                 cb.reset()
//             }, "3000")

            
//         })

//         const auth = computed({
//             get() {
//                 return authStore.getAuth
//             },
//             set(newValue) {

//             }
//         })

//         const authStatus = computed({
//             get() {
//                 return authStore.getAuthStatus
//             },
//             set(newValue) {

//             }
//         })

//         return { 
//             auth, 
//             authStatus, 
//             isAlert,
//             alertMsg,
//             alertType
//         }
//     },
// }
</script>
