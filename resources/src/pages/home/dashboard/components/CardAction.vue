<script setup lang="ts">
  import { defineProps, withDefaults } from 'vue';

  type CardProps = {
    title?: string;
    text?: string;
    imageAlt: string;
    imageSrc: string;
  };

  const props = withDefaults(defineProps<CardProps>(), {
    title: 'Título default',
    text: 'Texto default ',
  });
</script>

<template>
  <div class="col-12 lg:col-4">
    <div class="surface-card border-round shadow-2 p-4 text-center">
      <img :src="imageSrc" :alt="imageAlt" class="mx-auto block mb-4" />
      <div class="text-900 font-medium mb-3 text-xl">{{ props.title }}</div>
      <p class="mt-0 mb-4 p-0 line-height-3">{{ props.text }}</p>
      <Button label="Learn More" icon="pi pi-arrow-right p-button-rounded" />
    </div>
  </div>
</template>
>
