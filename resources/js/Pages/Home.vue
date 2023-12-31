<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";

const show = ref(false);
</script>

<template>
    <AppLayout title="Home">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5"
                >
                    <div class="flex justify-between gap-5">
                        <h3 class="text-xl font-semibold">Home Content</h3>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
