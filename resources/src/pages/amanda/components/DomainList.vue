<script setup>
  import 'bootstrap/dist/css/bootstrap.css';
  import 'font-awesome/css/font-awesome.css';

  import { reactive, computed } from 'vue';
  import ItemList from './ItemList.vue';

  const prefixes = reactive(['Air', 'Jet', 'Flight']);
  const sufixes = reactive(['Hub', 'Station', 'Mart']);

  function addPrefix(newPrefix) {
    prefixes.push(newPrefix);
  }

  function addSufix(newSufix) {
    sufixes.push(newSufix);
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
    <div id="main">
      <div class="container">
        <div class="row">
          <div class="col-md">
            <ItemList
              title="Prefixes"
              :items="prefixes"
              @add-item="(item) => addPrefix(item)"
              @delete-item="(item) => deletePrefix(item)"
            />
          </div>

          <div class="col-md">
            <ItemList
              title="Sufixes"
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

<style scoped></style>
