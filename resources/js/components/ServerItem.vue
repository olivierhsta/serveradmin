<template>
    <div class="tile is-parent is-6 is-centered">
        <article class="tile is-child notification "
                :class="{'is-success': this.server.status, 'is-danger': !this.server.status}">
            <p class="title">
                <a @click="onClick()">{{this.server.name}}</a>
            </p>
            <p class="subtitle">{{this.server.ip}}</p>
        </article>
    </div>
</template>

<script>
    export default {
        props: ['server'],
        data() {
            return {
                servers : []
            }
        },
        methods: {
            onClick() {
                this.$root.$emit('server-clicked', this.server);
            }
        }
    }
</script>
<style>
    .is-centered {
        margin:auto;
    }
</style>
