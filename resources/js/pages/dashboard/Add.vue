<template>
  <div class="mt-16 w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800 bg-slate-200">
        
        <div class="px-6 py-4">
            <h2 class="text-3xl font-bold text-center text-gray-700 dark:text-white">Create Artist</h2>

            <form @submit.prevent="submitForm">
                
                <div class="w-full mt-4">
                    <input 
                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" 
                    type="text" placeholder="Title" aria-label="Title"
                    autofocus v-model="title"
                    />
                </div>

                <div class="w-full mt-4">
                    <textarea
                    placeholder="Bio"
                    rows="5"
                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300"
                    v-model="description"></textarea>                
                </div>

                <div class="w-full mt-4">
                    <input type="file" v-on:change="storeImage">
                </div>

                <div class="w-full mt-4">
                    <select
                      class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300"
                      @change="selctCategory">
                        <option disabled value="" selected>Type</option>
                        <option :value="category.id" v-for="(category) in artistCategory" :key="category.id">{{ category.title }}</option>
                    </select>
                </div>

                <div class="w-full mt-4">
                    <input 
                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" 
                    type="text" placeholder="Nationality" aria-label="Nationality"
                    autofocus v-model="nationality"
                    />
                </div>

                <div class="flex items-center justify-end mt-4 gap-1">
                    
                    <button class="px-4 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-600 rounded hover:bg-blue-500 focus:outline-none" 
                    type="submit"
                    >Add</button>

                    <router-link to="/dashboard" class="px-4 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded hover:bg-gray-600 focus:outline-none" 
                    type="button"
                    >Cancel</router-link>
                </div>

            </form>
            <br>
            <div class="border-t-2 border-red-500" v-show="validationError.length > 0">
                <ul>
                    <li class="text-red-700" v-for="(verror, index) in validationError" :key="index">
                        * {{ verror }}
                    </li>
                </ul>
            </div>
        </div>

    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useNetworkStore } from '../../store/networkState'

const router = useRouter()
const networkStore = useNetworkStore()

const artistCategory = ref(null)

const title = ref(null)
const description = ref(null)
const artist_category_id = ref(null)
const image = ref(null)
const nationality = ref(null)

const validationError = ref([])

const getResults = async(page = 1) => {
            await axios({
                method: 'GET',
                url: '/api/artist-category',
                data: {}
            }).then(response => {
                artistCategory.value = response.data.data
            });
    }

const submitForm = async () => {
    let txt = ``
    validationError.value=[]
    const url = `api/artists`

    const response = await axios.post(url, {
        title: title.value,
        description: description.value,
        artist_category_id : artist_category_id.value,
        image: image.value,
        nationality: nationality.value
    })
    // }, { headers: {'content-type': 'multipart/form-data' }})
    .then(res=> {
        if(res.status===201) {
            networkStore.setSuccess('Saved Successfully')
            networkStore.setIsSuccess(true)
            networkStore.setSuccessStatus(201)
            router.push('/dashboard')
        }
    }).catch(err =>{
        if (err.response){
            if(err.response.status===422){
                console.log(err.response)
                for (const [key, value] of Object.entries(err.response.data.errors)) {
                        validationError.value.push(value[0])
                    }
            }
        } else if (err.request) {
            console.log(`request error`)
            console.error(err.request);
        } else {
            console.error(err);
        }
    })
}

const storeImage = (e) => {
    image.value = e.target.files[0]
}    
const selctCategory = (e) => {
    artist_category_id.value = e.target.value
}    

onMounted(() => {
    getResults()
})

</script>

<style>

</style>