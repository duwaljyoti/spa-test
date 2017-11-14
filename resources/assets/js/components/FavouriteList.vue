<template>
    <div>
        <ul class="list-group center">
            <div v-if="Object.keys(favouriteNotes).length">
                Favourite Notes
                <li v-for="(note, index) in favouriteNotes" class="list-group-item">
                    <span>{{ note.title }}</span>
                </li>
            </div>
            <div v-else>Not Found</div>
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
        ])
      },
      methods: {
        fetchFavourite() {
          this.$store.dispatch('fetchFavourite');
        }
      }
    }
</script>