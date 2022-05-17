<script setup lang="ts">
  import { defineProps } from 'vue';
  import { Inertia } from '@inertiajs/inertia';
  import { useForm } from '@inertiajs/inertia-vue3';
  import { route } from '@/scripts/libs/ziggy/config';

  type User = {
    id: number;
    name: string;
    email: string;
    password: string;
  };

  type UserProps = {
    user: User;
  };

  const props = defineProps<UserProps>();

  const form = useForm({
    id: props.user.id,
    name: props.user.name,
    email: props.user.email,
    password: props.user.password,
  });

  function voltar() {
    Inertia.get('/users');
  }

  function updateUser() {
    form.put(
      route('users.update', {
        id: props.user.id,
      }),
    );
  }
</script>

<template layout="Layout">
  <h3>Edit User Page</h3>
  <div>
    <form class="mt-5" @submit.prevent="updateUser">
      <div class="field col-12 md:col-4">
        <span class="p-float-label">
          <InputText
            id="name"
            v-model="form.name"
            type="text"
            autocomplete="off"
          />
          <label for="name">Nome: </label>
        </span>
        <div v-if="$page.props.errors.name" class="p-error">
          {{ $page.props.errors.name }}
        </div>
      </div>
      <div class="field col-12 md:col-4">
        <span class="p-float-label">
          <InputText
            id="email"
            v-model="form.email"
            type="email"
            autocomplete="off"
          />
          <label for="email">E-mail</label>
        </span>
        <div v-if="$page.props.errors.email" class="p-error">
          {{ $page.props.errors.email }}
        </div>
      </div>
      <div class="field col-12 md:col-4">
        <span class="p-float-label">
          <InputText
            id="password"
            v-model="form.password"
            type="password"
            autocomplete="off"
          />
          <label for="password">Senha</label>
        </span>
        <div v-if="$page.props.errors.password" class="p-error">
          {{ $page.props.errors.password }}
        </div>
      </div>
      <div>
        <Button label="Salvar" type="submit" />
        <Button
          class="p-button-outlined p-button-info ml-2"
          label="Voltar"
          @click="voltar()"
        />
      </div>
    </form>
  </div>
</template>
