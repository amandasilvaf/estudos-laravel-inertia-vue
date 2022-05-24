<script setup lang="ts">
  // eslint-disable-next-line object-curly-newline
  import {
    defineProps,
    computed,
    ref,
    onUpdated,
    onMounted,
    // eslint-disable-next-line object-curly-newline
  } from 'vue';
  import { route } from '@scripts/libs/ziggy';
  import { Inertia } from '@inertiajs/inertia';
  import { useToast } from 'primevue/usetoast';
  import { useConfirm } from 'primevue/useconfirm';
  import DataTable from 'primevue/datatable';
  import Column from 'primevue/column';
  import { usePage } from '@inertiajs/inertia-vue3';
  // import MyPaginator from '@/src/Shared/MyPaginator.vue';

  import Image from 'primevue/image';
  import MyPaginator2 from '@/src/Shared/MyPaginator2.vue';

  const toast = useToast();
  const confirm = useConfirm();

  type User = {
    id: number;
    name: string;
    email: string;
    avatar: string;
  };

  type UserTableProps = {
    users: User[];
    error: string;
    success: string;
  };

  const props = defineProps<UserTableProps>();
  const pageName = 'Listar Usuários';

  const searchTerm = ref('');

  // const success = computed(() => usePage().props.value.success);
  const refProps = ref(props);
  const error = computed(() => usePage().props.value.error);

  // function editar(id: number) {
  //   Inertia.get(
  //     route('users.edit', {
  //       id,
  //     }),
  //   );
  //   // Inertia.get(`/users/edit/${id}`);
  // }

  function excluir(id: number) {
    confirm.require({
      message: 'Você realmente deseja excluir este registro?',
      header: 'Confirmação de exclusão',
      icon: 'pi pi-info-circle',
      acceptClass: 'p-button-danger',
      acceptLabel: 'Sim, desejo exluir',
      rejectLabel: 'Cancelar',
      accept: () => {
        Inertia.delete(
          route('users.delete', {
            id,
          }),
        );
        // Inertia.delete(`/users/delete/${id}`);
        toast.add({
          severity: 'info',
          summary: 'Confirmado',
          detail: 'O registro será excluído.',
          life: 3000,
        });
      },
    });
  }

  // function novoUsuario() {
  //   Inertia.get(route('users.create'));
  // }

  // function onSubmit() {
  //   Inertia.get(
  //     route('users.index', {
  //       search: searchTerm.value,
  //     }),
  //   );
  // }
  onUpdated(() => {
    if (refProps.value.success) {
      const msg = refProps.value.success;
      toast.add({
        severity: 'success',
        summary: msg,
        life: 5000,
      });
    }

    if (error.value) {
      const msg = error.value;
      toast.add({
        severity: 'error',
        summary: String(msg),
        life: 5000,
      });
    }
  });

  onMounted(() => {
    if (refProps.value.success) {
      const msg = refProps.value.success;
      toast.add({
        severity: 'success',
        summary: msg,
        life: 5000,
      });
    }
    if (error.value) {
      const msg = error.value;
      toast.add({
        severity: 'error',
        summary: String(msg),
        life: 5000,
      });
    }
  });
</script>

<template layout="Layout">
  <div>
    <Toast />
    <ConfirmDialog />
  </div>

  <div class="flex justify-content-between">
    <h2>{{ pageName }}</h2>
    <div>
      <!-- <Button label="Novo" @click="novoUsuario" /> -->

      <Link
        :href="route('users.create')"
        as="button"
        class="p-button p-button-outlined"
        >Novo Usuário</Link
      >
    </div>
  </div>
  <div class="col-12 md:col-6 mb-5">
    <!-- <form @submit.prevent="onSubmit"> -->
    <div class="p-inputgroup">
      <InputText
        id="search"
        v-model="searchTerm"
        placeholder="Pesquisar por nome ou e-mail"
        name="search"
      />
      <!--
      <Button
        icon="pi pi-search"
        class="p-button-primary"
        type="submit"
        preserve-scroll
      /> -->
      <Link
        preserve-scroll
        :href="route('users.index')"
        :data="{ search: searchTerm }"
        as="button"
        class="p-button p-button-primary p-button-sm mx-2"
        >buscar</Link
      >
    </div>
    <!-- </form> -->
  </div>

  <div>
    <DataTable :value="users.data" data-key="id">
      <Column field="avatar" header="Avatar">
        <template #body="{ data }">
          <Image :src="data.image_url" alt="Image" width="80" />
        </template>
      </Column>
      <Column field="name" header="Name">
        <template #body="{ data }">
          {{ data.name }}
        </template>
      </Column>
      <Column field="email" header="E-mail">
        <template #body="{ data }">
          {{ data.email }}
        </template>
      </Column>
      <Column header="Ações">
        <template #body="{ data }">
          <!-- <Button
            class="p-button-sm p-button-outlined p-button-info"
            label="Editar"
            @click="editar(data.id)"
          /> -->
          <Link
            :href="route('users.edit', data.id)"
            as="button"
            class="p-button p-button-outlined p-button-sm"
            >Editar</Link
          >
          <Button
            class="p-button-sm p-button-outlined p-button-danger"
            label="Excluir"
            @click="excluir(data.id)"
          />
        </template>
      </Column>
    </DataTable>
    <div class="mt-5">
      <!-- <MyPaginator
        :links="users.links"
        class="flex justify-content-start align-items-center"
      /> -->
      <MyPaginator2 :data="users" />
    </div>
  </div>
</template>
