<template>
    <div>
        <server-modal :isLoading="isLoading"></server-modal>
        <div>
            <server-item v-for="server in this.servers" :server="server" :key="server.id">
            </server-item>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                servers : [],
                isLoading:false
            }
        },
        methods: {
            getServers() {
                this.isLoading = true;
                axios.get(
                    '/api/servers',
                    {}
                ).then(response => {
                    this.servers = response.data
                    this.isLoading = false;
                });
            }
        },
        beforeMount(){
           this.getServers()
        },
        created: function() {
            this.$root.$on('reload-list', (reload) => {
                this.getServers();
            });
        },
    }
</script>
