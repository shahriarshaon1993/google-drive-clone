<script setup>
import { Head, Link } from "@inertiajs/vue3";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

function asset(path) {
    return `/${path}`;
}
</script>

<template>
    <Head title="Home" />

    <DefaultLayout>
        <section
            class="bg-white dark:bg-gray-900 pb-16 py-16 md:py-24 lg:py-36"
        >
            <div
                class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12"
            >
                <div class="mr-auto place-self-center lg:col-span-7">
                    <h1
                        class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white"
                    >
                        Drop Vault <br />
                        File Management
                    </h1>
                    <p
                        class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400"
                    >
                        DropVault is a web-based file management application
                        designed to allow users to store, manage, and share
                        files securely.
                    </p>
                    <Link
                        :href="route('register')"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                    >
                        Get started
                    </Link>
                </div>
                <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                    <img
                        :src="asset('images/dropvault.png')"
                        alt="mockup"
                        class="rounded-xl cursor-pointer transform hover:scale-105 transition duration-700 ease-in-out"
                    />
                </div>
            </div>
        </section>
    </DefaultLayout>
</template>
