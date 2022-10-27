<template>

  <div class="w-100 p-1">
    <div class="form-floating">
      <select
        class="form-select"
        id="floatingSelectGrid"
        aria-label="Floating label select example"
        name="year"
        v-model="form.year"
        data-next="makes"
        @change="getNext($event)"
      >
        <option
          v-for="year in years"
          :key="year"
          :value="year"
        >{{ year }}</option>

      </select>
      <label for="floatingSelectGrid">Select years</label>
    </div>
  </div>
  <div class=" w-100 p-1">
    <div class="form-floating">
      <select
        class="form-select"
        id="floatingSelectGrid"
        @change="getNext($event)"
        name="make"
        data-next="models"

        v-model="form.make_id"
      >
        <option selected>Open this select menu</option>
        <option
          v-for="make in next.makes"
          :key="make.id"
          :value="make.id"
        >{{ make.name }}</option>
       
      </select>
      <label for="floatingSelectGrid">Works with selects</label>
    </div>
  </div>
  <div class=" w-100 p-1">
    <div class="form-floating">
      <select
        class="form-select"
        id="floatingSelectGrid"
        aria-label="Floating label select example"
        name="model"
        @change="getNext($event)"
        v-model="form.model_id"
        data-next="engines"


      >
        <option selected>Open this select menu</option>
        <option
          v-for="model in next.models"
          :key="model.id"
          :value="model.id"
        >{{ model.name }}</option>
       
        
      </select>
      <label for="floatingSelectGrid">Works with selects</label>
    </div>
  </div>
  <div class="col2 w-100 p-1">
    <div class="form-floating">
      <select
        class="form-select"
        id="floatingSelectGrid"
        aria-label="Floating label select example"
        name="engine_id"
        
        @change="getNext($event)"
        v-model="form.engine_id"

      >
        <option selected>Open this select menu</option>

        <option
          v-for="engine in next.engines"
          :key="engine.id"
          :value="engine.id"
        >{{ engine.name }}</option>
       
      </select>
      <label for="floatingSelectGrid">Works with selects</label>
    </div>
  </div>

</template>

<script>
import { reactive, ref } from 'vue';
import axios from 'axios';

export default {
  props: ["years"],
  setup() { 
    const makes = ref([])
    const models = ref([])
    const engines = ref([])

    const next = reactive({
      makes: [],
      models: "",
      engines: "",
    })

    const form = reactive({
      year: "",
      make_id: "",
      model_id: "",
      engine_id: "",
      type: "",
      next: ""
    })

    function getNext(e) {
      form.type = e.target.name
      let nt = e.target.dataset.next;
      axios
        .get("/make-model-year-engine", {
           params: form
        })
        .then(response => {
           next[nt] = response.data.data
        })
        .catch((error) => {
           console.log(error)
        });
    }

    return {
      makes,
      models,
      engines,
      getNext,
      form,
      next
    }


  },
};
</script>