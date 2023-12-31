<script setup lang="ts">
import Posts from "@/Components/Posts.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import SideNav from "@/Components/SideNav.vue";
import SideTags from "@/Components/SideTags.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Posts as Ptype } from "@/types";
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage<{ posts: Ptype }>();
</script>

<template>
  <AppLayout title="Home">
    <div class="grid md:grid-cols-[1fr,3fr,1.5fr] gap-4 items-start">
      <SideNav class="hidden md:block" :isHomePage="true" />

      <div>
        <div class="flex items-center justify-between pb-3 px-3 md:px-0">
          <transition appear name="fadeIn">
            <h2 class="text-3xl font-bold">Feed</h2>
          </transition>
          <div class="flex gap-1">
            <transition-group appear name="fadeIn">
              <Link href="/?sort=newest">
                <SecondaryButton
                  key="1"
                  class="btn-filter active transition"
                  id="filterByDate"
                >
                  Newest
                </SecondaryButton>
              </Link>
              <Link href="/?sort=liked">
                <SecondaryButton
                  key="2"
                  class="btn-filter whitespace-nowrap transition"
                  id="filterByLikes"
                >
                  Most Liked
                </SecondaryButton>
              </Link>
            </transition-group>
          </div>
        </div>

        <Posts v-if="page.props.posts.length > 0" />
        <div
          v-else
          class="flex flex-col items-center py-36 bg-white w-full rounded-md shadow"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            xmlns:svgjs="http://svgjs.com/svgjs"
            version="1.1"
            width="150"
            height="150"
            x="0"
            y="0"
            viewBox="0 0 512 512"
            style="enable-background: new 0 0 512 512"
            xml:space="preserve"
            class=""
          >
            <g>
              <linearGradient
                xmlns="http://www.w3.org/2000/svg"
                id="SVGID_1_"
                gradientUnits="userSpaceOnUse"
                x1="256"
                x2="256"
                y1="406"
                y2="31"
              >
                <stop stop-opacity="1" stop-color="#1f1b5d" offset="0" />
                <stop stop-opacity="1" stop-color="#4f46e5" offset="1" />
              </linearGradient>
              <linearGradient
                xmlns="http://www.w3.org/2000/svg"
                id="SVGID_2_"
                gradientUnits="userSpaceOnUse"
                x1="256"
                x2="256"
                y1="481"
                y2="316"
              >
                <stop offset="0" stop-color="#c3ffe8" />
                <stop offset=".9973" stop-color="#f0fff4" />
              </linearGradient>
              <g xmlns="http://www.w3.org/2000/svg">
                <g>
                  <g>
                    <path
                      d="m511.7 312.7-60-270c-1.5-6.901-7.8-11.7-14.7-11.7h-362c-6.899 0-13.2 4.799-14.7 11.7l-60 270c-.3 1.2-.3 2.099-.3 3.3l166 90h180l166-90c0-1.201 0-2.1-.3-3.3z"
                      fill="url(#SVGID_1_)"
                      data-original="url(#SVGID_1_)"
                      style=""
                    />
                  </g>
                </g>
                <g>
                  <g>
                    <path
                      d="m394.6 316c-11.521 0-22.049 6.526-27.173 16.846l-17.292 34.825c-2.533 5.102-7.739 8.329-13.435 8.329h-161.401c-5.697 0-10.902-3.227-13.435-8.329l-17.292-34.825c-5.123-10.32-15.65-16.846-27.172-16.846h-117.4v150c0 8.284 6.716 15 15 15h482c8.284 0 15-6.716 15-15v-150z"
                      fill="#f0ffff"
                    />
                  </g>
                </g>
              </g>
            </g>
          </svg>
          <span class="mt-3">No posts available.</span>
        </div>
      </div>

      <SideTags class="row-start-1 md:row-start-auto" />
    </div>
  </AppLayout>
</template>
