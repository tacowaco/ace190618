<template>
    <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
        <img :src="'/images/quizmekon_logo.png'" alt=""  height="80">
        <p class="is-size-3">Quizmekon</p>
        </a>
        <!-- <img :src="'/images/q1.png'"alt=""> -->
        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
    </div>
    </nav>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
