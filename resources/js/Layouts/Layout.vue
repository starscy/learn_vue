<script setup>

</script>

<template>
    <Head title="Vue">
        <meta head-key="description" name="description" content="This is default description">
    </Head>
    <div>
        <header class="bg-indigo-500 text-white">
            <nav class="flex items-center justify-between p-4 max-w-screen-lg">
                <div class="flex items-center">
                <span class="nav-link"
                      v-if="$page.props.auth.user"
                >{{ $page.props.auth.user?.name }}</span>
                    <img v-if="$page.props.auth.user"
                         :src="$page.props.auth.user.avatar ?
                                ('storage/' + $page.props.auth.user.avatar) :
                              'storage/avatars/default.jpeg'"
                         alt=""
                         width="40px"
                         height="40px"
                         class="mr-6"
                    />

                    <div class="space-x-6">
                        <Link
                            :href="route('home')"
                            class="nav-link"
                            :class="{'bg-slate-700' : $page.component === 'Home'}"
                        >Home
                        </Link>
                        <Link
                            :href="route('about')"
                            class="nav-link"
                            :class="{'bg-slate-700' : $page.component === 'About'}"
                        >About
                        </Link>
                    </div>
                </div>
                <div v-if="$page.props.auth.user" class="space-x-6">
                    <Link
                        :href="route('dashboard')"
                        class="nav-link"
                        :class="{'bg-slate-700' : $page.component === 'Dashboard'}"
                    >Dashboard
                    </Link>
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        type="button"
                        class="nav-link"
                    >Logout
                    </Link>
                </div>
                <div v-else class="space-x-6">
                    <Link
                        :href="route('register')"
                        class="nav-link"
                        :class="{'bg-slate-700' : $page.component === 'Auth/Register'}"
                    >Register
                    </Link>
                    <Link
                        :href="route('login')"
                        class="nav-link"
                        :class="{'bg-slate-700' : $page.component === 'Auth/Login'}"
                    >Login
                    </Link>
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
