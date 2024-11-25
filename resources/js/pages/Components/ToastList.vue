<script setup>
import ToastListItem from './ToastListItem.vue';
import { onMounted, ref, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';
import toast from '../stores/toast';

// Access Inertia props
const page = usePage();

// Watch for changes in the Inertia props
watch(() => page.props, (newProps) => {
    // if(newProps.flash.greet)
    // {
    //     items.value.unshift({
    //         id: Date.now(), // Unique ID
    //         message: newProps.flash.greet,
    //     });
    //     console.log(newProps.flash.greet)
    //     console.log(newProps.items)

    // }
    if (newProps.toast) {
        // Add the new toast message at the beginning of the items array
        toast.add({
            message: newProps.toast,
        });
    }
});




function remove(index) {
    toast.remove(index);
}
</script>

<template>
    <div>
        <TransitionGroup
            tag="div"
            enter-from-class="translate-x-full opacity-0"
            enter-active-class="duration-500"
            leave-active-class="duration-500"
            leave-to-class="translate-x-full opacity-0"
            class="fixed top-4 right-4 z-50 space-y-4 w-full max-w-xs"
        >
            <ToastListItem 
                v-for="(item, index) in toast.items"
                :key="item.key" 
                :message="item.message"
                @remove="remove(index)"
            />
        </TransitionGroup>
    </div>
</template>

