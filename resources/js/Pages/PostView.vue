<script setup lang="ts">
import Comment from "@/Components/Comment.vue";
import PostActions from "@/Components/PostActions.vue";
import Tag from "@/Components/Tag.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Post } from "@/types";
import { usePage } from "@inertiajs/vue3";
import { formatRelative } from "date-fns";

const {
  props: {
    post: { author, image, tags, title, created_at, content },
  },
} = usePage<{ post: Post }>();
</script>

<template>
  <AppLayout :title="title">
    <div class="grid md:grid-cols-[60px,5fr,2fr] gap-4 items-start">
      <PostActions
        class="sticky top-20 md:flex flex-col items-center justify-center mt-5 hidden"
      />

      <div
        class="post mb-4 w-full overflow-hidden bg-white md:rounded-lg md:border md:border-solid md:border-gray-200"
      >
        <img v-if="image" :src="image" type="blog" classNames="max-h-pic" />
        <div class="px-6 pb-3 pt-0 md:px-12">
          <div class="details mt-5 sm:mt-8">
            <h1
              class="mb-4 text-3xl font-semibold sm:text-5xl sm:leading-title"
            >
              {{ title }}
            </h1>
            <div class="mt-2 flex items-center">
              <router-link
                :to="'/u/' + author.username"
                class="flex items-center text-black no-underline transition hover:text-gray-500"
              >
                <div class="img-wrapper h-9 w-9 overflow-hidden rounded-full">
                  <img
                    :src="author.profile_photo_path"
                    v-if="author.profile_photo_path"
                  />
                </div>
                <h4 class="ml-3 font-semibold">{{ author.name }}</h4>
              </router-link>
              <div class="dot mx-2 mt-1 h-1 w-1 rounded-full bg-gray-400"></div>
              <p class="mt-0.5 text-xs text-gray-500" v-if="created_at">
                {{ formatRelative(created_at, new Date()) }}
              </p>
            </div>
          </div>

          <div class="tags text-md mt-2 flex gap-2 text-gray-400">
            <Tag v-for="{ key } in tags" :key="key" :tag="key" />
          </div>

          <div v-html="content" class="prose py-8" />

          <PostActions
            class="flex md:hidden items-start justify-center border-t pt-2"
          />

          <Comment />
        </div>
      </div>
    </div>
  </AppLayout>
</template>
