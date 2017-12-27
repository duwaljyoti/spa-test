<template>
    <div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">My Notes</a>
                </div>
                <ul class="nav navbar-nav">
                    <li @click="changeRoute()"><router-link :to="{ name: 'note-main'}">My Notes</router-link></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><router-link v-on:click.native="changeRoute('favourite')" :to="{ name: 'note-main', query: { type: 'favourite' }}">
                        Favourite</router-link></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="#/create">Users</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="#/create">Create</a></li>
                </ul>
            </div>
        </nav>
        <div id="notes-list">
            <div id="list-header">
                <h2>{{ noteTitle }}</h2>
            </div>
            <div class="container">
                <div class="list-group">
                    <a class="list-group-item" href="#" v-for="note in noteList"
                       :class="activeNote.id === note.id ? 'active' : ''"
                    >
                        <h4 class="list-group-item-heading" @click="toggleActiveClass(note)">
                            {{ note.title }} &nbsp
                            <div class="glyphicon glyphicon-trash" title="Delete Note" @click="deleteNote(note)"></div> &nbsp
                            <div :class="heartClass(note)" @click="toggleFavourite(note.id, note.is_favourite   )" title="Edit Note"></div> &nbsp
                            <div v-if="!isBeingEdited" class="glyphicon glyphicon-pencil" title="Edit Note" @click="editNote(note)"></div>
                            <div  v-else class="glyphicon glyphicon-ok" title="Delete Note" @click="deleteNote(note)"></div> &nbsp
                        </h4>
                    </a>
                </div>
            </div>
        </div>
        {{ activeNote.description }}
    </div>
</template>

<script>
  import {mapState, mapActions} from 'vuex';

  export default {
    data() {
      return {
        activeNote: '',
        currentRoute: '',
        noteList: [],
        isBeingEdited: false,
      }
    },
    name: 'Note',
    mounted() {
      this.currentRoute = this.$route.query.type;
      this.get();
      setTimeout(() => {
        this.toggleActiveClass();
      }, 1500);
    },
    methods: {
      toggleActiveClass(note) {
        this.activeNote = note ? note : (this.noteList ? this.noteList[0] : {});
      },
      get() {
        if (!this.currentRoute) {
          this.getAll();
        } else {
          this.getFavourite();
        }
        setTimeout(() => {
          this.noteList = this.currentRoute ? this.favouriteNotes : this.notes;
        }, 1000);
      },
      deleteNote(note) {
        this.$store.dispatch('deleteNote', note);
        this.get();
      },
      ...mapActions([
        'getAll',
        'getFavourite',
      ]),
      changeRoute(type = null) {
        this.currentRoute = type;
        this.get();
      },
      heartClass(note) {
        const heartIcon = 'glyphicon glyphicon-heart';
        return note.is_favourite ? heartIcon : `${heartIcon}-empty`;
      },
      toggleFavourite(id, is_favourite) {
        this.$store.dispatch('toggleFavourite', id);
        this.get();
        // const message = is_favourite ? 'Unfavourited Successfully' :'Favourited successfully.';
        // flash(message);
      },
      editNote(note) {
        this.isBeingEdited = true;
        console.log(note);
      },
    },
    computed: {
      ...mapState([
        'notes',
        'favouriteNotes',
      ]),
      noteTitle() {
        return this.currentRoute === 'favourite' ? 'Favourite Notes' : 'Notes';
      },
    },
  }
</script>