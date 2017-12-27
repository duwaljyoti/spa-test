<template>
    <div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">My Notes</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="#/create">Users</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="#/create">Create</a></li>
                </ul>
            </div>
        </nav>
        <div id="notes-list">
            <select v-model="selectedUser" class="form-control">
                <option :data-tokens="user.name" v-for="user in userList" v-bind:value="user.id">{{ user.name }}</option>
            </select>
            <div id="list-header">
                <h2>Title</h2>
            </div>
            <div class="container">
                <div class="list-group">
                    <div v-if="userNotes.length">
                    <a class="list-group-item" href="#" v-for="note in userNotes"
                       :class="(activeNote && activeNote.id === note.id) ? 'active' : ''"
                    >
                        <h4 class="list-group-item-heading" @click="toggleActiveClass(note)">
                            {{ note.title }}
                        </h4>
                    </a>
                    </div>
                    <div v-else>
                    <a class="list-group-item" href="#">
                        <h4 class="list-group-item-heading">
                            No Notes Found!
                        </h4>
                    </a>
                    </div>
                </div>
            </div>
        </div>
        {{ activeNote ? activeNote.description : '' }}
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex';

    export default {
      name: 'User',
      data() {
        return {
          selectedUser: null,
          activeNote: {},
        }
      },
      mounted() {
        this.get();
      },

      methods: {
        ...mapActions([
          'get',
          'getUserNotes'
        ]),
        toggleActiveClass(note) {
          this.activeNote = note ? note : (this.userNotes ? this.userNotes[0] : {});
        },
      },
      computed: {
        ...mapState([
          'users',
          'userNotes'
        ]),
        userList() {
            return this.users ? this.users : [];
        },
      },
      watch: {
        selectedUser() {
          this.activeNote = {};
          this.getUserNotes(this.selectedUser);
          this.toggleActiveClass();
        }
      }
    }
</script>