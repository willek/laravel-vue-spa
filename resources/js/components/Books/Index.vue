<template>
  <div class="books">
    <div v-if="error" class="error">
      {{ error }}
    </div>

    <p>
      <router-link :to="{ name: 'books.create' }" tag="button">Create Book</router-link>
    </p>

    <ul v-if="books">
      <li v-for="book in books">
        <strong>Title:</strong> {{ book.title }}<br>
        <strong>Description:</strong> {{ book.description }}<br>
        <strong>Year:</strong> {{ book.year }}
        <br>
        <router-link :to="{ name: 'books.edit', params: {id: book.id } }">edit</router-link>
      </li>
      <br>
      <p>
        <button type="button" v-on:click="goToPrev" v-bind:disabled="!prevPage">Prev</button>
        <span>{{ paginationCount }}</span>
        <button type="button" v-on:click="goToNext" v-bind:disabled="!nextPage">Next</button>
      </p>
    </ul>
  </div>
</template>
<script>
import axios from 'axios';
import api from '../../api/books';

export default {
    data() {
        return {
            books: null,
            meta: null,
            links: {
                first: null,
                last: null,
                next: null,
                prev: null,
            },
            error: null,
        };
    },
    computed: {
        nextPage() {
            if (! this.meta || this.meta.current_page === this.meta.last_page) {
                return;
            }

            return this.meta.current_page + 1;
        },
        prevPage() {
            if (! this.meta || this.meta.current_page === 1) {
                  return;
              }

            return this.meta.current_page - 1;
        },
        paginationCount() {
            if (! this.meta) {
                return;
            }

            const { current_page, last_page } = this.meta;

            return `${current_page} of ${last_page}`;
        }
    },
    beforeRouteEnter (to, from, next) {
        api.all(to.query.page, (err, data) => {
            next(vm => vm.setData(err, data));
        });
    },
    beforeRouteUpdate (to, from, next) {
        this.books = this.links = this.meta = null
        api.all(to.query.page, (err, data) => {
            this.setData(err, data);
            next();
        });
    },
    methods: {
        goToNext() {
            this.$router.push({
              query: {
                page: this.nextPage,
              },
            });
        },
        goToPrev() {
            this.$router.push({
              name: 'books.index',
              query: {
                page: this.prevPage,
              }
            });
        },
        setData(err, { data: books, links, meta }) {
            if (err) {
              this.error = err.toString();
            } else {
              this.books = books;
              this.links = links;
              this.meta = meta;
            }
        }
    }
}
</script>
