/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        tickets: []
    },
    methods: {
        test() {
            console.log('ok');
        },
        addTicket(data) {
            this.tickets.unshift(data);
            console.log(this.tickets);
        },
        updateTicket(data) {
            for (let ticket of this.tickets) {
                if (ticket.id == data.id) {                    
                    Vue.set(this.tickets, this.tickets.indexOf(ticket), data);
                    return;
                }
            }
            this.addTicket(data);
        },
        removeTicket(data) {
            for (let ticket of this.tickets) {
                if (ticket.id == data.id) {
                    this.$delete(this.tickets, this.tickets.indexOf(ticket));
                    console.log(this.tickets);
                    
                    return;
                }
            }
        }
    }
});

$(".tags").click(function () {
    $(this).toggle();
    $(this).siblings().toggle();
});

require('./bootstrap');

import Echo from 'laravel-echo';
import Axios from 'axios';

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

let section = $("#tickets");
window.Echo.channel("waitinglist_database_ticket")
.listen("TicketEvent", (data) => { 
    if (data.update) {
        app.updateTicket(data.update);
    }
    if (data.remove) {
        app.removeTicket(data.remove);
    }
});

axios.post("/data", {}).then(function (response) {
    app.tickets = response.data;
});