<template>
    <div>
        <router-link to="/create">Create</router-link>
        <router-link to="/list">List</router-link>

        <router-view></router-view>
    </div>
</template>

<script>
    import axios from 'axios';
    import { mapState } from 'vuex';

    export default {
        name: 'TestNote',
        data() {
            return {
            }
        },
        mounted() {
        },
        methods: {
        },
        computed: {
            ...mapState(['noteCount']),
        }
    }
</script>