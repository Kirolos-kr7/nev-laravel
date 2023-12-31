<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

defineProps<{
  tag: string;
}>();
</script>

<template>
  <Link
    :href="`/t/${tag}`"
    class="rounded-md px-1.5 py-0.5 text-gray-400 no-underline transition-all hover:bg-gray-100"
  >
    <div class="key">{{ `#` + tag }}</div>
  </Link>
</template>
