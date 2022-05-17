<script setup lang="ts">
  import { useToast } from 'primevue/usetoast';
  import { Inertia } from '@inertiajs/inertia';
  import { route } from '@scripts/libs/ziggy';
  import { useForm } from '@inertiajs/inertia-vue3';

  const toast = useToast();

  function alertar() {
    toast.add({
      severity: 'info',
      summary: 'Hi, Amanda!',
      life: 5000,
    });
  }
  const form = useForm({
    name: '',
    email: '',
    password: '',
  });

  function handleForm() {
    form.post(route('users.store'));
  }

  function voltar() {
    Inertia.get('/users');
  }
</script>

<template layout="Layout">
  <div>
    <Button label="toast" @click="alertar" />
    <Toast />
  </div>
  <hr />
  <div>
    <form class="mt-5" @submit.prevent="handleForm">
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
      <progress
        v-if="form.progress"
        :value="form.progress.percentage"
        max="100"
      >
        {{ form.progress.percentage }}%
      </progress>
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
