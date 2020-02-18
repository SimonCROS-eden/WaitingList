import Echo from 'laravel-echo';
import Axios from 'axios';
import Push from 'push.js';

var changes = 0;
var blured = false;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Push.Permission.request(() => {
    console.log("Notifications activées");
}, () => {
    console.log("Notifications désactivées");
});

const app = new Vue({
    el: '#app',
    data: {
        tickets: [],
        users: []
    },
    computed: {
        orderedUsers: function () {
            return _.orderBy(this.users, 'score', 'desc');
        }
    },
    methods: {
        addTicket(data) {
            this.tickets.unshift(data);
            if (blured) {
                changes++;
                document.title = "(" + changes + ") WaitingList";
                Push.create(data.title, {
                    body: data.asker.first_name + " " + data.asker.last_name,
                    icon: '/images/icon.svg',
                    timeout: 5000,
                    onClick: function () {
                        window.focus();
                        this.close();
                    }
                });
            }
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
        removeTicket(id) {
            for (let ticket of this.tickets) {
                if (ticket.id == id) {
                    this.$delete(this.tickets, this.tickets.indexOf(ticket));
                    return;
                }
            }
        },
        addUser(data) {
            this.users.unshift(data);
        },
        updateUser(data) {
            for (let user of this.users) {                
                if (user.id == data.id) {                    
                    Vue.set(this.users, this.users.indexOf(user), data);
                    return;
                }
            }
            this.addUser(data);
        },
    }
});

$(".tags").click(function () {
    $(this).toggle();
    $(this).siblings().toggle();
});

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
});
let section = $("#tickets");

window.Echo.channel("ticket")
.listen(".ticket.update", (data) => {
    if (data.update) {
        app.updateTicket(data.update);
    }
    if (data.remove) {
        app.removeTicket(data.remove);
    }
});

axios.post("/data", {}).then(function (response) {
    app.tickets = response.data.tickets;
    app.users = response.data.users;
});

if (document.querySelector('meta[name="admin"]').getAttribute('content') != 0) {
    window.Echo.private("user.admin")
    .listen("AdminUserEvent", (data) => {             
        app.updateUser(data.user);
    });
} else {
    window.Echo.private("user.guest")
    .listen("UserEvent", (data) => {
        app.updateUser(data.user);
    });
}

$(window).focus(function() {
    document.title = "WaitingList";
    blured = false;
    changes = 0;
});

$(window).blur(function() {
    blured = true;
});