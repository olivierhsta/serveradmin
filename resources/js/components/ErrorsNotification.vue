<template>
    <div class="notification is-danger is-light" :class="{'is-hidden': !hasErrors()}">
        <ul class="is-marginless">
            <li v-for="error in errors">{{error[0]}}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['errors'],
        methods: {
            hasErrors() {
                if (this.errors.length == 0) {
                    return false;
                }
                return true;
            }
        }
    }
</script>
