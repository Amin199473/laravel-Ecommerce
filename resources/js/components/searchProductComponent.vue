<template>
  <div>
    <input
      type="text"
      placeholder="Search Product by name or title..."
      v-model="keyword"
      v-on:keyup="searchJobs"
      class="form-control"
    />

    <div class="card-footer" v-if="results.length">
      <ul class="list-group">
        <li class="list-group-item">
          <a
            :href="'/product/' + result.id + '/' + result.slug + '/'"
            v-for="result in results"
            :key="result.id"
          >
            <span class="badge badge-secondary">{{result.name}}</span>
            <br />
            <span>
              {{ result.title }}
              <img
                :src="'http://laravelshopping.ir/Images-Product/'+result.main_image"
                width="40px"
              />
            </span>
            <br />
            <br />
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      keyword: "",
      results: []
    };
  },
  methods: {
    searchJobs() {
      this.results = [];
      if (this.keyword.length > 1) {
        axios
          .get("/searchProduct", { params: { keyword: this.keyword } })
          .then(response => {
            this.results = response.data;
          });
      }
    }
  }
};
</script>
