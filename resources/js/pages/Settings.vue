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
    
    

    function enableEdit(user) {
    user.isEditing = true; // Enable editing mode
    user.showDelete = true; // Show the delete button
    user.updatedRole = user.role; // Initialize with current role
}

function cancelEdit(user) {
    user.isEditing = false; // Disable editing mode
    user.showDelete = false; // Hide delete button
    user.updatedRole = user.role; // Revert to the original role
}

const deleteUser = (user) => {
    if (confirm(`Are you sure you want to delete user ${user.name}?`)) {
        router.delete(`/users/${user.id}`, {
            onSuccess: () => {
                alert('User deleted successfully.');
            },
            onError: (errors) => {
                console.error(errors);
            },
        });
    }
};

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
    <div class="lg:ml-64  xl:ml-48 2xl:ml-28">
        <h1 class="title"> 
            <div class="p-4 ">
                <div class="flex justify-end mb-2 ">
                    <input type="search" v-model="search" class="h-8 w-[200px]" placeholder="Search" />
                </div>

                <table class=" w-12/12">
                    <thead>
                        <tr class="text-white font-extrabold  shadow-lg">
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody class="bg-[#24303f] text-white">
                        <tr class=" hover:rounded-lg" v-for="user in users.data" :key="user.id">
                            <td>
                                <img class="w-12 h-12 rounded-full mr-3" src="./Frame.png" alt="Neil image" />
                            </td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>
    <!-- Conditional rendering for Edit/Delete buttons -->
    <div>
        <template v-if="user.isEditing">
            <!-- Role Selection -->
            <select
                v-model="user.updatedRole"
                class="mt-2 block p-2 w-36 text-white bg-[#1d2a39] rounded-md shadow-sm"
            >
                <option value="admin">Admin</option>
                <option value="technicien">Technicien</option>
                <option value="user">User</option>
            </select>
            
            <!-- Confirm Role Change -->
            <button
                @click="confirmRoleChange(user)"
                class="bg-blue-500 mt-2 mr-1 text-white px-3 py-1 rounded-md shadow-sm hover:bg-blue-700"
            >
                Confirm
            </button>

            <!-- Cancel Edit -->
            <button
                @click="cancelEdit(user)"
                class="bg-gray-500 mt-2 text-white px-3 py-1 rounded-md shadow-sm hover:bg-gray-700"
            >
                Cancel
            </button>

        </template> 
        <!-- Edit Button (shown when not editing) -->
        <div v-else>
            {{user.role}}
    </div>
    </div>
</td>
<td >
    <div v-if="user.role !== 'admin'">
        <button v-if=" !user.isEditing " @click="enableEdit(user)" class="bg-gray-600 text-white px-3 py-1 rounded-md shadow-sm hover:bg-blue-700">
            Edit
        </button>
        <button v-else-if="user.isEditing"
                    @click="deleteUser(user)"
                    class="bg-red-600 mt-2 text-white px-3 py-1 rounded-md shadow-sm hover:bg-red-800"
                >
                    Delete
                </button>

    </div>
    <!-- <button 
            v-else 
            @click="deleteUser(user)" 
            class="bg-red-600 text-white px-3 py-1 rounded-md shadow-sm hover:bg-red-800"
        >
            Delete
        </button> -->
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
