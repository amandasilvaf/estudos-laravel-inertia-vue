<script setup lang="ts">
  import { defineProps, computed, defineEmits } from 'vue';

  type PaginatorProps = {
    data: [];
    links: [];
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
    Math.min(startPage.value + props.maxVisibleButtons - 1, props.totalPages),
  );
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
    // eslint-disable-next-line no-console
    console.log(`pagina ativa = ${page}`);
    return props.currentPage === page;
  }
</script>
<template>
  <div class="p-paginator p-component p-paginator-bottom">
    <span v-if="props.total > 1" class="p-paginator-current">
      <b>
        Listando de {{ props.data.from }} a {{ props.data.to }} de
        {{ props.total }} registros.
      </b>
    </span>

    <span v-else-if="props.total == 1" class="p-paginator-current">
      <b>
        Listando de {{ props.data.from }} a {{ props.data.to }} de
        {{ props.total }} registro</b
      >
    </span>

    <span v-else class="p-paginator-current">
      <b>Nenhum registro localizado</b>
    </span>

    <div v-if="!isInFirstPage">
      <button
        type="button"
        :disabled="isInFirstPage"
        aria-label="Go to first page"
        class="p-paginator-first p-paginator-element p-link"
        @click="onClickFirstPage"
      >
        <span class="p-paginator-icon pi pi-angle-double-left text-pink-400" />
        <span class="p-ink" />
      </button>
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

    <div v-for="page in pages" :key="page.name" class="pagination-item">
      <div v-if="page.name >= 1">
        <Link class="no-underline">
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

    <div v-if="!isInLastPage">
      <button
        type="button"
        :disabled="isInLastPage"
        aria-label="Go to first page"
        class="p-paginator-first p-paginator-element p-link"
        @click="onClickNextPage"
      >
        <span class="p-paginator-icon pi pi-angle-right text-pink-400" />
        <span class="p-ink" />
      </button>
      <button
        type="button"
        class="p-paginator-prev p-paginator-element p-link"
        :disabled="isInLastPage"
        aria-label="Go to previous page"
        @click="onClickLastPage"
      >
        <span class="p-paginator-icon pi pi-angle-double-right text-pink-200" />
        <span class="p-ink" />
      </button>
    </div>
    <div v-else>
      <button
        class="p-paginator-first p-paginator-element p-link"
        type="button"
      >
        <span class="p-paginator-icon pi pi-angle-right" />
        <span class="p-ink" />
      </button>
      <button class="p-paginator-prev p-paginator-element p-link" type="button">
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
