<template>
    <div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">My Notes</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="#/create">Create</a></li>
                </ul>
            </div>
        </nav>
        <div id="notes-list">
            <div id="list-header">
                <h2>Notes</h2>
            </div>
            <!-- render notes in a list -->
            <div class="container">
                <div class="list-group">
                    <a
                            class="list-group-item active" href="#"
                    >
                        <h4 class="list-group-item-heading">
                            Test Note 1
                        </h4>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</template>


<script>
    import { mapState, mapActions } from 'vuex';

    export default {
      name: 'Note',
      mounted() {
        this.getAll();
      },
      methods: {
        ...mapActions([
          'getAll',
        ]),
      },
      computed: {
        ...mapState([
          'notes'
        ])
      }
    }
</script>