<template>
  <div>
    <div v-if="message" class="alert alert-dismissable">
      {{ message }}
    </div>
    <div v-if="!loaded">Loading ...</div>
    <form v-on:submit.prevent="onSubmit($event)" v-else autocomplete="off">
      <div class="form-group">
        <label for="book_title">Title</label>
        <input id="book_title" v-model="book.title">
        <form-error v-if="errors.title" v-bind:errors="errors.title">
          <div v-for="err in errors.title">
            {{ err }}
          </div>
        </form-error>
      </div>
      <div class="form-group">
        <label for="book_description">Description</label>
        <input id="book_description" v-model="book.description">
        <form-error v-if="errors.description" v-bind:errors="errors.description">
          <div v-for="err in errors.description">
            {{ err }}
          </div>
        </form-error>
      </div>
      <div class="form-group">
        <label for="book_year">Year</label>
        <input id="book_year" v-model="book.year">
        <form-error v-if="errors.year" v-bind:errors="errors.year">
          <div v-for="err in errors.year">
            {{ err }}
          </div>
        </form-error>
      </div>
      <div class="form-group">
        <button type="submit" v-bind:disabled="saving || deleting">Update</button>
        <button type="button" v-bind:disabled="saving || deleting" v-on:click.prevent="onDelete($event)">Delete</button>
        <button type="button" v-bind:disabled="saving || deleting" v-on:click.prevent="$router.go(-1)">Back</button>
      </div>
    </form>
  </div>
</template>
<script>
import api from '../../api/books';
import form_error from '../../components/Utility/Error';

export default {
  components: {
    'form-error': form_error,
  },
  data() {
    return {
      errors: [],
      message: null,
      loaded: false,
      saving: false,
      deleting: false,
      book: {
        id: null,
        title: "",
        description: "",
        year: ""
      }
    };
  },
  methods: {
    onSubmit(event) {
      this.saving = true;

      api.update(this.book.id, {
        title: this.book.title,
        description: this.book.description,
        year: this.book.year
      }).then((response) => {
        this.message = 'Book updated';

        setTimeout(() => this.$router.push({name: 'books.index'}), 2000);
      }).catch(error => {
        this.message = error.response.data.message;

        setTimeout(() => this.message = null, 2000);

        this.errors = error.response.data.errors;
      });
    },
    onDelete(event) {
      this.deleting = true;

      api.delete(this.book.id).then((response) => {
        this.message = 'Book deleted';

        setTimeout(() => this.$router.push({name: 'books.index'}), 2000);
      });
    }
  },
  created() {
    api.find(this.$route.params.id).then((response) => {
      this.loaded = true;
      this.book = response.data.data;
    }).catch((error) => {
      this.$router.push({ name: '404' });
    });
  }
};
</script>
<style lang="scss" scoped>
.form-group label {
  display: block;
}
.alert {
  background: lighten(black, 30%);
  color: #fff;
  padding: 1rem;
  margin-bottom: 1rem;
  width: 50%;
}
</style>
