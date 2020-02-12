<template>
    <div :data-id="ticket.id">
        <hr>
        <p>{{ ticket.asker.first_name + " " + ticket.asker.last_name }}</p>
        <h2><a :href="'/ticket/' + ticket.id + '/'">{{ ticket.title }}</a></h2>
        <pre>{{ ticket.desc }}</pre>
        <button>Prendre</button>
    </div>
</template>

<script>
    export default {
        props: ['ticket'],
    }
</script>
