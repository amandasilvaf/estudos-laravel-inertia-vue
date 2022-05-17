<script setup lang="ts">
  import { defineProps, onUpdated, onMounted, computed, ref } from 'vue';
  import { route } from '@scripts/libs/ziggy';
  import { Inertia } from '@inertiajs/inertia';
  import { useToast } from 'primevue/usetoast';
  import { useConfirm } from 'primevue/useconfirm';
  import DataTable from 'primevue/datatable';
  import Column from 'primevue/column';
  import { usePage } from '@inertiajs/inertia-vue3';

  const toast = useToast();
  const confirm = useConfirm();

  type User = {
    id: number;
    name: string;
    email: string;
  };

  type UserTableProps = {
    users: User[];
    error: string;
    success: string;
  };

  const props = defineProps<UserTableProps>();
  function editar(id: number) {
    Inertia.get(`/users/edit/${id}`);
  }

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
        toast.add({
          severity: 'info',
          summary: 'Confirmado',
          detail: 'O registro será excluído.',
          life: 3000,
        });
      },
      reject: () => {
        toast.add({
          severity: 'error',
          summary: 'Cancelado',
          detail: 'Você cancelou a ação. O Registro será mantido.',
          life: 3000,
        });
      },
    });
  }

  function novoUsuario() {
    Inertia.get(route('users.create'));
  }

  const pageName = 'Listar Usuários';

  // const success = computed(() => usePage().props.value.success);
  const refProps = ref(props);
  const error = computed(() => usePage().props.value.error);

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
      <Button label="Novo" @click="novoUsuario" />
    </div>
  </div>
  <div>
    <DataTable
      :value="users.data"
      :paginator="true"
      :rows="10"
      paginator-template="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
      :rows-per-page-options="[5, 10, 20, 50]"
      responsive-layout="scroll"
      current-page-report-template="Listando de {first} a {last} de {totalRecords}"
      data-key="id"
    >
      <Column field="name" header="Name">
        <template #body="{ data }">
          {{ data.name }}
        </template>
      </Column>
      <Column field="email" header="Email">
        <template #body="{ data }">
          {{ data.email }}
        </template>
      </Column>
      <Column header="Ações">
        <template #body="{ data }">
          <Button
            class="p-button-sm p-button-outlined p-button-info"
            label="Editar"
            @click="editar(data.id)"
          />
          <Button
            class="p-button-sm p-button-outlined p-button-danger"
            label="Excluir"
            @click="excluir(data.id)"
          />
        </template>
      </Column>
    </DataTable>
  </div>
</template>
