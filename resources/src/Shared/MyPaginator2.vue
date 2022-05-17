<script setup lang="ts">
  import { defineProps } from 'vue';

  type PaginatorProps = {
    data: Array;
  };

  const props = defineProps<PaginatorProps>();
</script>
<template>
  <div class="p-paginator p-component p-paginator-bottom">
    <span v-if="props.data.total > 1" class="p-paginator-current">
      <b>
        Listando de {{ props.data.from }} a {{ props.data.to }} de
        {{ props.data.total }} registros.
      </b>
    </span>

    <span v-else-if="props.data.total == 1" class="p-paginator-current">
      <b>
        Listando de {{ props.data.from }} a {{ props.data.to }} de
        {{ props.data.total }} registro</b
      >
    </span>

    <span v-else class="p-paginator-current">
      <b>Nenhum registro localizado</b>
    </span>

    <div v-if="props.data.prev_page_url">
      <Link :href="props.data.first_page_url" class="no-underline">
        <button
          class="p-paginator-first p-paginator-element p-link"
          type="button"
        >
          <span
            class="p-paginator-icon pi pi-angle-double-left text-pink-400"
          />
          <span class="p-ink" />
        </button>
      </Link>
      <Link :href="props.data.prev_page_url" class="no-underline">
        <button
          class="p-paginator-prev p-paginator-element p-link"
          type="button"
        >
          <span class="p-paginator-icon pi pi-angle-left text-pink-200" />
          <span class="p-ink" />
        </button>
      </Link>
    </div>
    <div v-else>
      <button
        class="p-paginator-first p-paginator-element p-link"
        type="button"
      >
        <span class="p-paginator-icon pi pi-angle-double-left" />
        <span class="p-ink" />
      </button>
      <button class="p-paginator-prev p-paginator-element p-link" type="button">
        <span class="p-paginator-icon pi pi-angle-left" />
        <span class="p-ink" />
      </button>
    </div>

    <div v-for="link in props.data.links" :key="link">
      <span class="p-paginator-pages">
        <Link
          v-if="link.url && !isNaN(link.label)"
          :key="link"
          :href="link.url"
          class="p-paginator-page p-paginator-element p-link no-underline"
          :class="{ 'p-highlight': link.active }"
        >
          {{ link.label }}
        </Link>
      </span>
    </div>

    <div v-if="props.data.next_page_url">
      <Link :href="props.data.next_page_url" class="no-underline">
        <button
          class="p-paginator-next p-paginator-element p-link"
          type="button"
        >
          <span class="p-paginator-icon pi pi-angle-right text-pink-200" />
          <span class="p-ink" />
        </button>
      </Link>
      <Link :href="props.data.last_page_url" class="no-underline">
        <button
          class="p-paginator-last p-paginator-element p-link"
          type="button"
        >
          <span
            class="p-paginator-icon pi pi-angle-double-right text-pink-400"
          />
          <span class="p-ink" />
        </button>
      </Link>
    </div>
    <div v-else>
      <button class="p-paginator-next p-paginator-element p-link" type="button">
        <span class="p-paginator-icon pi pi-angle-right" />
        <span class="p-ink" />
      </button>
      <button class="p-paginator-last p-paginator-element p-link" type="button">
        <span class="p-paginator-icon pi pi-angle-double-right" />
        <span class="p-ink" />
      </button>
    </div>
  </div>
</template>

<style>
  .p-paginator .p-paginator-pages .p-paginator-page.p-highlight {
    background: #eba7c7;
    border-color: transparent;
    color: #fff;
  }

  .p-paginator .p-paginator-pages .p-paginator-page:not(.p-highlight):hover {
    background: #eba7c7;
    border-color: transparent;
    color: #fff;
  }
</style>
