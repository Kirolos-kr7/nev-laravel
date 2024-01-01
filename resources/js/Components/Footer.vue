<script setup lang="ts">
import { Tags } from "@/types";
import { Link, usePage } from "@inertiajs/vue3";
import Tag from "./Tag.vue";
const {
  props: { tags },
} = usePage<{ tags: Tags }>();
</script>

<template>
  <footer class="py-9 bg-gray-300">
    <div class="list-none mx-auto w-8/12">
      <div>
        <ul class="flex items-center justify-center flex-wrap">
          <li class="" v-for="{ key } in tags" :key="key">
            <Tag :tag="key" class="block text-gray-500" />
          </li>
        </ul>
      </div>
      <ul class="flex items-center justify-center flex-wrap pt-3">
        <li
          class=""
          v-for="{ name, to } in [
            { name: 'Who are we?', to: '/' },
            { name: 'Privacy Policy', to: '/' },
            { name: 'Terms Of Use', to: '/' },
            { name: 'Get In Touch', to: '/' },
          ]"
          :key="name"
        >
          <Link
            :tag="name"
            :href="to"
            class="block text-gray-500 rounded-md px-1.5 py-0.5 transition-all hover:bg-gray-100 whitespace-nowrap"
            >{{ name }}
          </Link>
        </li>
      </ul>
    </div>
    <div class="break w-52 h-px bg-gray-400 mx-auto my-5"></div>
    <div class="text-center mb-6">
      A constructive and inclusive social network for software developers.
      <br />
      With you every step of your journey.
    </div>
    <div class="copyright font-bold text-center">&copy; NEV 2021</div>
  </footer>
</template>

<style scoped>
.icons a:hover img {
  filter: brightness(0.5);
}
</style>
