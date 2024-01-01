<script setup lang="ts">
import { Comment, Post } from "@/types";
import { Link, usePage } from "@inertiajs/vue3";
import axios from "axios";
import { formatRelative } from "date-fns";
import { onMounted, ref } from "vue";
import LikeButton from "./LikeButton.vue";

const {
  props: {
    post: { author_id },
  },
} = usePage<{ post: Post }>();
const comments = ref<Comment[]>([]);
const commentText = ref("");
const selectedComment = ref<number | null>(null);
const commentDialog = ref(false);

onMounted(async () => {
  const res = await axios.get(`/api/comments`, { params: { author_id } });
  comments.value = res.data;
});

const postNewComment = () => {};
const commentActions = (x: any) => {};
const editComment = (x: any) => {};
const removeComment = (x: any) => {};
const performEdit = (x: any) => {};
</script>

<template>
  <div class="discussion m-5" :class="comments.length > 0 ? 'mb-6' : 'mb-2'">
    <h2 class="font-BioRhyme text-2xl font-extrabold">
      Discussion {{ comments.length > 0 ? "(" + comments.length + ")" : " " }}
    </h2>
    <div class="comment-area mx-auto my-6 w-11/12 text-right sm:my-8">
      <textarea
        class="commentArea textarea mx-auto mb-0 block h-40 w-full resize-none rounded-md border border-solid border-gray-400 bg-gray-100 p-2 text-lg outline-none"
        placeholder="Join the discussion"
        v-model="commentText"
      ></textarea>
      <button
        class="newCommentBtn relative mt-4 mr-auto inline-block cursor-pointer overflow-hidden border-none bg-green-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-green-400"
        @click="postNewComment"
        v-if="commentText !== ''"
      >
        Add Comment
      </button>
    </div>
    <div class="flex flex-col gap-5 mx-auto px-5">
      <div
        v-for="comment in comments"
        :key="comment.id"
        class="flex items-start gap-2"
      >
        <Link :href="'/u/' + comment.user.username" class="translate-y-5">
          <div class="h-9 w-9 transform overflow-hidden rounded-full">
            <img
              v-if="comment.user.profile_photo_path"
              :src="comment.user.profile_photo_path"
              type="user"
            />
          </div>
        </Link>
        <div class="flex flex-col w-full gap-1 items-start">
          <div
            class="w-full rounded-md border border-solid border-gray-200 py-6 px-4 transition-all"
          >
            <div class="mb-2 flex items-center justify-between">
              <div
                class="flex flex-col font-BioRhyme sm:flex-row sm:items-center"
              >
                <Link
                  :href="'/u/' + comment.user.username"
                  class="font-medium text-black no-underline transition hover:text-gray-500"
                >
                  <h4 class="font-semibold">
                    {{ comment.user.name }}
                  </h4>
                </Link>
                <div
                  v-if="comment.created_at"
                  class="dot mx-2 mt-1 hidden h-1 w-1 rounded-full bg-gray-400 sm:block"
                />
                <span class="pt-0.5 text-sm" v-if="comment.created_at"
                  >{{ formatRelative(comment.created_at, new Date()) }}
                </span>
              </div>
              <div
                class="relative flex cursor-pointer rounded-md px-1 py-3 transition-all hover:bg-gray-100"
                @click="commentActions(comment.id)"
              >
                <span
                  class="m-0.5 block h-1 w-1 rounded-full bg-gray-400"
                ></span>
                <span
                  class="m-0.5 block h-1 w-1 rounded-full bg-gray-400"
                ></span>
                <span
                  class="m-0.5 block h-1 w-1 rounded-full bg-gray-400"
                ></span>
                <div
                  class="mnu absolute top-[35px] right-0 hidden w-48 rounded-md border-4 border-solid"
                  :id="`${comment.id}`"
                  style="box-shadow: 3px 3px #000"
                >
                  <ul class="list-none p-0">
                    <li
                      class="bg-white px-4 py-2 transition-all hover:bg-gray-100"
                      @click="editComment(comment)"
                    >
                      Edit
                    </li>
                    <li
                      class="bg-white px-4 py-2 transition-all hover:bg-gray-100"
                      @click="removeComment(comment)"
                    >
                      Remove
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <p class="whitespace-pre-line text-xl">
              {{ comment.content }}
            </p>
          </div>
          <LikeButton
            :id="comment.id"
            type="comment"
            :count="comment.likes_count"
          />
        </div>
      </div>
    </div>
  </div>

  <div
    class="edit fixed top-0 left-0 z-50 flex h-screen w-full items-center justify-center overflow-hidden"
    v-if="commentDialog"
  >
    <div class="bgBlur absolute z-0 h-full w-full bg-black bg-opacity-50"></div>
    <div
      class="textAreaWrapper z-10 w-11/12 max-w-prose rounded-md bg-white p-9 pt-5"
    >
      <div class="mb-5 flex items-center justify-between">
        <h2>Edit Comment</h2>
        <span
          class="cursor-pointer rounded-md p-1 pb-0"
          @click="commentDialog = false"
          ><svg
            class="h-6 w-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            ></path>
          </svg>
        </span>
      </div>
      <textarea
        class="textarea mx-auto mb-0 block h-40 w-full resize-none rounded-md border border-solid border-gray-400 bg-gray-100 p-2 text-lg outline-none"
        placeholder="Comment Edit"
        v-model="commentText"
      ></textarea>
      <div
        class="btn mt-4 ml-auto table cursor-pointer border-none bg-green-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-green-400"
        @click="performEdit"
      >
        Edit Comment<span class="whitespace-pre tracking-normal"> -></span>
      </div>
    </div>
  </div>
