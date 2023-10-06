<template>
    <div class="w-[600px] h-[80px] flex items-center">
        <TextInput type="text" class="block w-full mr-2" @keyup.enter.prevent="onSearch" v-model="search" autocomplete
            placeholder="Search for files and folders" />
    </div>
</template>

<script setup>
// Imports
import TextInput from '@/Components/TextInput.vue';
import { router } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { emitter, ON_SEARCH } from '@/event-bus.js';

// Uses
let params = '';

// Refs
const search = ref('');

// Props & Emit

// Computed

// Methods
function onSearch() {
    params.set('search', search.value)
    router.get(window.location.pathname + '?' + params.toString());
}

// Hooks
onMounted(() => {
    params = new URLSearchParams(window.location.search);
    search.value = params.get('search');

    emitter.emit(ON_SEARCH, search.value);
});
</script>
