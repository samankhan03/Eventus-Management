<template>
  <pages-layout>
    <div class="flex flex-col items-center sm:flex-row sm:justify-between">
      <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
        Search Results
      </h2>
      
      <span class="text-gray-800 leading-tight text-lg capitalize mt-5 sm:mt-0">
        <inertia-link :href="route('members.index')" class="capitalize underline">
            Members
        </inertia-link>
      </span>
    </div>
    <inertia-link :href="route('profiles.show', result.username)" class="sm:w-1/2" v-for="result in results" :key="result.id">
      <div class="flex items-center bg-gray-50 px-2 py-3 border-l border-gray-500 mt-5 hover:bg-gray-400 hover:text-blue-800">
          <div class="flex flex-shrink-0">
              <img :src="result.profile_photo_url" :alt="result.name" class="h-8 w-8 rounded-full object-cover">
          </div>
          <div class="flex flex-grow overflow-hidden">
              <span class="text-lg ml-3">
                  {{ result.name }}
              </span>
          </div>
      </div>
  </inertia-link>
  </pages-layout>
</template>
  
<script>
  import PagesLayout from '@/Layouts/PagesLayout'

  export default {
    props: {
      results: {
        type: Array,
        required: true
      }
    },
    components: {
      PagesLayout
    }
  }
 </script>
  