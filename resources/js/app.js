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
            console.log(data)
            // this.$refs.tickets.appendChild(<ticket ticket="data.ticket" asker="data.asker"></ticket>)
        }
    }
});

require('./bootstrap');

import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

let section = $("#tickets");
window.Echo.channel("waitinglist_database_ticket")
.listen("TicketEvent", (data) => { 
    app.tickets.push(data.update[0])
    // for (let ticket of data.update) {
    //     let div = $("<div></div>");
    //     div.append("<hr />");
    //     div.attr("data-id", ticket.id);
    //     {
    //         let user = $("<p></p>");
    //         user.text(ticket.user);
    //         div.append(user);
    //     }
    //     {
    //         let title = $("<h2></h2>");
    //         {
    //             let a = $("<a></a>");
    //             a.attr('href', "/ticket/" + ticket.id + "/");
    //             a.text(ticket.title);
    //             title.append(a);
    //         }
    //         div.append(title);
    //     }
    //     {
    //         let description = $("<pre></pre>");
    //         description.text(ticket.description);
    //         div.append(description);
    //     }
    //     {
    //         let take = $("<button>/button>");
    //         take.text("Prendre");
    //         div.append(take);
    //     }

    //     let old = section.find('[data-id="'+ticket.id+'"]');
        
    //     if (old.length) {
    //         old.replaceWith(div);
    //     } else {
    //         section.prepend(div);
    //     }
    // }
    // for (let ticket of data.remove) {
    //     let old = section.find('[data-id="'+ticket.id+'"]');
        
    //     if (old.length) {
    //         old.remove();
    //     }
    // }
});