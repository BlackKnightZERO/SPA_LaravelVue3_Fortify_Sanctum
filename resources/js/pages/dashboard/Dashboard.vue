<template>
  <div>

    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 py-6">Dashboard</h2>

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
              <tr v-for="artist in artists" :key="artist.id" 
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
                    <button type="button" class="inline-block text-gray-600 hover:text-gray-700">
                        <span class="text-blue-600 hover:text-blue-400 font-semibold mx-1">Edit</span>
                        <svg class="hidden inline-block h-6 w-6 fill-current" viewBox="0 0 24 24">
                            <path d="M12 6a2 2 0 110-4 2 2 0 010 4zm0 8a2 2 0 110-4 2 2 0 010 4zm-2 6a2 2 0 104 0 2 2 0 00-4 0z" />
                        </svg>
                    </button>
                    <button type="button" class="inline-block text-gray-600 hover:text-gray-700">
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
import { computed, ref, onMounted, defineComponent } from 'vue'
import axios from 'axios'
import LaravelVuePagination from 'laravel-vue-pagination';

    const authStore = useAuthStore()
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

    onMounted(() => {
      getResults()
    })
    
</script>


<script>
// import { useAuthStore } from '../../store/authState'
// import { computed, ref, onMounted, toRefs } from 'vue'
// import axios from 'axios'
// import LaravelVuePagination from 'laravel-vue-pagination';

// export default {

//   data() {
//     return {
//         show: null,
//     };
//   },
//   components: {
//       'Pagination': LaravelVuePagination
//   },

//   setup() {

//     const authStore = useAuthStore()
//     const artists = ref(null)
//     const laravelData = ref({})

//     const loggedInUser = computed(() => {
//       return authStore.$state.auth.name
//     })

//     const getResults = async(page = 1) => {
//             await axios({
//                 method: 'GET',
//                 url: '/api/artists?page=' + page,
//                 data: {}
//             }).then(response => {
//                 artists.value = response.data.data
//                 laravelData.value = response.data
//             });
//     }

//     onMounted(() => {
//       const myNewComponent = defineComponent({
//         'Pagination': LaravelVuePagination,
//       });
//       getResults()
//     })

//     return { loggedInUser, artists, getResults, laravelData }
//   }
// }
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