<script setup>
  import 'bootstrap/dist/css/bootstrap.css';
  import 'font-awesome/css/font-awesome.css';
  import DomainList from './components/DomainList.vue';
</script>

<template>
  <div>
    <div id="slogan">
      <div class="text-center">
        <h1>Domains Generator <span class="fa fa-check" /></h1>
        <br />
      </div>
    </div>

    <div id="main">
      <DomainList />
    </div>
  </div>
</template>

<style scoped>
  #slogan {
    margin-top: 30px;
    margin-bottom: 30px;
    background-color: antiquewhite;
  }

  #main {
    background-color: pink;
    padding-top: 30px;
    padding-bottom: 30px;
  }
</style>
