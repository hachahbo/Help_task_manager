import { reactive } from "vue";
import { usePage } from '@inertiajs/vue3';

// Access Inertia props
// const page = usePage();

// // Watch for changes in the Inertia props
// add(page.props.toast)
// watch(() => page.props, (newProps) => {
//     console.log(page.props.flash.greet)
//     add(page.props.flash.greet)
//     })
export default reactive({
    items : [
        // { id: 1, message: "Set yourself" },
        // { id: 2, message: "This is a notification" },
        // { id: 1, message: `Welcom to MyTickets ` },
    ],
    add(toast){
        this.items.unshift(
            {
                key: Symbol(),
                ...toast
            }
        );
    },
    remove(index)
    {
        this.items.splice(index, 1);
    }
})