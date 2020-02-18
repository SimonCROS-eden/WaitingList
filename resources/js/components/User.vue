<template>
    <div class="d-flex align-items-center justify-content-between">
        <span class="mr-2">{{ user.name }}</span>
        <div class="h5 m-0 d-flex no-wrap">
            <span :class="'badge arrows' + (user.score >= 0 ? 'badge-success' : 'badge-danger')"><span class="mr-2">↑↓</span>{{ user.score }}</span> 
            <span v-if="admin && user.ask != null" class="ml-2 badge badge-primary"><span class="mr-2">?</span>{{ user.ask }}</span> 
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data: () => ({
            admin: document.querySelector('meta[name="admin"]').getAttribute('content'),
        })
    }
</script>