<template>
    <div>
        <input
            type="text"
            v-model="searchTerm" 
            @keyup.enter="search"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="Search"
            style="width: 300px"
            
        />
    </div>
</template>
<script>
  export default {
    data() {
      return {
        searchTerm: ''
      }
    },
    methods: {
      search() {
        // Call the Laravel controller method that handles the search
        this.$inertia.get(route('search'), { q: this.searchTerm })
      }
    }
  }
</script>
