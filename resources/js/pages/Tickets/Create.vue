<template>
    <div class="max-w-2xl mx-auto bg-[#24303f] p-5 rounded sm:ml-64">
        <h1 class="text-xl font-semibold text-white mb-4">Create Ticket</h1>
        <form @submit.prevent="submit">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-400">Title</label>
                <input
                    v-model="form.title"
                    type="text"
                    id="title"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required
                />
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-400">Description</label>
                <textarea
                    v-model="form.description"
                    id="description"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                ></textarea>
            </div>

            <div class="mb-4">
                <label for="priority" class="block text-sm font-medium text-gray-400">Priority</label>
                <select
                    v-model="form.priority"
                    id="priority"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required
                >
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-sm font-medium text-gray-400">Category</label>
                <select
                    v-model="form.category_id"
                    id="category_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                    required
                >
                    <option value="1">Bug</option>
                    <option value="2">Feature Request</option>
                    <option value="3">Support</option>
                </select>
            </div>

            <button
                type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
            >
                Submit Ticket
            </button>
        </form>
    </div>
</template>

<script>
import { useForm } from '@inertiajs/vue3';

export default {
    setup() {
        const form = useForm({
            title: "",
            description: "",
            priority: "low",
            category_id: 1, // Default category
        });

        const submit = () => {
            form.post(route("tickets.store"));
        };

        return { form, submit };
    },
};
</script>
