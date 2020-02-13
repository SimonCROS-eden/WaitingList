<template>
    <div :data-id="ticket.id">
        <hr>
        <p>{{ ticket.asker.first_name + " " + ticket.asker.last_name }}</p>
        <h2><a :href="'/ticket/' + ticket.id + '/'">{{ ticket.title }}</a></h2>
        <pre>{{ ticket.desc }}</pre>

        <form v-if="(!ticket.helper || update_take()) && isOwner()" :action="'/ticket/' + ticket.id" method="post">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit">
                Supprimer
            </button>
        </form>
        <template v-else-if="isOwner()">
            <form :action="'/ticket/' + ticket.id + '/end'" method="post">
                <input type="hidden" name="_token" :value="csrf">
                <button type="submit">
                    Finir
                </button>
            </form>
            <form :action="'/ticket/' + ticket.id + '/renew'" method="post">
                <input type="hidden" name="_token" :value="csrf">
                <button type="submit">
                    Renouveller
                </button>
            </form>
        </template>

        <form :action="'/ticket/' + ticket.id + '/take'" method="post">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="_method" value="PUT">

            <button v-if="!ticket.helper" type="submit" >
                {{ update_take_maker() ? 'Pause' : 'Prendre' }}
            </button>
            <button v-else-if="update_take()" type="submit">
                {{ update_take_maker() ? 'Continue' : 'Abandonner' }}
            </button>
            <template v-else>
                {{ ticket.ask_id === ticket.help_id ? "Le ticket est mit en pause ..." : "Pris par : " + ticket.helper.first_name + " " + ticket.helper.last_name }}
            </template>
        </form>
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
            }
        }
    }
</script>
