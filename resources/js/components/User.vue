<template>
    <div class="d-flex align-items-center justify-content-between">
        <span class="mr-2">{{ name }}</span>
        <div class="h5 m-0 d-flex no-wrap">
            <span :class="'badge ' + (score >= 0 ? 'badge-success' : 'badge-danger')"><span class="mr-2">↑↓</span>{{ score }}</span> 
            <span v-if="admin" class="ml-2 badge badge-primary"><span class="mr-2">?</span>{{ ask }}</span> 
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'name',
            'score',
            'ask',
            'admin'
        ]
    }
</script>