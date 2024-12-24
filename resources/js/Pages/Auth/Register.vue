<script setup>
import {useForm} from '@inertiajs/vue3'
import TextInput from "../../Components/TextInput.vue";

const form = useForm({
    avatar: null,
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    preview: null
})
const changeAvatar = (e) => {
    form.avatar = e.target.files[0];
    form.preview = URL.createObjectURL(e.target.files[0]);
}

const submit = () => {
    form.post(route('register'), {
        onError: () => form.reset('password', 'password_confirmation')
    })
}
</script>

<template>
    <Head :title="` | ${$page.component}`"/>
    <h1 class="text-3xl font-bold underline">Register
    </h1>

    <form @submit.prevent="submit">
        <div class="grid place-items-center">
            <div class="relative w-28 h-28 rounded-full overflow-hidden border border-slate-300">
                <label for="avatar" class="absolute inset-0 grid content-end cursor-pointer">
                    <span class="bg-white/70 pb-2 text-center">Avatar</span>
                </label>
                <input type="file" id="avatar" @input="changeAvatar"/>
                <img class="object-cover w-28 h-28" :src="form.preview ?? 'storage/avatars/default.jpeg'" alt=""/>
                <small class="error">{{ form.errors.avatar }}</small>
            </div>
        </div>
        <TextInput name="name" v-model="form.name" :message="form.errors.name"/>
        <TextInput name="email" type="email" v-model="form.email" :message="form.errors.email"/>
        <TextInput name="password" type="password" v-model="form.password" :message="form.errors.password"/>
        <TextInput name="password_confirmation" type="password" v-model="form.password_confirmation"/>
        <div>
            <p class="text-slate-600 mb-2">Already a user?
                <Link :href="route('login')" class="text-link">Login</Link>
            </p>
            <button class="primary-btn" :disabled="form.processing">Register</button>
        </div>
    </form>
</template>

