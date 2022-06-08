<template>
  <div>

    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 py-6">Dashboard</h2>

      <div class="flex flex-row-reverse">
      <router-link to="/add"
        class="px-4 py-2 mb-2 text-white transition-colors duration-200 transform bg-blue-600 rounded hover:bg-blue-500 focus:outline-none"
        type="button"
        >+ Add</router-link>
        <br>
        </div>

    <div class="bg-white shadow-lg hover:shadow-xl rounded-md overflow-hidden">
        <table class="table flex table-auto w-full leading-normal">
          <thead class="uppercase text-gray-600 text-xs font-semibold bg-gray-200">
            <tr class="hidden md:table-row">
              <th class="text-left p-3">
                <p>ID</p>
              </th>
              <th class="text-left p-3">
                <p>Title</p>
              </th>
              <th class="text-left p-3">
                <p>Category</p>
              </th>
              <th class="text-right p-3">
                <p>Nationality</p>
              </th>
              <th class="text-right p-3">
                  <p>Actions</p>
              </th>
            </tr>
          </thead>
          <tbody class="flex-1 text-gray-700 sm:flex-none">
              <tr v-for="(artist, index) in artists" :key="artist.id" 
              class="border-t first:border-t-0 flex p-1 md:p-3 hover:bg-gray-100 md:table-row flex-col w-full flex-wrap">
                <td class="p-1 md:p-3">
                    <label class="text-xs text-gray-500 uppercase font-semibold md:hidden" for="">ID</label>
                    <p class="">{{ artist.id }}</p>
                </td>
                <td class="p-1 md:p-3">
                    <label class="text-xs text-gray-500 uppercase font-semibold md:hidden" for="">Title</label>
                    <p class="">{{ artist.title }}</p>
                </td>
                <td class="p-1 md:p-3">
                    <label class="text-xs text-gray-500 uppercase font-semibold md:hidden" for="">Title</label>
                    <p class="">{{ artist.artist_category.title }}</p>
                </td>
                <td class="p-1 md:p-3 md:text-right">
                    <label class="text-xs text-gray-500 uppercase font-semibold md:hidden" for="">Nationality</label>
                    <div>{{ artist.nationality }}</div>
                </td>
                <td class="text-right p-1 md:p-3">
                    <router-link :to="{ name: 'spa.edit', params: { id: artist.id }}" type="button" class="inline-block text-gray-600 hover:text-gray-700">
                      <span class="text-blue-600 hover:text-blue-400 font-semibold mx-1">Edit</span>
                        <svg class="hidden inline-block h-6 w-6 fill-current" viewBox="0 0 24 24">
                            <path d="M12 6a2 2 0 110-4 2 2 0 010 4zm0 8a2 2 0 110-4 2 2 0 010 4zm-2 6a2 2 0 104 0 2 2 0 00-4 0z" />
                        </svg>
                    </router-link>
                    <button @click="destroy(artist.id, index)" type="button" class="inline-block text-gray-600 hover:text-gray-700">
                        <span class="text-red-600 hover:text-red-400 font-semibold mx-1">Delete</span>
                        <svg class="hidden inline-block h-6 w-6 fill-current" viewBox="0 0 24 24">
                            <path d="M12 6a2 2 0 110-4 2 2 0 010 4zm0 8a2 2 0 110-4 2 2 0 010 4zm-2 6a2 2 0 104 0 2 2 0 00-4 0z" />
                        </svg>
                    </button>
                </td>
              </tr>  
          </tbody>
          <LaravelVuePagination :data="laravelData" @pagination-change-page="getResults" />
        </table>
    </div>
                            
  </div>
</template>

<script setup>
import { useAuthStore } from '../../store/authState'
import { useNetworkStore } from '../../store/networkState'
import { computed, ref, onMounted, defineComponent } from 'vue'
import axios from 'axios'
import LaravelVuePagination from 'laravel-vue-pagination';

    const authStore = useAuthStore()
    const networkStore = useNetworkStore()

    const artists = ref(null)
    const laravelData = ref({})

    const loggedInUser = computed(() => {
      return authStore.$state.auth.name
    })

    const getResults = async(page = 1) => {
            await axios({
                method: 'GET',
                url: '/api/artists?page=' + page,
                data: {}
            }).then(response => {
                artists.value = response.data.data
                laravelData.value = response.data
            });
    }

    const destroy = async(id, index) => {

      if (confirm(`Are you sure?`)) {
          await axios.delete(`/api/artists/${id}`)
        .then(res => {
          if(res.status === 204) {
            artists.value.splice(index, 1)
            networkStore.setSuccess('Deleted successfully')
            networkStore.setIsSuccess(true)
            networkStore.setSuccessStatus(204)
          }
        }).catch(err=> {
          console.log(err)
        })
      }      
    }

    onMounted(() => {
      getResults()
    })
    
</script>

<style>

ul.pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
}

ul.pagination li {
  display: inline;
}

ul.pagination li a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    border: 1px solid gray;
    border-radius: 7px;
    margin: 0 2px;
}

ul.pagination li a:hover:not(.active) {
  background-color: #ddd;
}

</style>