<script setup>
  import 'bootstrap/dist/css/bootstrap.css';
  import 'font-awesome/css/font-awesome.css';

  import { ref, reactive } from 'vue';

  const prefixes = reactive(['Air', 'Jet', 'Flight']);
  const sufixes = reactive(['Hub', 'Station', 'Mart']);
  const domains = reactive(['AirHub']);
  const prefix = ref('');
  const sufix = ref('');

  function generateDomain() {
    domains.splice(0);

    // eslint-disable-next-line no-restricted-syntax
    for (const pref of prefixes) {
      // eslint-disable-next-line no-restricted-syntax
      for (const suf of sufixes) {
        const newDomain = pref + suf;
        domains.push(newDomain);
      }
    }
  }

  function addPrefix(newPrefix) {
    prefixes.push(newPrefix);
    prefix.value = '';
    generateDomain();
  }

  function addSufix(newSufix) {
    sufixes.push(newSufix);
    sufix.value = '';
    generateDomain();
  }

  function deletePrefix(p) {
    prefixes.splice(prefixes.indexOf(p), 1);
    generateDomain();
  }

  function deleteSufix(s) {
    sufixes.splice(sufixes.indexOf(s), 1);
    generateDomain();
  }
</script>

<template>
  <div>
    <div id="slogan">
      <div class="text-center">
        <h1>Domains Generator <span class="fa fa-check" /></h1>
        <button class="btn btn-info btn-sm" @click="generateDomain()">
          Gerar dominios
        </button>
        <br />
      </div>
    </div>
    <div id="main">
      <div class="container">
        <div class="row">
          <div class="col-md">
            <h5>
              Prefixos <span class="badge bg-info">{{ prefixes.length }}</span>
            </h5>
            <div class="card">
              <div class="card-body">
                <ul class="list-group">
                  <li
                    v-for="prefix in prefixes"
                    :key="prefix"
                    class="list-group-item"
                  >
                    <div class="row">
                      <div class="col-md">
                        {{ prefix }}
                      </div>
                      <div class="col-md text-right">
                        <button
                          class="btn btn-info"
                          @click="deletePrefix(prefix)"
                        >
                          <span class="fa fa-trash" />
                        </button>
                      </div>
                    </div>
                  </li>
                </ul>
                <br />
                <div class="input-group">
                  <input
                    v-model="prefix"
                    class="form-control"
                    type="text"
                    placeholder="Informe o prefixo"
                    @keyup.enter="addPrefix(prefix)"
                  />
                  <div class="input-group-append">
                    <button class="btn btn-info" @click="addPrefix(prefix)">
                      <span class="fa fa-plus" />
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md">
            <h5>
              Sufixos <span class="badge bg-info">{{ sufixes.length }}</span>
            </h5>
            <div class="card">
              <div class="card-body">
                <ul class="list-group">
                  <li
                    v-for="sufix in sufixes"
                    :key="sufix"
                    class="list-group-item"
                  >
                    <div class="row">
                      <div class="col-md">
                        {{ sufix }}
                      </div>
                      <div class="col-md text-right">
                        <button
                          class="btn btn-info"
                          @click="deleteSufix(sufix)"
                        >
                          <span class="fa fa-trash" />
                        </button>
                      </div>
                    </div>
                  </li>
                </ul>
                <br />
                <div class="input-group">
                  <input
                    v-model="sufix"
                    class="form-control"
                    type="text"
                    placeholder="Informe o sufixo"
                    @keyup.enter="addSufix(sufix)"
                  />
                  <div class="input-group-append">
                    <button class="btn btn-info" @click="addSufix(sufix)">
                      <span class="fa fa-plus" />
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br />
        <h5>
          Domínios <span class="badge bg-info">{{ domains.length }}</span>
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
