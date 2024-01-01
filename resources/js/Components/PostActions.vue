<script setup lang="ts">
import { Post } from "@/types";
import { usePage } from "@inertiajs/vue3";
import { Heart, MessageCircle, Share2 } from "lucide-vue-next";

const like = (x: any, y: any) => {};
const likedByUser = (x: any) => {};
const toDiscussion = () => {};
const shareLink = () => {};
const isCopiedToClipboard = false;

const {
  props: {
    post: { id, likes_count },
  },
} = usePage<{ post: Post }>();
</script>

<template>
  <div>
    <div class="flex md:flex-col items-center">
      <button
        class="heart m-4 mb-4 cursor-pointer rounded-full bg-red-100 transition-all hover:bg-red-300 focus:!bg-red-300"
        @click="like(likes_count, id)"
      >
        <Heart class="p-2" :size="38" :class="likedByUser(likes_count)" />
      </button>
      <span
        class="pointer-events-none -ms-2 md:ms-0 md:-mt-2"
        v-if="likes_count"
        >{{ likes_count !== 0 ? likes_count : "" }}</span
      >
    </div>
    <button
      class="chat m-4 mb-4 cursor-pointer rounded-full bg-green-100 transition-all hover:bg-green-300 focus:!bg-green-300"
      @click="toDiscussion"
    >
      <MessageCircle class="p-2" :size="38" />
    </button>
    <button
      @click="shareLink"
      class="share m-4 mb-4 cursor-pointer rounded-full bg-indigo-100 transition-all hover:bg-indigo-300 focus:!bg-indigo-300"
    >
      <Share2 class="p-2" :size="38" />

      <transition name="fade">
        <div
          class="pointer-events-none absolute top-14 z-10 w-max rounded-md bg-white py-1 px-2"
          v-if="isCopiedToClipboard"
        >
          👌 Copied To Clipboard
        </div>
      </transition>
    </button>
  </div>
</template>
