<template>
    <div :data-id="ticket.id">
        <div class="d-flex justify-content-between mb-3">
            <div class="d-flex align-items-baseline">
                <p class="mb-0 mr-4">{{ ticket.asker.first_name + " " + ticket.asker.last_name }}</p>
                <h2 class="mb-0"><a :href="'/ticket/' + ticket.id + '/'">{{ ticket.title }}</a></h2>
            </div>
            <div class="d-flex flex-row-reverse align-self-center">
                <form class="ml-2" @submit.prevent="onSubmit" v-if="(!ticket.helper || update_take()) && isOwner()" :action="'/ticket/' + ticket.id" method="post">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="btn btn-primary" type="submit">
                        Supprimer
                    </button>
                </form>
                <template v-else-if="isOwner()">
                    <form @submit.prevent="onSubmit" :action="'/ticket/' + ticket.id + '/end'" method="post">
                        <input type="hidden" name="_token" :value="csrf">
                        <button class="btn btn-primary" type="submit">
                            Finir
                        </button>
                    </form>
                    <form @submit.prevent="onSubmit" :action="'/ticket/' + ticket.id + '/renew'" method="post">
                        <input type="hidden" name="_token" :value="csrf">
                        <button class="btn btn-primary" type="submit">
                            Renouveller
                        </button>
                    </form>
                </template>

                <form @submit.prevent="onSubmit" :action="'/ticket/' + ticket.id + '/take'" method="post">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" name="_method" value="PUT">

                    <button class="btn btn-primary" v-if="!ticket.helper" type="submit" >
                        {{ update_take_maker() ? 'Pause' : 'Prendre' }}
                    </button>
                    <button class="btn btn-primary" v-else-if="update_take()" type="submit">
                        {{ update_take_maker() ? 'Continue' : 'Abandonner' }}
                    </button>
                    <template v-else>
                        {{ ticket.ask_id === ticket.help_id ? "Le ticket est mit en pause ..." : "Pris par : " + ticket.helper.first_name + " " + ticket.helper.last_name }}
                    </template>
                </form>
            </div>
        </div>
        <pre>{{ ticket.desc }}</pre>
        <ul>
            <li v-for="(tag, index) in ticket.tags" :key="index" :style="'background-color: ' + tag.color">{{ tag.name }}</li>
        </ul>
        <hr />
    </div>
</template>

<script>
    export default {
        props: ['ticket'],
        data: () => ({
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            admin: document.querySelector('meta[name="admin"]').getAttribute('content'),
            id: document.querySelector('meta[name="id"]').getAttribute('content'),
        }),
        methods: {
            update_take() {                                
                return this.id == this.ticket.help_id || !this.admin;
            },
            update_take_maker() {
                return this.id == this.ticket.ask_id;
            },
            isOwner() {
                return this.id == this.ticket.ask_id;
            },
            onSubmit: function(e) {
                axios.post(e.target.action, $(e.target).serialize())
            }
        }
    }
</script>
