<template>
    <div>
        <ul class="list-group center">
            <div class="component-header">Favourite Notes ({{ favouriteCount }})</div>
            <div v-if="favouriteCount">
                <li v-for="(note, index) in favouriteNotes" class="list-group-item">
                    <span>{{ note.title }}</span>
                </li>
            </div>
        </ul>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
      mounted() {
        this.fetchFavourite();
      },
      computed: {
        ...mapState([
          'favouriteNotes'
        ]),
          favouriteCount() {
            return this.favouriteNotes.length;
          }
      },
      methods: {
        fetchFavourite() {
          this.$store.dispatch('fetchFavourite');
        }
      },

    }
</script>