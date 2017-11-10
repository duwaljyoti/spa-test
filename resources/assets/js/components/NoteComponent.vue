<template>
    <div>
        I am note component
    </div>
</template>

<script>
   import router from '../routes.js';

    export default {
        name: 'NoteComponent',
        router,
        mounted() {
            console.log('i am from note ');
        },
    }
</script>