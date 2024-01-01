<script setup lang="ts">
import { Heart } from "lucide-vue-next";
import SecondaryButton from "./SecondaryButton.vue";

const props = defineProps<{
  id: number;
  type: "post" | "comment";
  count: number;
  disabled?: boolean;
}>();

const like = (x: any, y: any) => {};
</script>

<template>
  <SecondaryButton
    class="border-0 !shadow-none !px-2.5 !py-1.5"
    :disabled="disabled"
  >
    <Heart :size="20" />

    <span
      class="ml-2 select-none whitespace-pre text-gray-600"
      style="line-height: 22px"
      >{{ count }} likes</span
    >
  </SecondaryButton>
</template>
