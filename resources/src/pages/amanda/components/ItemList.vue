<script setup lang="ts">
  import { defineProps, defineEmits, ref } from 'vue';

  type ComponentProps = {
    items: string[];
    title: string;
  };

  const props = defineProps<ComponentProps>();
  const emit = defineEmits(['addItem', 'deleteItem']);

  const item = ref('');

  function addItem(itemToInsert: string) {
    emit('addItem', itemToInsert);
    item.value = '';
  }

  function deleteItem(itemToDelete: string) {
    emit('deleteItem', itemToDelete);
    item.value = '';
  }
</script>

<template>
  <div>
    <h5>
      {{ props.title }} <span class="badge bg-info">{{ items.length }}</span>
    </h5>
    <div class="card">
      <div class="card-body">
        <ul class="list-group">
          <li
            v-for="itemList in props.items"
            :key="itemList"
            class="list-group-item"
          >
            <div class="row">
              <div class="col-md">
                {{ itemList }}
              </div>
              <div class="col-md text-right">
                <button class="btn btn-info" @click="deleteItem(itemList)">
                  <span class="fa fa-trash" />
                </button>
              </div>
            </div>
          </li>
        </ul>
        <br />
        <div class="input-group">
          <input
            v-model="item"
            class="form-control"
            type="text"
            placeholder="Informe o item"
            @keyup.enter="addItem(item)"
          />
          <div class="input-group-append">
            <button class="btn btn-info" @click="addItem(item)">
              <span class="fa fa-plus" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
