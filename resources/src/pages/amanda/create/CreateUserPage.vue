<script setup lang="ts">
  import { useToast } from 'primevue/usetoast';
  import { Inertia } from '@inertiajs/inertia';

  import { route } from '@scripts/libs/ziggy';
  import { useForm } from '@inertiajs/inertia-vue3';
  import FileUpload from 'primevue/fileupload';

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
    avatar: null,
  });

  function submit() {
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
    <form class="mt-5" @submit.prevent="submit">
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
        <div v-if="form.errors.name" class="p-error">
          {{ form.errors.name }}
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
        <div v-if="form.errors.email" class="p-error">
          {{ form.errors.email }}
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
        <div v-if="form.errors.password" class="p-error">
          {{ form.errors.password }}
        </div>
      </div>
      <div class="field mb-4 col-12 md:col-6">
        <label for="avatar" class="font-medium">Avatar</label>
        <div class="flex align-items-center">
          <img
            src="@pages/user/profile/assets/images/avatar-f-4.png"
            class="mr-4"
          />
          <FileUpload
            mode="basic"
            name="avatar"
            url="./upload.php"
            accept="image/*"
            :max-file-size="1000000"
            class="p-button-outlined p-button-plain"
            choose-label="Upload Image"
            @input="form.avatar = $event.target.files[0]"
          />
        </div>

        <div v-if="form.errors.avatar" class="p-error">
          {{ form.errors.avatar }}
        </div>
        <progress
          v-if="form.progress"
          :value="form.progress.percentage"
          max="100"
        >
          {{ form.progress.percentage }}%
        </progress>
      </div>

      <div class="my-5">
        <Button label="Salvar" type="submit" :disabled="form.processing" />
        <Button
          class="p-button-outlined p-button-info ml-2"
          label="Voltar"
          @click="voltar()"
        />
      </div>
    </form>
  </div>
</template>
