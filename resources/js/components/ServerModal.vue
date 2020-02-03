<template>
    <div>
        <div class="columns margin-top-4">
            <div class="column is-3"></div>
            <div class="column is-6">
                <button class="button" @click="toggleModal();">Create New Server</button>
                <button class="button is-pulled-right" :class="{'is-loading':isLoading}" @click="askToReloadList();">Refresh</button>
            </div>
            <div class="column is-3"></div>
        </div>
        <div class="modal" :class="{'is-active':isActive}">
            <div class="modal-background" @click="toggleModal()"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <div class="modal-card-title">
                        <h5 class="is-marginless">{{this.server.name}}</h5>
                        <small class="is-marginless">Server {{this.server.status ? 'running' : 'not running'}}</small>
                    </div>
                    <button class="delete" aria-label="close" @click="toggleModal()"></button>
                </header>
                <section class="modal-card-body">
                    <errors-notification :errors="errors"></errors-notification>
                    <div class="field">
                        <label class="label">Server Name</label>
                        <div class="control">
                            <input class="input" type="text" placeholder="Server Name" v-model="server.name">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">IP</label>
                        <div class="control">
                            <input class="input" type="text" placeholder="IP" v-model="server.ip">
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot" style="justify-content: space-between;">
                    <div>
                        <button class="button" @click="toggleModal()">Cancel</button>
                    </div>
                    <div>
                        <button class="button is-danger"
                                :class="{'is-hidden':isInCreationMode(),'is-loading':isDeleting}"
                                @click="deleteServer()"
                                :disabled="isSaving">
                                Delete
                        </button>
                        <button class="button is-success"
                                :class="{'is-loading':isSaving}"
                                @click="save()"
                                :disabled="isDeleting">
                                Save
                        </button>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['isLoading'],
    data() {
        return {
            server:{},
            isActive : false,
            nameIsValid:true,
            errors:[],
            isSaving:false,
            isDeleting:false
        }
    },
    methods: {
        getIP() {
            if (this.server) {
                return this.server.ip;
            }
            return '';
        },
        getName() {
            if (this.server) {
                return this.server.name;
            }
            return '';
        },
        isInCreationMode() {
            if (this.server.id) {
                return false;
            }
            return true;
        },
        toggleModal() {
            if (this.isActive) {
                this.server={};
                this.isActive = false;
                this.nameIsValid = true;
                this.errors = [];
                this.isSaving = false;
                this.isDeleting = false;
                this.askToReloadList();
            } else {
                this.isActive = true;
            }
        },
        askToReloadList() {
            this.$root.$emit('reload-list',true);
        },
        save() {
            this.isSaving = true;
            if (this.server.id) {
                axios.patch(
                    '/api/server/'+this.server.id,
                    {"name":this.server.name,
                    "ip":this.server.ip}
                ).then(response => {
                    this.toggleModal();
                }).catch(error => {
                    this.errors = error.response.data.errors;
                }).then(() => {
                    this.isSaving = false;
                });
            } else {
                axios.post(
                    '/api/server',
                    {"name":this.server.name,
                     "ip":this.server.ip}
                ).catch(error => {
                    this.errors = error.response.data.errors;
                }).then(() => {
                    this.isSaving = false;
                });
            }
        },
        deleteServer() {
            this.isDeleting = true;
            axios.delete(
                '/api/server/'+this.server.id,
                {}
            ).then(response => {
                this.toggleModal();
                this.isDeleting = false;
            });
        }
    },
    created: function() {
        this.$root.$on('server-clicked', (server) => {
            this.server = server;
            this.toggleModal();
            this.title=server.name;
        });
    },
}
</script>

<style>
    .margin-top-4 {
        margin-top:1.5rem;
    }
</style>
