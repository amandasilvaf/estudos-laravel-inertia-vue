<script setup lang="ts">
  import AppContainer from '@sections/app-container/AppContainer.vue';
  import CardInformation from './components/CardInformation.vue';
  import CardAction from './components/CardAction.vue';
</script>

<template>
  <AppContainer :container="false">
    <div class="flex flex-wrap">
      <CardInformation
        title="Orders"
        text="152"
        description-green="124"
        description-grey=" new assigment"
        icon-class="text-blue-500 text-xl pi pi-shopping-cart"
        bg-icon="bg-blue-100"
      />

      <CardInformation
        title="Revenue"
        text="$2.100"
        description-green="%52+"
        description-grey=" since last week"
        icon-class="pi pi-map-marker text-orange-500 text-xl"
        bg-icon="bg-orange-100"
      />

      <CardInformation
        title="Customers"
        text="28441"
        description-green="520"
        description-grey=" newly registered"
        icon-class="pi pi-inbox text-cyan-500 text-xl"
        bg-icon="bg-cyan-100"
      />

      <CardInformation
        title="Comments"
        text="152 Unread"
        description-green="85"
        description-grey=" responded"
        icon-class="pi pi-comment text-purple-500 text-xl"
        bg-icon="bg-purple-100"
      />

      <CardAction
        image-src="http://localhost:3000/resources/src/pages/home/dashboard/assets/images/windows.svg"
        image-alt="Imagem 1"
      />

      <CardAction
        title="Title Placeholder"
        text="Nunc mi ipsum faucibus vitae aliquet nec. Lacus sed viverra tellus
            in hac habitasse platea dictumst."
        image-src="http://localhost:3000/resources/src/pages/home/dashboard/assets/images/security.svg"
        image-alt="Imagem 1"
      />

      <CardAction
        title="Title Placeholder"
        text="Nunc mi ipsum faucibus vitae aliquet nec. Lacus sed viverra tellus
            in hac habitasse platea dictumst."
        image-src="http://localhost:3000/resources/src/pages/home/dashboard/assets/images/live-collaboration.svg"
        image-alt="Imagem 1"
      />
    </div>
  </AppContainer>
</template>

<style scoped lang="scss"></style>
