<script setup>
import demo from "../Layouts/demo.vue";
import PaginationLinks from "../Components/PaginationLinks.vue";
import {ref,  watch} from "vue";
import {router} from "@inertiajs/vue3";
import {debounce, throttle} from "lodash";


defineOptions({
    layout: demo,
})

const props = defineProps({
    users: Object,
    searchTerm: String,
    can: Object
})

const search = ref(props.searchTerm);

// watch(search, (value)=> router.get(route('home'), {
//     search: value
// }, {preserveState: true}))
watch(search, debounce((value)=> router.get(route('home'), {
    search: value
}, {preserveState: true}), 100))

const getDate = (date) => new Date(date).toLocaleDateString("ru" , {
    year: "numeric",
    month: "long",
    day: "numeric"
});
</script>

<template>
    <Head :title="` | ${$page.component}`">
        <meta head-key="description" name="description" content="This is home description">
    </Head>
    <div>
        <h1 class="text-3xl font-bold underline">
            Hello world!
        </h1>

        <div class="flex justify-end mb-4">
            <div class="w-1/4">
                <input type="search" placeholder="Search" v-model="search">
            </div>
        </div>

            <table class="w-[100%]">
                <thead>
                <tr class="bg-slate-300">
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registration Date</th>
                    <th v-if="can.delete_user">Delete</th>
                </tr>
                </thead>

                <tbody>
                <tr class="text-center"
                    v-for="user in users.data"
                    :key="user.id"
                >
                    <td>
                        <img :src="user.avatar ? ('storage/' + user.avatar) : 'storage/avatars/default.jpeg'" class="w-40 h-40"/>
                    </td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ getDate(user.created_at) }}</td>
                    <td>
                        <button  v-if="can.delete_user"
                                 class="bg-red-500 w-6 h-6 rounded-full" />
                    </td>
                </tr>
                </tbody>
            </table>

            <!-- pagination links-->
            <PaginationLinks :paginator="users"/>


        <Link class="mt-[1400px] block" :href="route('home')" preserve-scroll>Refresh</Link>
    </div>

</template>

