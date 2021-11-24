<template>
  <div>
    <input
      type="text"
      placeholder="Search Post by title..."
      v-model="keyword"
      v-on:keyup="searchPost"
      class="form-control"
    />

    <div class="card-footer" v-if="results.length">
      <ul class="list-group">
        <li class="list-group-item">
          <a
            :href="'/singlePost/' + result.id + '/' + result.slug + '/'"
            v-for="result in results"
            :key="result.id"
          >
            <span class="badge badge-secondary">{{result.title.substring(0, 20)+'...'}}</span>
            <br />
            <span>
              {{ result.subtitle.substring(0, 20)+'...' }}
              <img
                :src="'https://laravelshopping.ir/post-image/'+result.image"
                width="50px"
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
    searchPost() {
      this.results = [];
      if (this.keyword.length > 1) {
        axios
          .get("/searchPost", { params: { keyword: this.keyword } })
          .then(response => {
            this.results = response.data;
          });
      }
    }
  }
};
</script>
