<script setup lang="ts">
import { Tags } from "@/types";
import { usePage } from "@inertiajs/vue3";
import Tag from "./Tag.vue";
const page = usePage<{ tags: Tags }>();
</script>

<template>
  <div
    class="overflow-hidden rounded-none border border-gray-200 bg-white px-3 md:py-3 md:mb-3 md:rounded-lg md:border-solid"
  >
    <h2 class="text-xl font-bold hidden md:block px-1 pb-1">Tags</h2>
    <div
      class="xscroll md:text-base flex items-center md:flex-wrap relative -mx-2 py-2 md:mx-0 text-sm font-medium"
      v-if="page.props.tags"
    >
      <Tag v-for="{ key } in page.props.tags" :key="key" :tag="key" />
    </div>
  </div>
</template>
