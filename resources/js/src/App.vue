<template>
  <div>
    <div class="py-24 bg-gray-100">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <input type="text" v-model="value">
          <div class="p-6 text-gray-900">
            {{ value }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const value = ref('Type here!');

</script>