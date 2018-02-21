<template>
    <div class="loader-wrapper" v-show="loading">
        <div class="spinner"></div>
    </div>
</template>
<style>
    .loader-wrapper {
        background: #fff;
        opacity: 0.6;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
    }

    @keyframes spinner {
        to {transform: rotate(360deg);}
    }

    .spinner:before {
        content: '';
        box-sizing: border-box;
        position: absolute;
        top: 50%;
        left: 50%;
        width: 40px;
        height: 40px;
        margin-top: -10px;
        margin-left: -10px;
        border-radius: 50%;
        border: 3px solid #ccc;
        border-top-color: #333;
        animation: spinner .6s linear infinite;
    }
</style>
<script>
  export default {
    name: 'Loading',
    data() {
      return {}
    },
    props: {
      loading: {
        type: Boolean,
        required: true,
      },
    }
  };
</script>