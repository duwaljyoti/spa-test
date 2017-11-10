<template>
    <div>
        <ul class="list-group center">
        <li v-for="(note, index) in notes" class="list-group-item" v-if="notes.length">
            <span v-if="currentEditingId !== note.id">{{ note.title }}</span>
            <input type="text" v-if="currentEditingId === note.id && editing" :placeholder="note.title" v-model="editedTitle">
           &nbsp; <div class="glyphicon glyphicon-trash" @click="deleteNote(note.id)"></div>
           &nbsp; <div class="glyphicon glyphicon-pencil" @click="edit(note.id)" v-if="currentEditingId !== note.id"></div>
           &nbsp; <div class="glyphicon glyphicon-ok" @click="update(note.id)" v-if="currentEditingId === note.id"></div>
        </li>
        </ul>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        name: 'List',
        data() {
          return {
              editing: false,
              currentEditingId: 0,
              allNotes: [],
              editedTitle: ''
          }
        },
        mounted() {
            this.$store.dispatch('fetch');
            this.$nextTick(() => {
                this.allNotes = this.notes;
            });
        },
        methods: {
          deleteNote(noteId) {
              this.$store.dispatch('deleteNote', noteId);
          },
          edit(noteId) {
              this.editing=true;
              this.currentEditingId = noteId;
          },
          update(noteId) {
              this.currentEditingId = 0;
              console.log(this.editedTitle);
              this.$store.dispatch('edit', {id: noteId, title:  this.editedTitle});
              this.editing = false;
          }
        },
        computed: {
            ...mapState(['notes']),
        }
    }
</script>