<template>
  <div class="flex flex-col items-end mt-5 px-3 py-3 w-full">
    <input
      type="text"
      class="border rounded-md px-2 py-1 w-full"
      placeholder="Say something..."
      v-model="form.body"
      @keyup.enter="submit"
    />

    <!-- Error message -->
    <p v-if="error" class="text-red-500 text-sm mt-1 self-start">{{ error }}</p>

    <button
      class="inline-flex items-center justify-center px-4 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest mt-5 hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 transition ease-in-out duration-150"
      :class="{ 'opacity-25': form.processing }"
      :disabled="form.processing"
      @click="submit"
    >
      Send
    </button>
  </div>
</template>

<script>
export default {
  props: ['form', 'item', 'method'],
  data() {
    return {
      error: null,
    };
  },
  methods: {
    submit() {
      if (!this.form.body || this.form.body.trim() === '') {
        this.error = 'Message cannot be empty';
        return;
      }

      this.error = null; // Clear error
      this.method();     // Call parent method
    },
  },
};
</script>
