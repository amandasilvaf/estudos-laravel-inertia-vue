<script setup lang="ts">
  import { usePage } from '@inertiajs/inertia-vue3';
  import { computed, defineProps } from 'vue';
  import SideBar from './components/SideBar.vue';
  import TopBar from './components/TopBar.vue';

  const props = defineProps({
    container: {
      type: Boolean,
      default: true,
    },
  });

  const username = computed(() => usePage().props.value.auth.user.username);
</script>

<template>
  <div class="min-h-screen flex relative lg:static surface-ground">
    <SideBar />

    <div class="min-h-screen flex flex-column relative flex-auto">
      <TopBar />

      <div class="flex flex-row-reverse bg-purple-500">
        <div class="font-bold text-white border-round m-2">
          Welcome back, {{ username }}
        </div>
      </div>

      <section>
        <div>
          <iframe
            height="200px"
            width="100%"
            frameborder="no"
            scrolling="no"
            seamless
            src="https://player.simplecast.com/fd0bd2ba-c553-466c-a060-b144797ce369?dark=false"
          />
        </div>
      </section>

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
