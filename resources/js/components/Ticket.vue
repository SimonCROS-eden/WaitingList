<template>
    <div :data-id="ticket.id">
        
        <div class="border-top d-flex flex-column flex-md-row justify-content-between py-4 px-2" :class="ticket.helper ? 'bg-muted' : ''">

            <div class="d-flex flex-column p-0 col-md-6 ">
                <p class="mb-2 text-muted">{{ ticket.asker.first_name + " " + ticket.asker.last_name }}</p>
                <h2 class="mb-2"><a :class="ticket.helper ? 'text-muted' : ''" :href="'/ticket/' + ticket.id + '/'">{{ ticket.title }}</a></h2>
                <p class="text">{{ ticket.shortDesc }}</p>
                <div class="flex mb-2">
                    <div v-for="(tag, index) in ticket.tags" :key="index" :style="'background-color: ' + tag.color" class="badge mr-1 py-2 px-3 text-white">{{ tag.name }}</div>
                </div>
                
            </div>
            
            
            <div class="d-flex flex-row mt-2 mt-md-0">
                <div class="d-flex flex-wrap flex-row flex-md-row-reverse">
                    <form class="mr-2 mr-md-0 ml-md-2" @submit.prevent="onSubmit" v-if="(!ticket.helper || update_take()) && isOwner()" :action="'/ticket/' + ticket.id" method="post">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-primary" type="submit">
                            Supprimer
                        </button>
                    </form>
                    <template v-else-if="isOwner()">
                        <form class="" @submit.prevent="onSubmit" :action="'/ticket/' + ticket.id + '/end'" method="post">
                            <input type="hidden" name="_token" :value="csrf">
                            <button class="btn btn-primary" type="submit">
                                Finir
                            </button>
                        </form>
                        <form class="mr-2 ml-2" @submit.prevent="onSubmit" :action="'/ticket/' + ticket.id + '/renew'" method="post">
                            <input type="hidden" name="_token" :value="csrf">
                            <button class="btn btn-primary" type="submit">
                                Renouveller
                            </button>
                        </form>
                    </template>
                
                    <form class="" @submit.prevent="onSubmit" :action="'/ticket/' + ticket.id + '/take'" method="post">
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="_method" value="PUT">
                        <button class="btn btn-primary" v-if="!ticket.helper" type="submit" >
                            {{ update_take_maker() ? 'Pause' : 'Prendre' }}
                        </button>
                        <button class="btn btn-primary" v-else-if="update_take()" type="submit">
                            {{ update_take_maker() ? 'Continue' : 'Abandonner' }}
                        </button>
                        <template v-else>
                            <p class="text-primary mt-2 h5">
                                {{ ticket.ask_id === ticket.help_id ? "Le ticket est mit en pause ..." : "Pris par : " + ticket.helper.first_name + " " + ticket.helper.last_name }}
                            </p>
                        </template>
                    </form>
                </div>
            </div>
            
        </div>
        
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
        },
    }
</script>
