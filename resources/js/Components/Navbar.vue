<script setup lang="ts">
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { User } from "@/types";
import { Link, router, usePage } from "@inertiajs/vue3";
import { Menu, Search, X } from "lucide-vue-next";
import { ref } from "vue";
import route from "ziggy-js";

defineProps({
  title: String,
});

const {
  props: {
    auth: { user },
  },
} = usePage<{ auth: { user: User } }>();
console.log(user);

const showingNavigationDropdown = ref(false);

const logout = () => {
  router.post(route("logout"));
};
</script>

<template>
  <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex">
          <!-- Logo -->
          <div class="shrink-0 flex items-center">
            <Link :href="route('home')">
              <ApplicationMark class="block h-9 w-auto" />
            </Link>
          </div>

          <div class="hidden space-x-4 sm:-my-px sm:ms-4 sm:flex items-center">
            <div class="relative">
              <TextInput class="w-80" placeholder="Search..." />
              <SecondaryButton
                class="absolute shadow-none right-px border-0 !px-2 !py-[7px] top-px"
              >
                <Search />
              </SecondaryButton>
            </div>
          </div>
        </div>

        <div class="hidden sm:flex sm:items-center sm:ms-6">
          <!-- Settings Dropdown -->
          <div class="ms-3 relative">
            <Dropdown align="right" width="48" v-if="user">
              <template #trigger>
                <span class="inline-flex rounded-md">
                  <button
                    type="button"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                  >
                    {{ user.name }}

                    <svg
                      class="ms-2 -me-0.5 h-4 w-4"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                      />
                    </svg>
                  </button>
                </span>
              </template>

              <template #content>
                <!-- Account Management -->
                <DropdownLink :href="route('profile.show')">
                  Profile
                </DropdownLink>

                <div class="border-t border-gray-200" />

                <!-- Authentication -->
                <form @submit.prevent="logout">
                  <DropdownLink as="button"> Log Out </DropdownLink>
                </form>
              </template>
            </Dropdown>

            <Link href="/login" v-else>
              <SecondaryButton> Login </SecondaryButton>
            </Link>
          </div>
        </div>

        <!-- Hamburger -->
        <div class="-me-2 flex items-center sm:hidden">
          <button
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
          >
            <Search />
          </button>
          <button
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
            @click="showingNavigationDropdown = !showingNavigationDropdown"
          >
            <X v-if="showingNavigationDropdown" />
            <Menu v-else />
          </button>
        </div>
      </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div
      :class="{
        block: showingNavigationDropdown,
        hidden: !showingNavigationDropdown,
      }"
      class="sm:hidden"
    >
      <div class="pt-2 pb-3 space-y-1">
        <ResponsiveNavLink
          :href="route('home')"
          :active="route().current('home')"
        >
          Home
        </ResponsiveNavLink>
      </div>

      <!-- Responsive Settings Options -->
      <div class="pt-4 pb-1 border-t border-gray-200" v-if="user">
        <div class="flex items-center px-4">
          <div>
            <div class="font-medium text-base text-gray-800">
              {{ user.name }}
            </div>
            <div class="font-medium text-sm text-gray-500">
              {{ user.email }}
            </div>
          </div>
        </div>

        <div class="mt-3 space-y-1">
          <ResponsiveNavLink
            :href="route('profile.show')"
            :active="route().current('profile.show')"
          >
            Profile
          </ResponsiveNavLink>

          <!-- Authentication -->
          <form method="POST" @submit.prevent="logout">
            <ResponsiveNavLink as="button"> Log Out </ResponsiveNavLink>
          </form>
        </div>
      </div>
    </div>
  </nav>
</template>
