<script setup>
    defineProps({
        user: String
    })
</script>

<template>
    <Head title=" | Dashboard" />
    <div>
        <p class="p-4  bg-green-200">{{ $page.props.flash.greeting }}</p>
        <h1 class="text-3xl font-bold underline">
            Welcome back {{ $page.props.auth.user.name }}
        </h1>
    </div>
</template>
<script setup lang="ts">
</script>
