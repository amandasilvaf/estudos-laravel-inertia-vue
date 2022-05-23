<script setup>
  import 'bootstrap/dist/css/bootstrap.css';
  import 'font-awesome/css/font-awesome.css';

  import { ref, reactive, computed } from 'vue';
  import ItemList from './components/ItemList.vue';

  const prefixes = reactive(['Air', 'Jet', 'Flight']);
  const sufixes = reactive(['Hub', 'Station', 'Mart']);

  const prefix = ref('');
  const sufix = ref('');

  function addPrefix(newPrefix) {
    prefixes.push(newPrefix);
    prefix.value = '';
  }

  function addSufix(newSufix) {
    sufixes.push(newSufix);
    sufix.value = '';
  }

  function deletePrefix(p) {
    prefixes.splice(prefixes.indexOf(p), 1);
  }

  function deleteSufix(s) {
    sufixes.splice(sufixes.indexOf(s), 1);
  }

  const domains = computed(() => {
    // eslint-disable-next-line no-console
    console.log('generating domains..');
    const arrayDomains = reactive([]);
    // eslint-disable-next-line no-restricted-syntax
    for (const pref of prefixes) {
      // eslint-disable-next-line no-restricted-syntax
      for (const suf of sufixes) {
        const newDomain = pref + suf;
        arrayDomains.push(newDomain);
      }
    }

    return arrayDomains;
  });
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
      <div class="container">
        <div class="row">
          <div class="col-md">
            <ItemList
              :items="prefixes"
              @add-item="(item) => addPrefix(item)"
              @delete-item="(item) => deletePrefix(item)"
            />
          </div>

          <div class="col-md">
            <ItemList
              :items="sufixes"
              @add-item="(item) => addSufix(item)"
              @delete-item="(item) => deleteSufix(item)"
            />
          </div>
        </div>
        <br />
        <h5>
          Domains <span class="badge bg-info">{{ domains.length }}</span>
        </h5>
        <div class="card">
          <div class="card-body">
            <ul class="list-group">
              <li
                v-for="domain in domains"
                :key="domain"
                class="list-group-item"
              >
                {{ domain }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
  #slogan {
    margin-top: 30px;
    margin-bottom: 20px;
  }

  #main {
    background-color: pink;
    padding-top: 30px;
    padding-bottom: 30px;
  }
</style>
