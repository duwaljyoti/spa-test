<template>
    <div>
        <flash>
        </flash>
        <nav-bar>
        </nav-bar>
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
        <div style="padding-right:30px" class="cheat">
          <input v-model="note.description">
          <button class="btn-primary" @click="save(note)">Save</button>
        </div>

    </div>
</template>
<style>
    #notes-list .container{
      padding: 20px ;
    }
  .cheat{
    padding-left: 330px;
    padding-top: 30px;
  }
</style>
<script>
    import { mapActions, mapState } from 'vuex';
    import NavBar from '../../components/NavBar';
    import Flash from '../../components/Flash';

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
            .then(() => {
              this.$emit('flash', { message: 'Note Created.' });
              this.note.title = null;
              this.note.description = null;
              this.$router.push({ path: 'note' });
            })
            .catch((err) => {
              console.log(err)
            });
        }
      },
      computed: {
        ...mapState(['notes'])
      },
      components: {
        NavBar,
        Flash,
      },
    }
</script>