</template>

<!-- /////////////////////////////////////////////////////// -->

<!-- 
<script setup>
import { ref, onMounted, watch } from 'vue'
import { store } from '../store'
import { db, timestamp } from '../firebase'
import { useRoute } from 'vue-router'
import { tweakDate } from '../helper'
import VImage from './VImage.vue'

let comments = ref([]),
  newCommentLoader = ref(false),
  commentText = ref(''),
  user = ref(),
  postSlug = ref()

const route = useRoute()

const selectedComment = ref({
  dialog: false,
  commentEditValue: '',
  commentID: '',
})

onMounted(async () => {
  await db
    .collection('comments')
    .where('slug', '==', route.params.slug)
    .orderBy('createdAt', 'desc')
    .get()
    .then((res) => {
      res.forEach((res) => {
        let newComment = res.data()
        newComment.id = res.id
        comments.value.push(newComment)
      })
    })
    .catch((err) => {
      console.log(err)
    })
  user.value = store.state.user
})

const postNewComment = () => {
  newCommentLoader.value = true
  document.querySelector('.newCommentBtn').disabled = true
  let userData = {}
  let moreAboutUser = db.collection('users').doc(user.value.displayName).get()
  moreAboutUser
    .then((res) => {
      userData = res.data()
      db.collection('comments')
        .add({
          val: commentText.value,
          slug: store.state.postSlug,
         .user username: user.value.displayName,
          user.profile_photo_path: user.value.photoURL,
          name: userData.fullName,
          createdAt: timestamp(),
          likes: [],
          likes_count: 0,
        })
        .then((res) => {
          db.collection('comments')
            .doc(res.id)
            .get()
            .then((response) => {
              let comment = response.data()
              comment.id = response.id
              comments.value.unshift(comment)
              commentText.value = ''
            })
            .then(() => {
              newCommentLoader.value = false
            })
        })
    })

    .catch((err) => {
      console.log(err)
    })
}

const commentActions = (id) => {
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

const removeComment = (comment) => {
  db.collection('comments')
    .doc(comment.id)
    .delete()
    .then(() => {
      let toRemove = document.getElementById('p' + comment.id)
      let index = comments.value.indexOf(comment)
      toRemove.classList.add('opacity-0')
      window.removeEventListener('mouseup', document.getElementById(comment.id))
      toRemove.addEventListener('transitionend', () => {
        comments.value.splice(index, 1)
      })
    })
    .catch((err) => {
      console.log(err)
    })
}

const editComment = (comment) => {
  selectedComment.value.dialog = true
  selectedComment.value.commentEditValue = comment.val
  selectedComment.value.commentID = comment.id
  document.getElementById(comment.id).classList.remove('hidden')
}

const performEdit = () => {
  db.collection('comments')
    .doc(selectedComment.value.commentID)
    .update({
      val: selectedComment.value.commentEditValue,
    })
    .then(() => {
      comments.value.forEach((comment) => {
        if (comment.id === selectedComment.value.commentID) {
          comment.val = selectedComment.value.commentEditValue
        }
      })
      selectedComment.value.dialog = false
      selectedComment.value.commentEditValue = ''
      selectedComment.value.commentID = ''
    })
    .catch((err) => {
      console.log(err)
    })
}

const likedByUser = (likes) => {
  if (user.value) {
    if (likes?.includes(user.value.displayName)) {
      return 'isLiked'
    }
  }
}

const like = (likedArr, id) => {
  if (user.value) {
    let arr = likedArr
    if (!arr.includes(user.value.displayName)) {
      arr.push(user.value.displayName)
    } else {
      let index = arr.indexOf(user.value.displayName)
      arr.splice(index, 1)
    }
    db.collection('comments')
      .doc(id)
      .update({
        likes: arr,
        likes_count: arr?.length,
      })
      .catch((err) => {
        console.log(err)
      })
    document.getElementById('l' + id).classList.toggle('isLiked')
  }
}
</script> -->

<!-- <style>
.isLiked {
  fill: crimson;
}
</style> -->
