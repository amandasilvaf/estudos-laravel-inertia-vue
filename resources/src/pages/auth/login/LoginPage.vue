<script setup lang="ts">
  import { ref, reactive, defineProps } from 'vue';

  import { Inertia } from '@inertiajs/inertia';

  import { route } from '@scripts/libs/ziggy';

  type LoginPageProps = {
    errors?: {
      user_name: string;
      password: string;
    };
  };

  const props = defineProps<LoginPageProps>();
  const checked = ref([false]);

  const form = reactive({
    user_name: '',
    password: '',
  });

  function handleSubmit() {
    Inertia.post(route('auth.signIn'), form);
  }
</script>

<template layout>
  <div
    class="flex align-items-center justify-content-center flex-wrap min-h-screen"
  >
    <div class="surface-card p-4 shadow-2 border-round w-full lg:w-4">
      <div class="text-center mb-5">
        <img
          src="@pages/auth/login/assets/images/logo.svg"
          alt="Image"
          height="50"
          class="mb-3"
        />
        <div class="text-900 text-3xl font-medium mb-3">Welcome Back</div>
        <span class="text-600 font-medium line-height-3"
          >Don't have an account?</span
        >
        <a class="font-medium no-underline ml-2 text-blue-500 cursor-pointer"
          >Create today!</a
        >
      </div>

      <form @submit.prevent="handleSubmit">
        <div class="mb-3">
          <label for="user_name" class="block text-900 font-medium mb-2"
            >Email</label
          >
          <InputText
            id="user_name"
            v-model="form.user_name"
            type="text"
            class="w-full"
          />
          <small v-if="props.errors?.user_name" class="p-error">{{
            props.errors?.user_name
          }}</small>
        </div>

        <div class="mb-3">
          <label for="password" class="block text-900 font-medium mb-2"
            >Password</label
          >
          <InputText
            id="password"
            v-model="form.password"
            type="password"
            class="w-full"
          />
          <small v-if="props.errors?.password" class="p-error">{{
            props.errors?.password
          }}</small>
        </div>

        <div class="flex align-items-center justify-content-between mb-6">
          <div class="flex align-items-center">
            <Checkbox
              id="rememberme1"
              v-model="checked"
              :binary="true"
              class="mr-2"
            />
            <label for="rememberme1">Remember me</label>
          </div>
          <a
            class="font-medium no-underline ml-2 text-blue-500 text-right cursor-pointer"
            >Forgot password?</a
          >
        </div>
        <Button
          type="submit"
          label="Sign In"
          icon="pi pi-user"
          class="w-full flex align-items-center justify-content-center"
        />
      </form>
    </div>
  </div>
</template>

<style lang="scss">
  .p-button-label {
    flex: none;
  }
</style>
