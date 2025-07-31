<script setup>
import Navbar from "@/Components/Section/Navbar.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="min-h-screen bg-gray-900 text-white antialiased font-hanken">
        <Navbar />
        <div>
            <slot />
        </div>
    </div>
</template>
