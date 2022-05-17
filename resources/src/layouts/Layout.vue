<script setup lang="ts">
  // This is a peristent layout
  // Include me with <template layout="app-container" />
  import AppContainer from '@sections/app-container/AppContainer.vue';
</script>

<template>
  <AppContainer>
    <slot />
  </AppContainer>
</template>

<style></style>
