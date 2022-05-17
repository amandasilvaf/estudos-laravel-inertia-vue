<script setup lang="ts">
  import { defineProps } from 'vue';

  type CardProps = {
    title: string;
    text: string;
    descriptionGreen: string;
    descriptionGrey: string;
    iconClass: string;
    bgIcon: string;
  };

  const props = defineProps<CardProps>();
</script>

<template>
  <div class="col-12 lg:col-6 xl:col-3">
    <div class="surface-card shadow-2 p-3 border-1 border-50 border-round">
      <div class="flex justify-content-between mb-3">
        <div>
          <span class="block text-500 font-medium mb-3">{{ props.title }}</span>
          <div class="text-900 font-medium text-xl">{{ props.text }}</div>
        </div>
        <div
          :class="[
            'flex align-items-center justify-content-center border-round',
            bgIcon,
          ]"
          style="width: 2.5rem; height: 2.5rem"
        >
          <i :class="iconClass" />
        </div>
      </div>
      <span class="text-green-500 font-medium"
        >{{ props.descriptionGreen }}
      </span>
      <span class="text-500"> {{ props.descriptionGrey }} </span>
    </div>
  </div>
</template>
<style></style>
