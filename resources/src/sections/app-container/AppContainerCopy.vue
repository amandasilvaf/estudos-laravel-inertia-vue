<script setup lang="ts">
  import { defineProps } from 'vue';
  import { route } from '@scripts/libs/ziggy';

  const props = defineProps({
    container: {
      type: Boolean,
      default: true,
    },
  });
</script>

<template>
  <div class="min-h-screen flex relative lg:static surface-ground">
    <div
      id="app-sidebar-2"
      class="bg-bluegray-800 h-screen hidden lg:block flex-shrink-0 absolute lg:static left-0 top-0 z-1 select-none"
      style="width: 280px"
    >
      <div class="flex flex-column h-full">
        <div
          class="flex align-items-center px-5 bg-bluegray-900 flex-shrink-0"
          style="height: 60px"
        >
          <img
            src="@sections/app-container/assets/images/logo.svg"
            alt="Image"
            height="30"
          />
        </div>
        <div class="overflow-y-auto mt-3">
          <ul class="list-none p-3 m-0">
            <li>
              <Link :href="route('home.dashboard')" class="no-underline">
                <a
                  v-ripple
                  class="flex align-items-center cursor-pointer p-3 hover:bg-bluegray-900 border-round text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
                >
                  <i class="pi pi-home mr-2" />
                  <span class="font-medium">Dashboard</span>
                </a>
              </Link>
            </li>
            <li>
              <a
                v-ripple
                class="flex align-items-center cursor-pointer p-3 hover:bg-bluegray-900 border-round text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
              >
                <i class="pi pi-bookmark mr-2" />
                <span class="font-medium">Bookmarks</span>
              </a>
            </li>
            <li>
              <a
                v-ripple
                v-styleclass="{
                  selector: '@next',
                  enterClass: 'hidden',
                  enterActiveClass: 'slidedown',
                  leaveToClass: 'hidden',
                  leaveActiveClass: 'slideup',
                }"
                class="flex align-items-center cursor-pointer p-3 hover:bg-bluegray-900 border-round text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
              >
                <i class="pi pi-chart-line mr-2" />
                <span class="font-medium">Reports</span>
                <i class="pi pi-chevron-down ml-auto" />
              </a>
              <ul
                class="list-none py-0 pl-3 pr-0 m-0 hidden overflow-y-hidden transition-all transition-duration-400 transition-ease-in-out"
              >
                <li>
                  <a
                    v-ripple
                    v-styleclass="{
                      selector: '@next',
                      enterClass: 'hidden',
                      enterActiveClass: 'slidedown',
                      leaveToClass: 'hidden',
                      leaveActiveClass: 'slideup',
                    }"
                    class="flex align-items-center cursor-pointer p-3 hover:bg-bluegray-900 border-round text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
                  >
                    <i class="pi pi-chart-line mr-2" />
                    <span class="font-medium">Revenue</span>
                    <i class="pi pi-chevron-down ml-auto" />
                  </a>
                  <ul
                    class="list-none py-0 pl-3 pr-0 m-0 hidden overflow-y-hidden transition-all transition-duration-400 transition-ease-in-out"
                  >
                    <li>
                      <a
                        v-ripple
                        class="flex align-items-center cursor-pointer p-3 hover:bg-bluegray-900 border-round text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
                      >
                        <i class="pi pi-table mr-2" />
                        <span class="font-medium">View</span>
                      </a>
                    </li>
                    <li>
                      <a
                        v-ripple
                        class="flex align-items-center cursor-pointer p-3 hover:bg-bluegray-900 border-round text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
                      >
                        <i class="pi pi-search mr-2" />
                        <span class="font-medium">Search</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a
                    v-ripple
                    class="flex align-items-center cursor-pointer p-3 hover:bg-bluegray-900 border-round text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
                  >
                    <i class="pi pi-chart-line mr-2" />
                    <span class="font-medium">Expenses</span>
                  </a>
                </li>
              </ul>
            </li>
            <li>
              <a
                v-ripple
                class="flex align-items-center cursor-pointer p-3 hover:bg-bluegray-900 border-round text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
              >
                <i class="pi pi-users mr-2" />
                <span class="font-medium">Team</span>
              </a>
            </li>
            <li>
              <a
                v-ripple
                class="flex align-items-center cursor-pointer p-3 hover:bg-bluegray-900 border-round text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
              >
                <i class="pi pi-comments mr-2" />
                <span class="font-medium">Messages</span>
                <span
                  class="inline-flex align-items-center justify-content-center ml-auto bg-yellow-500 text-bluegray-900 border-circle"
                  style="min-width: 1.5rem; height: 1.5rem"
                  >3</span
                >
              </a>
            </li>
            <li>
              <a
                v-ripple
                class="flex align-items-center cursor-pointer p-3 hover:bg-bluegray-900 border-round text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
              >
                <i class="pi pi-calendar mr-2" />
                <span class="font-medium">Calendar</span>
              </a>
            </li>
            <li>
              <a
                v-ripple
                class="flex align-items-center cursor-pointer p-3 hover:bg-bluegray-900 border-round text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
              >
                <i class="pi pi-cog mr-2" />
                <span class="font-medium">Settings</span>
              </a>
            </li>
          </ul>
        </div>
        <div class="mt-auto">
          <hr class="mb-3 mx-3 border-top-1 border-none border-bluegray-600" />
          <ul
            class="list-none p-2 m-0 hidden origin-bottom animation-duration-150 overflow-hidden animation-ease-in-out"
          >
            <li>
              <Link :href="route('user.profile')" class="no-underline">
                <a
                  v-ripple
                  class="no-underline flex align-items-center cursor-pointer p-3 hover:bg-bluegray-900 border-round text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
                >
                  <i class="pi pi-user mr-2" />
                  <span class="font-medium">Profile</span>
                </a>
              </Link>
            </li>
            <li>
              <a
                v-ripple
                class="flex align-items-center cursor-pointer p-3 hover:bg-bluegray-900 border-round text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
              >
                <i class="pi pi-cog mr-2" />
                <span class="font-medium">Settings</span>
              </a>
            </li>
            <li>
              <Link href="/" class="no-underline">
                <a
                  v-ripple
                  class="no-underline flex align-items-center cursor-pointer p-3 hover:bg-bluegray-900 border-round text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
                >
                  <i class="pi pi-sign-out mr-2" />
                  <span class="font-medium">Sign Out</span>
                </a>
              </Link>
            </li>
          </ul>
          <a
            v-ripple
            v-styleclass="{
              selector: '@prev',
              enterClass: 'hidden',
              enterActiveClass: 'slidedown',
              leaveToClass: 'hidden',
              leaveActiveClass: 'slideup',
            }"
            class="m-3 px-3 py-2 flex align-items-center hover:bg-bluegray-900 border-round cursor-pointer text-bluegray-100 hover:text-bluegray-50 transition-duration-150 transition-colors p-ripple"
          >
            <img
              src="@/src/assets/images/avatar-f-1.png"
              class="mr-2"
              style="width: 28px; height: 28px"
            />
            <span class="font-medium">Amy Elsner</span>
            <i class="pi pi-chevron-up ml-auto" />
          </a>
        </div>
      </div>
    </div>
    <div class="min-h-screen flex flex-column relative flex-auto">
      <div
        class="flex justify-content-between align-items-center px-5 surface-section shadow-2 relative lg:static border-bottom-1 surface-border"
        style="height: 60px"
      >
        <div class="flex">
          <a
            v-ripple
            v-styleclass="{
              selector: '#app-sidebar-2',
              enterClass: 'hidden',
              enterActiveClass: 'fadeinleft',
              leaveToClass: 'hidden',
              leaveActiveClass: 'fadeoutleft',
              hideOnOutsideClick: true,
            }"
            class="cursor-pointer block lg:hidden text-700 mr-3 mt-1 p-ripple"
          >
            <i class="pi pi-bars text-4xl" />
          </a>
          <span class="p-input-icon-left">
            <i class="pi pi-search" />
            <InputText
              type="text"
              class="border-none w-10rem sm:w-20rem"
              placeholder="Search"
            />
          </span>
        </div>
        <a
          v-ripple
          v-styleclass="{
            selector: '@next',
            enterClass: 'hidden',
            enterActiveClass: 'fadein',
            leaveToClass: 'hidden',
            leaveActiveClass: 'fadeout',
            hideOnOutsideClick: true,
          }"
          class="cursor-pointer block lg:hidden text-700 p-ripple"
        >
          <i class="pi pi-ellipsis-v text-2xl" />
        </a>
        <ul
          class="list-none p-0 m-0 hidden lg:flex lg:align-items-center select-none lg:flex-row surface-section border-1 lg:border-none surface-border right-0 top-100 z-1 shadow-2 lg:shadow-none absolute lg:static"
        >
          <li>
            <a
              v-ripple
              class="flex p-3 lg:px-3 lg:py-2 align-items-center text-600 hover:text-900 hover:surface-100 font-medium border-round cursor-pointer transition-duration-150 transition-colors p-ripple"
            >
              <i class="pi pi-inbox text-base lg:text-2xl mr-2 lg:mr-0" />
              <span class="block lg:hidden font-medium">Inbox</span>
            </a>
          </li>
          <li>
            <a
              v-ripple
              class="flex p-3 lg:px-3 lg:py-2 align-items-center text-600 hover:text-900 hover:surface-100 font-medium border-round cursor-pointer transition-duration-150 transition-colors p-ripple"
            >
              <i
                v-badge.danger
                class="pi pi-bell text-base lg:text-2xl mr-2 lg:mr-0"
              />
              <span class="block lg:hidden font-medium">Notifications</span>
            </a>
          </li>
          <li class="border-top-1 surface-border lg:border-top-none">
            <a
              v-ripple
              class="flex p-3 lg:px-3 lg:py-2 align-items-center hover:surface-100 font-medium border-round cursor-pointer transition-duration-150 transition-colors p-ripple"
            >
              <img
                src="@/src/assets/images/avatar-f-1.png"
                class="mr-3 lg:mr-0"
                style="width: 32px; height: 32px"
              />
              <div class="block lg:hidden">
                <div class="text-900 font-medium">Josephine Lillard</div>
                <span class="text-600 font-medium text-sm"
                  >Marketing Specialist</span
                >
              </div>
            </a>
          </li>
        </ul>
      </div>
      <div class="p-5 flex flex-column flex-auto">
        <div
          v-if="props.container"
          class="border-round surface-section flex-auto p-4"
        >
          <slot />
        </div>
        <slot v-if="!props.container" />
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss"></style>
