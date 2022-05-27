<script setup lang="ts">
  import { defineProps, computed, defineEmits } from 'vue';

  type PaginatorProps = {
    maxVisibleButtons: number;
    totalPages: number;
    total: number;
    perPage: number;
    currentPage: number;
  };

  const props = defineProps<PaginatorProps>();
  // const props = withDefaults(defineProps<PaginatorProps>(), {
  //   maxVisibleButtons: 3,
  // });
  const emit = defineEmits(['pagechanged']);

  const startPage = computed(() => {
    if (props.currentPage === 1) {
      return 1;
    }
    if (props.currentPage === props.totalPages) {
      return props.totalPages - props.maxVisibleButtons + 1;
    }
    return props.currentPage - 1;
  });

  // eslint-disable-next-line vue/return-in-computed-property
  const endPage = computed(() =>
    Math.min(startPage.value + props.maxVisibleButtons - 1, props.totalPages));
  const pages = computed(() => {
    const range = [];

    for (let i = startPage.value; i <= endPage.value; i += 1) {
      range.push({
        name: i,
        isDisabled: i === props.currentPage,
      });
    }

    return range;
  });

  const isInFirstPage = computed(() => props.currentPage === 1);
  const isInLastPage = computed(() => props.currentPage === props.totalPages);

  function onClickFirstPage() {
    emit('pagechanged', 1);
  }

  function onClickPreviousPage() {
    emit('pagechanged', props.currentPage - 1);
  }

  function onClickPage(page) {
    emit('pagechanged', page);
  }

  function onClickNextPage() {
    emit('pagechanged', props.currentPage + 1);
  }

  function onClickLastPage() {
    emit('pagechanged', props.totalPages);
  }

  function isPageActive(page) {
    return props.currentPage === page;
  }
</script>
<template>
  <div>
    <ul class="pagination">
      <li class="pagination-item">
        <button
          type="button"
          :disabled="isInFirstPage"
          aria-label="Go to first page"
          class="p-paginator-first p-paginator-element p-link"
          @click="onClickFirstPage"
        >
          <span
            class="p-paginator-icon pi pi-angle-double-left text-pink-400"
          />
          <span class="p-ink" />
        </button>
      </li>

      <li class="pagination-item">
        <button
          type="button"
          class="p-paginator-prev p-paginator-element p-link"
          :disabled="isInFirstPage"
          aria-label="Go to previous page"
          @click="onClickPreviousPage"
        >
          <span class="p-paginator-icon pi pi-angle-left text-pink-200" />
          <span class="p-ink" />
        </button>
      </li>

      <li v-for="page in pages" :key="page.name" class="pagination-item">
        <button
          type="button"
          class="p-paginator-page p-paginator-element p-link no-underline"
          :disabled="page.isDisabled"
          :class="{ active: isPageActive(page.name) }"
          :aria-label="`Go to page number ${page.name}`"
          @click="onClickPage(page.name)"
        >
          {{ page.name }}
        </button>
      </li>

      <li class="pagination-item">
        <button
          type="button"
          class="p-paginator-next p-paginator-element p-link"
          :disabled="isInLastPage"
          aria-label="Go to next page"
          @click="onClickNextPage"
        >
          <span class="p-paginator-icon pi pi-angle-right text-pink-200" />
          <span class="p-ink" />
        </button>
      </li>

      <li class="pagination-item">
        <button
          type="button"
          class="p-paginator-last p-paginator-element p-link"
          :disabled="isInLastPage"
          aria-label="Go to last page"
          @click="onClickLastPage"
        >
          <span
            class="p-paginator-icon pi pi-angle-double-right text-pink-400"
          />
          <span class="p-ink" />
        </button>
      </li>
    </ul>
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

<div v-for="page in pages" :key="page.name" class="pagination-item">
      <div v-if="page.name >= 1">
        <Link class="no-underline" :href="props.links[page.name].url">
          <span class="p-paginator-pages">
            <button
              type="button"
              class="p-paginator-page p-paginator-element p-link no-underline"
              :disabled="page.isDisabled"
              :class="{ 'p-highlight': isPageActive(page.name) }"
              :aria-label="`Go to page number ${page.name}`"
              @click="onClickPage(page.name)"
            >
              {{ page.name }}
            </button>
          </span>
        </Link>
      </div>
    </div>
