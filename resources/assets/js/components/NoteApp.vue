<template>
    <div>
        <div class="header-nav">
            <router-link to="/create">Create</router-link>
            <router-link to="/list">List</router-link>
            <router-link to="/favourite-list">Favourite List</router-link>
            <router-view></router-view>
            <flash></flash>
        </div>

        <div class="alert alert-message messageBody"
             id="messageBody"
             style="visibility: hidden;"
        ></div>
    </div>
</template>

<script>
    import axios from 'axios';
    import { mapState } from 'vuex';
    import Flash from './Flash.vue'

    export default {
        name: 'NoteApp',
        components: {
            flash: Flash
        }
    }
</script>