<template>
    <div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">My Notes</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="new-note#/create">Create</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="new-note#">Notes</a></li>
                </ul>
            </div>
        </nav>
        <div id="notes-list">
            <div id="list-header">
                <h2>Create Note</h2>
            </div>
            <!-- render notes in a list -->
            <div class="container">
                    <div class="form-group">
                        <input type="text" class="form-control" id="usr" v-model="note.title">
                    </div>
            </div>
        </div>
        <input v-model="note.description">
        <div style="padding-right:30px">
            <button class="btn-primary" @click="save(note)">Save</button>
        </div>

    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex';

    export default {
      name: 'Create',
      data() {
        return {
          note: {
          title: '',
          description: '',
          },
        }
      },
      methods: {
        save() {
          this.$store.dispatch('save', this.note)
            .then((response) => {
              console.log('here===>', response);
            })
            .catch((err) => {
              console.log(err)
            });
        }
      },
      computed: {
        ...mapState(['notes'])
      }
    }
</script>