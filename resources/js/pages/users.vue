<script setup>
    import { ref, watch } from "vue";
    import { router } from "@inertiajs/vue3";
    import { useForm } from '@inertiajs/vue3';
    import { debounce } from "lodash";
    import { usePage } from '@inertiajs/vue3';

    // Props definition
    defineProps({
        users: Object,
        searchTerm: String,
        can: Object,
    });

    const search = ref("");
    watch(search, debounce((q) => router.get('/users', { search: q }, { preserveState: true }), 500));

    const form = useForm({});

    // Function to handle the role change confirmation
    const confirmRoleChange = (user) => {
        if (!user.updatedRole) {
            alert('Please select a role before confirming.');
            return;
        }

        // Send the role update to the backend using Inertia.js
        router.put(`/users/${user.id}/update-role`, { role: user.updatedRole }, {
            onSuccess: () => {
            },
            onError: (errors) => {
                console.error(errors);
            },
        });
    };
</script>

<template>
    <div class="sm:ml-64">
        <h1 class="title"> 
            <div class="p-4 ">
                <div class="flex justify-end mb-2 ">
                    <input type="search" v-model="search" class="h-8 w-[200px]" placeholder="Search" />
                </div>

                <table class="">
                    <thead>
                        <tr class="text-white font-extrabold bg-[#1d2631] shadow-lg">
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th v-if="can.delete_user">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#24303f] text-white">
                        <tr class="hover:text-gray-500 hover:rounded-lg" v-for="user in users.data" :key="user.id">
                            <td>
                                <img class="w-12 h-12 rounded-full mr-3" src="./Frame.png" alt="Neil image" />
                            </td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>
                                <select
                                    v-model="user.updatedRole" 
                                    class="mt-6 block p-2 w-36 text-white bg-[#1d2a39] rounded-md shadow-sm"
                                >
                                    <option value="admin" :selected="user.updatedRole === 'admin'">Admin</option>
                                    <option value="user" :selected="user.updatedRole === 'user'">User</option>
                                </select>
                                <button 
                                    @click="confirmRoleChange(user)"
                                    class="bg-blue-500 text-white px-3 py-1 rounded-md shadow-sm hover:bg-blue-700"
                                >
                                    Confirm
                                </button>
                            </td>
                            <td v-if="can.delete_user">
                                <button>Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="flex w-full justify-end items-end">
                    <Link 
                        v-for="link in users.links" 
                        :key="link.label"
                        v-html="link.label"
                        :href="link.url"
                        preserve-scroll
                        class="text-base bg-[#24303f] rounded-md text-right p-1 px-3 mx-1"
                        :class="{ 'text-[#37475c]': !link.url, 'bg-[#576479]': link.active }"
                    />
                </div>
            </div>
        </h1>
    </div>
</template>
