<script setup lang="ts">
import { Posts } from "@/types/index";
import { Link, usePage } from "@inertiajs/vue3";
import { formatRelative } from "date-fns";
import Tag from "./Tag.vue";

const isCurrentUser = false;
const mnuToggle = (x: any) => {};
const removePost = (x: any) => {};
const likedByUser = (x: any) => {};
const like = () => {};

defineProps<{
  thumbnail?: boolean;
}>();

const page = usePage<{ posts: Posts }>();
</script>

<template>
  <transition-group appear name="fadeIn">
    <div
      class="mb-2 w-full bg-white md:mb-5 overflow-hidden"
      :class="
        !thumbnail
          ? 'md:rounded-lg md:border md:border-solid md:border-gray-200'
          : 'border border-solid border-gray-200 !transition-opacity sm:rounded-lg'
      "
      v-for="{
        author,
        id,
        created_at,
        description,
        image,
        slug,
        tags,
        title,
      } in page.props.posts || []"
      :key="id"
    >
      <img
        v-if="!thumbnail && image != null"
        :src="image"
        type="blog"
        classNames="max-h-pic"
      />
      <div class="block w-full p-5">
        <div class="mb-2 flex items-center" v-if="!thumbnail">
          <Link
            :href="'/u/' + author.username"
            class="flex items-center text-black no-underline transition hover:text-gray-500"
          >
            <div
              class="img-wrapper h-9 w-9 overflow-hidden rounded-full"
              v-if="author.profile_photo_path"
            >
              <img :src="author.profile_photo_path" type="user" />
            </div>
            <h4 class="ml-3 hidden font-BioRhyme font-semibold sm:block">
              {{ author.username }}
            </h4>
          </Link>
          <div
            class="dot mx-2 mt-1 hidden h-1 w-1 rounded-full bg-gray-400 sm:block"
          ></div>
          <div class="ml-3 flex flex-col sm:ml-0 sm:block">
            <h4 class="font-BioRhyme font-semibold sm:hidden">
              {{ author.username }}
            </h4>
            <div
              class="capitalize pt-0.5 font-BioRhyme text-sm sm:pt-0"
              v-if="created_at"
            >
              {{ formatRelative(created_at, new Date()) }}
            </div>
          </div>
        </div>
        <div :class="!thumbnail ? 'ml-10' : ''">
          <div class="flex items-start justify-between">
            <Link
              :href="`/p/` + slug"
              class="mb-2 font-BioRhyme text-2xl font-black text-black no-underline transition hover:text-gray-500"
            >
              {{ title }}
            </Link>
            <div
              class="relative flex cursor-pointer rounded-md px-1 py-3 transition-all hover:bg-gray-100"
              v-if="thumbnail && isCurrentUser"
              @click="mnuToggle(id)"
            >
              <span class="m-0.5 block h-1 w-1 rounded-full bg-gray-400"></span
              ><span class="m-0.5 block h-1 w-1 rounded-full bg-gray-400"></span
              ><span
                class="m-0.5 block h-1 w-1 rounded-full bg-gray-400"
              ></span>
              <!-- <transition name="fadeInDown"> -->
              <div
                class="mnu absolute top-[35px] right-0 hidden w-48 rounded-md border-4 border-solid transition"
                :id="`${id}`"
                style="box-shadow: rgb(0, 0, 0) 3px 3px"
              >
                <ul class="list-none p-0">
                  <!-- <li
                    class="bg-white hover:bg-gray-100 transition-all px-4 py-2"
                  >
                    Edit
                  </li> -->
                  <li
                    class="bg-white px-4 py-2 transition-all hover:bg-gray-100"
                    @click="removePost(id)"
                  >
                    Remove
                  </li>
                </ul>
              </div>
              <!-- </transition> -->
            </div>
          </div>
          <div
            class="capitalize mt-1 font-BioRhyme text-sm"
            v-if="created_at && thumbnail"
          >
            {{ formatRelative(created_at, new Date()) }}
          </div>
          <p v-if="id && !thumbnail">
            {{ description }}
          </p>
          <div class="tags text-md mt-2 flex gap-2 font-BioRhyme text-gray-400">
            <Tag v-for="{ key } in tags" :tag="key" :key="key" />
          </div>
          <!-- <button
            class="btn-small"
            :class="user ? '' : 'opacity-30'"
            @click.prevent="like(likes, id)"
          >
            <svg
              :class="likedByUser(likes)"
              class="-m-0.5 h-6 w-6 transition-all"
              :id="'l' + id"
              fill="#9ca3af3d"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
              ></path>
            </svg>
            <span
              class="ml-1 select-none whitespace-pre font-BioRhyme text-gray-600"
              style="line-height: 22px"
              >{{ likes.length }} likes</span
            >
          </button> -->
        </div>
      </div>
    </div>
  </transition-group>
</template>
<!-- 
<script setup>
import { computed, ref } from 'vue'
import { useRoute } from 'vue-router'
import { db } from '../firebase'
import { store } from '../store'
import { tweakDate } from '../helper'
import img from './img.vue'

let route = useRoute()

const user = computed(() => {
  return store.state.user
})

const isCurrentUser = computed(() => {
  return user.value?.displayName === route.params.username
})

const mnuToggle = (id) => {
  let mnu = document.getElementById(id)
  mnu.classList.toggle('hidden')
  window.addEventListener(
    'mouseup',
    (e) => {
      if (
        e.target !== mnu &&
        e.target !== mnu.parentElement &&
        e.target.parentElement !== mnu.parentElement
      ) {
        mnu.classList.add('hidden')
      }
    },
    { once: true },
  )
}
const removePost = (post) => {
  db.collection('posts')
    .doc(id)
    .delete()
    .then(() => {
      db.collection('comments')
        .where('slug', '==', slug)
        .get()
        .then((res) => {
          res.forEach((comment) => {
            db.collection('comments').doc(comment.id).delete()
          })
        })
    })
    .finally(() => {
      alert('DONE')
    })
    .catch((err) => {
      alert(err)
    })
}

const likedByUser = (likes) => {
  if (user.value) {
    if (likes.includes(user.value.displayName)) {
      return 'isLiked'
    }
  }
}

const like = (likes, id) => {
  if (user.value) {
    let arr = likes
    if (!arr.includes(user.value.displayName)) {
      arr.push(user.value.displayName)
    } else {
      let index = arr.indexOf(user.value.displayName)
      arr.splice(index, 1)
    }
    db.collection('posts')
      .doc(id)
      .update({
        likes: arr,
        likes_count: arr.length,
      })
      .catch((err) => {
        console.log(err)
      })
    document.getElementById('l' + id).classList.toggle('isLiked')
  }
}
</script>  -->
