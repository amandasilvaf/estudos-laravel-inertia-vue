<script setup lang="ts">
  import { ref } from 'vue';

  import FileUpload from 'primevue/fileupload';

  const checked = ref(false);
  const selectedCountry = '';
  const countries = [
    {
      name: 'Australia',
      code: 'AU',
    },
    {
      name: 'Brazil',
      code: 'BR',
    },
    {
      name: 'China',
      code: 'CN',
    },
    {
      name: 'Egypt',
      code: 'EG',
    },
    {
      name: 'France',
      code: 'FR',
    },
    {
      name: 'Germany',
      code: 'DE',
    },
    {
      name: 'India',
      code: 'IN',
    },
    {
      name: 'Japan',
      code: 'JP',
    },
    {
      name: 'Spain',
      code: 'ES',
    },
    {
      name: 'United States',
      code: 'US',
    },
  ];
</script>

<template layout="Layout">
  <div>
    <div class="text-900 font-medium text-xl mb-3">Profile</div>
    <p class="m-0 mb-4 p-0 text-600 line-height-3 mr-3">
      Odio euismod lacinia at quis risus sed vulputate odio. Non nisi est sit
      amet. Egestas integer eget aliquet nibh praesent tristique magna.
    </p>
    <div class="surface-card p-4 shadow-2 border-round">
      <div class="grid formgrid p-fluid">
        <div class="field mb-4 col-12">
          <label for="nickname" class="font-medium">Nickname</label>
          <InputText id="nickname" type="text" />
        </div>
        <div class="surface-100 mb-3 col-12" style="height: 2px" />
        <div class="field mb-4 col-12 md:col-6">
          <label for="bio" class="font-medium">Bio</label>
          <Textarea id="bio" :rows="5" :auto-resize="true" />
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
            />
          </div>
        </div>
        <div class="surface-100 mb-3 col-12" style="height: 2px" />
        <div class="field mb-4 col-12 md:col-6">
          <label for="email" class="font-medium">Email</label>
          <InputText id="email" />
        </div>
        <div class="field mb-4 col-12 md:col-6">
          <label for="bio" class="font-medium">Country</label>
          <Dropdown
            v-model="selectedCountry"
            :options="countries"
            option-label="name"
            :filter="true"
            filter-by="name"
            :show-clear="true"
            placeholder="Select a Country"
          >
            <template #option="slotProps">
              <div class="flex align-items-center">
                <img
                  src="@pages/user/profile/assets/images/flag_placeholder.png"
                  :class="
                    'mr-2 flag flag-' + slotProps.option.code.toLowerCase()
                  "
                  style="width: 18px"
                />
                <div>{{ slotProps.option.name }}</div>
              </div>
            </template>
          </Dropdown>
        </div>
        <div class="field mb-4 col-12 md:col-6">
          <label for="city" class="font-medium">City</label>
          <InputText id="city" type="text" />
        </div>
        <div class="field mb-4 col-12 md:col-6">
          <label for="state" class="font-medium">State</label>
          <InputText id="state" type="text" />
        </div>
        <div class="surface-100 mb-3 col-12" style="height: 2px" />
        <div class="field mb-4 col-12">
          <label for="website" class="font-medium">Website</label>
          <div class="p-inputgroup">
            <span class="p-inputgroup-addon">www</span>
            <InputText id="website" type="text" />
          </div>
        </div>
        <div class="surface-100 mb-3 col-12" style="height: 2px" />
        <div class="field mb-4 col-12">
          <label for="privacy" class="font-medium">Privacy</label>
          <div class="flex align-items-center">
            <InputSwitch v-model="checked" />
            <span class="ml-2">Share my data with contacts</span>
          </div>
        </div>
        <div class="surface-100 mb-3 col-12" style="height: 2px" />
        <div class="col-12">
          <Button label="Save Changes" class="w-auto mt-3" />
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss"></style>
