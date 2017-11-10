<template>
    <div>
        <form @submit.prevent="add">
            <input v-model="title">
            <button type="submit">Create</button>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'CreateNote',
        data() {
          return {
              title: ''
          }
        },
        mounted() {
        },
        methods: {
            add() {
                axios.post('/api/notes', {
                    'title': this.title,
                    'user_id': 1,
                    'is_favourite': false,
                })
                    .then((response) => {
                      this.$router.push('/list');
                    })
            }
        }
    }
</script>