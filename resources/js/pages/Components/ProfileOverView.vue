<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';



const page = usePage();
const user = page.props?.auth?.user || null; // Use optional chaining
console.log(user);
// Log the user objec
// const user = page.props.value.auth.user; // Access the user object
// console.log(user):

const isDropdownOpen = ref(false);

function toggleDropdown() {
  isDropdownOpen.value = !isDropdownOpen.value;
}

function closeDropdown(event) {
  const menu = document.getElementById('dropdown-menu');
  const button = document.getElementById('menu-button');

  if (!menu.contains(event.target) && !button.contains(event.target)) {
    isDropdownOpen.value = false;
  }
}

// Close dropdown when clicking outside
onMounted(() => {
  document.addEventListener('click', closeDropdown);
});

onUnmounted(() => {
  document.removeEventListener('click', closeDropdown);
});
</script>

<template>
  <div class="relative inline-block text-left">
    <div>
      <button 
        type="button" 
        class="inline-flex w-full justify-center text-white gap-x-1.5 rounded-md  px-3 py-2 text-sm font-semibold hover:text-gray-900 shadow-sm ring-1 ring-inset ring-gray-600 hover:ring-gray-200 hover:bg-gray-200" 
        id="menu-button" 
        :aria-expanded="isDropdownOpen.toString()" 
        aria-haspopup="true"
        @click="toggleDropdown">
        More
        <svg class="-mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
        </svg>
      </button>
    </div>

    <div 
      id="dropdown-menu" 
      class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md text-white bg-gray-800 shadow-lg ring-1 ring-black/5 focus:outline-none"
      role="menu" 
      aria-orientation="vertical" 
      aria-labelledby="menu-button" 
      tabindex="-1"
      v-show="isDropdownOpen">
      <div class="py-1" role="none">
        <div class="p-4 py-2 flex">
            <img
                class="w-14 h-14  rounded-full mr-3"
                src="../Frame.png"
            />
            <div>
                <h1 class=" font-semibold ">{{user.name}}</h1>
                <h4 class=" font-medium text-gray-300 text-xs p-0">{{user.email}}</h4>
                <h4 class=" font-medium text-gray-300 text-xs  p-0">{{user.role}}

                    <span v-if="user.techgategory" class=" font-medium text-gray-300 text-xs  p-0"> - {{user.techgategory}}</span>
                </h4>

            </div>
        </div>
        <div class="mx-5 border-t "></div>
        <div class="p-4">
            <Link method="post" :href="route('logout')" class="flex items-center p-2 text-white rounded-lg dark:text-white  hover:bg-gray-500 dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3"/>
                </svg>
                <Link class="ml-2 font-semibold"  method="post" :href="route('logout')">Logout</Link>
            </Link>
        </div>
      </div>
    </div>
  </div>
</template>
