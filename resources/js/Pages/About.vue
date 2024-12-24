<script setup>
    defineProps({
        user: String
    })
</script>

<template>
    <Head title=" | About" />
    <div>
        <h1 class="text-3xl font-bold underline">
            About page {{ user }}
        </h1>
    </div>
</template>
<script setup lang="ts">
</script>
