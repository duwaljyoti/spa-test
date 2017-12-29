<template>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div v-if="loggedUser">
                <ul class="nav navbar-nav">
                    <li :class="{ active: activeLink === 'note' }">
                        <a href="note" @click="activeLink = 'note'">My Notes</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li :class="{ active: activeLink === 'favourite' }">
                        <a href="note#/?type=favourite" @click="changeNoteRoute">Favourite</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav">
                    <li :class="{ active: activeLink === 'create' }"><a href="note#/create">Create</a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav active">
                <li :class="{ active: activeLink === 'user' }">
                    <a href="user">Users</a>
                </li>
            </ul>
            <ul class="nav navbar-nav pull-right" @click="logout">
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
    </nav>
</template>

<script>
    import axios from 'axios';
    import Flash from '../components/Flash';

    export default{
      components: {
        Flash,
      },
      name: 'Navbar',
      data() {
        return {
          loggedUser: {},
          activeLink: null,
        }
      },
      mounted() {
        this.loggedUser = window.loggedUser;
        this.activeRoute(this.$route.name);
        if (!this.loggedUser) {
          const windowLocation = window.location;
          windowLocation.href = `${windowLocation.origin}/login`;
        }
      },
      methods: {
        logout() {
          axios.post('/logout')
            .then(() => {
              window.location.href = window.location.origin + '/login';
              this.$emit('flash', { message: 'You have been logged out.' });
            });
        },
        changeNoteRoute() {
          this.$emit('note-route-changed');
        },
        activeRoute(route) {
          if (route === 'note' && this.$route.query.type === 'favourite') {
            this.activeLink = 'favourite';
          } else {
            this.activeLink = route;
          }
        }
      },
      watch: {
        '$route' () {
          this.activeRoute(this.$route.name);
        }
      }
    }
</script>