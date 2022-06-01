<template>
  <div class="mt-16 w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800 bg-slate-200">
        
        <div class="px-6 py-4">
            <h2 class="text-3xl font-bold text-center text-gray-700 dark:text-white">Create Artist</h2>

            <form @submit.prevent="submitForm">
                
                <div class="w-full mt-4">
                    <input 
                    class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" 
                    type="email" placeholder="Title" aria-label="Title"
                    autofocus v-model="title"
                    />
                </div>

                <div class="w-full mt-4">
                    <textarea placeholder="Bio" rows="5" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" ></textarea>
                </div>

                <div class="w-full mt-4">
                    <input type="file">
                </div>

                <div class="w-full mt-4">
                    <select class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-md dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" >
                        <option disabled value="" selected>Type</option>
                        <option value="" v-for="(category) in artistCategory" :key="category.id">{{ category.title }}</option>
                    </select>
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
        </div>

    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const artistCategory = ref(null)

const title = ref(null)

const getResults = async(page = 1) => {
            await axios({
                method: 'GET',
                url: '/api/artist-category',
                data: {}
            }).then(response => {
                artistCategory.value = response.data.data
            });
    }

onMounted(() => {
    getResults()
})

</script>

<style>

</style>