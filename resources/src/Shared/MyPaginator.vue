<script setup lang="ts">
  import { defineProps } from 'vue';

  type PaginatorProps = {
    links: Array<object>;
  };

  const props = defineProps<PaginatorProps>();
</script>

<template>
  <div class="mt-5">
    <template v-for="link in props.links" :key="link">
      <Link
        v-if="link.url && !isNaN(link.label)"
        :key="link"
        :href="link.url"
        class="px-2 py-2"
        >{{ link.label }}</Link
      >
      <span v-else>--</span>
    </template>
  </div>
</template>
