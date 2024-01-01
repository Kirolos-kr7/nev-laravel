<script setup lang="ts">
import Banner from "@/Components/Banner.vue";
import Footer from "@/Components/Footer.vue";
import Navbar from "@/Components/Navbar.vue";
import { Head, router } from "@inertiajs/vue3";
import route from "ziggy-js";

defineProps({
  title: String,
});

const logout = () => {
  router.post(route("logout"));
};
</script>

<template>
  <div>
    <Head :title="title" />

    <Banner />

    <div class="min-h-screen bg-gray-100">
      <Navbar />

      <!-- Page Content -->
      <main class="max-w-7xl mx-auto md:px-6 lg:px-8 py-4">
        <slot />
      </main>
    </div>
  </div>
</template>
