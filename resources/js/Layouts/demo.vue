<template>
    <div>
        <header class="bg-green-500 text-white">
            <nav class="flex items-center justify-between p-4 max-w-screen-lg">
                <div class="space-x-6">
                    <span class="nav-link">{{ $page.props.auth.user ? $page.props.auth.user?.name : "" }}</span>
                    <Link
                        :href="route('home')"
                        class="nav-link"
                        :class="{'bg-slate-700' : $page.component === 'Home'}"
                    >Home</Link>
                    <Link
                        :href="route('about')"
                        class="nav-link"
                        :class="{'bg-slate-700' : $page.component === 'About'}"
                    >About</Link>
                </div>
                <div v-if="$page.props.auth.user" class="space-x-6">
                    <Link
                        :href="route('dashboard')"
                        class="nav-link"
                        :class="{'bg-slate-700' : $page.component === 'Dashboard'}"
                    >Dashboard</Link>
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        type="button"
                        class="nav-link"
                    >Logout</Link>
                </div>
                <div v-else class="space-x-6">
                    <Link
                        :href="route('register')"
                        class="nav-link"
                        :class="{'bg-slate-700' : $page.component === 'Auth/Register'}"
                    >Register</Link>
                    <Link
                        :href="route('login')"
                        class="nav-link"
                        :class="{'bg-slate-700' : $page.component === 'Auth/Login'}"
                    >Login</Link>
                </div>
            </nav>
        </header>
        <main class="p-4">
            <slot/>
        </main>
    </div>
</template>
<script setup lang="ts">
</script>
