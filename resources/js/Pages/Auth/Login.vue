<script setup>
import {useForm} from '@inertiajs/vue3'
import TextInput from "../../Components/TextInput.vue";

const form = useForm({
    email: null,
    password: null,
    remember: null,
})

const submit = () => {
    form.post(route('login'), {
        onError: () => form.reset('password')
    })
}
</script>

<template>
    <Head :title="` | ${$page.component}`"/>
    <h1 class="text-3xl font-bold underline">Login
    </h1>

    <form @submit.prevent="submit">
        <TextInput name="email" type="email" v-model="form.email" :message="form.errors.email"/>
        <TextInput name="password" type="password" v-model="form.password" :message="form.errors.password"/>

        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center gap-2">
                <label>Remember me</label>
                <input type="checkbox" v-model="form.remember" id="remember"/>
            </div>
            <div class="text-slate-600 mb-2">
                <p class="text-slate-600 mb-2">Need a account?
                    <Link :href="route('register')" class="text-link">Register</Link>
                </p>
                <button class="primary-btn" :disabled="form.processing">Login</button>
            </div>
        </div>
    </form>
</template>

