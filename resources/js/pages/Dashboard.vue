<script setup>

import { Link } from '@inertiajs/vue3';
import {ref, watch} from "vue";
import {router} from "@inertiajs/vue3";
import { debounce} from "lodash"
defineProps(
    {
        users:Object,
        searchTerm: String,
        can: Object,
    }
);
const getDate = (date) =>
    new Date(date).toLocaleDateString("en-us",
        {
            year: "numeric",
            month: "long",
            day: "numeric",
        }
    );
    const search = ref("");
    watch(search, debounce((q)=> router.get('/dashboard', {search: q}, {preserveState:true}), 500))
</script>
<template>
    <div>
        <h1 class="title"> 
            <div class="p-4 sm:ml-64">
   <div class="p-4  border-gray-200 border-dashed rounded-lg dark:border-gray-700
   ">
   <div class="relative mb-10">
        <div class="absolute flex items-center right-0 top-1/4 transform -translate-y-1/4">
            <Link
            :href="route('tickets.create')"
                class="flex items-center p-1.5 text-white rounded-lg dark:text-white hover:bg-gray-500 dark:hover:bg-gray-700 group">
                <svg fill="white" class="text-gray-500 transition duration-75 dark:text-gray-400  group-hover:text-gray-900 dark:group-hover:text-white" width="20px" height="20px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><title>ionicons-v5-n</title><path d="M459.94,53.25a16.06,16.06,0,0,0-23.22-.56L424.35,65a8,8,0,0,0,0,11.31l11.34,11.32a8,8,0,0,0,11.34,0l12.06-12C465.19,69.54,465.76,59.62,459.94,53.25Z"/><path d="M399.34,90,218.82,270.2a9,9,0,0,0-2.31,3.93L208.16,299a3.91,3.91,0,0,0,4.86,4.86l24.85-8.35a9,9,0,0,0,3.93-2.31L422,112.66A9,9,0,0,0,422,100L412.05,90A9,9,0,0,0,399.34,90Z"/><path d="M386.34,193.66,264.45,315.79A41.08,41.08,0,0,1,247.58,326l-25.9,8.67a35.92,35.92,0,0,1-44.33-44.33l8.67-25.9a41.08,41.08,0,0,1,10.19-16.87L318.34,125.66A8,8,0,0,0,312.69,112H104a56,56,0,0,0-56,56V408a56,56,0,0,0,56,56H344a56,56,0,0,0,56-56V199.31A8,8,0,0,0,386.34,193.66Z"/></svg>
                <span class="ml-1 font-semibold text-base">Create</span>
            </Link>
        </div>
   </div>
   <div class="border  border-gray-700 border-b-0 ">
   </div>
   <div class="border border-gray-700 border-b-0 "></div>
   <h1 class="text-left my-2 text-xl text-gray-200">Status's Tickets</h1>
   <div class="grid grid-cols-3 gap-4 mb-4">
       <div class="flex items-center justify-center gap-4 h-24 rounded bg-[#24303f] dark:bg-gray-800">
           <div class="gap-6">
                <p class=" text-lg text-left " >Pending</p>
                <h1 class="mt-1" >45 <span class="text-base text-gray-400">Tickets</span></h1>
            </div> 
            <div class="bg-[#313d4a] p-1 rounded-full">
                <svg fill="white" class="w-6 h-6"
                 xmlns="http://www.w3.org/2000/svg"><path d="m11.7 2c-.1 0-.1 0-.2 0 0 0 0 0-.1 0-.2 0-.3 0-.5 0l.2 2h1.3c4 .3 7.3 3.5 7.5 7.6.2 4.4-3.2 8.2-7.6 8.4 0 0-.1 0-.2 0-.3 0-.7 0-1 0l-.1 2h1.3.4c5.4-.4 9.5-5 9.3-10.4-.2-5.1-4.3-9.1-9.3-9.5-.2 0-.3 0-.5 0-.2-.1-.3-.1-.5-.1zm-3.5.7c-.5.3-1 .5-1.5.8l1.1 1.7c.3-.2.7-.4 1.1-.6zm-3.7 2.7c-.4.4-.7.9-1 1.3l1.7 1c.2-.3.5-.6.8-1zm10.9 3-4.6 5.2-2.7-2.1-1.1 1.7 4.2 3.2 5.8-6.6zm-13 .6c-.2.5-.3 1.1-.3 1.6l2 .3c.1-.4.1-.9.3-1.3zm1.7 4-2 .2v.3c.1.4.2.9.3 1.3l1.9-.6c-.1-.3-.2-.7-.2-1.1zm1.1 3.2-1.7 1.1c.3.5.6.9 1 1.3l1.5-1.3c-.3-.4-.6-.7-.8-1.1zm2.6 2.6-1.1 1.7c.5.3 1 .5 1.5.8l.8-1.8c-.5-.3-.9-.5-1.2-.7z"/><path d="m0 0h24v24h-24z" fill="none"/>
                </svg>
            </div>
        </div>
        <div class="flex items-center justify-center gap-4 h-24 rounded bg-[#24303f] dark:bg-gray-800">
            <div class="gap-6">
                <p class=" text-lg text-left" >In progress</p>
                <h1 class="mt-1">20 <span class="text-base text-gray-400">Tickets</span></h1>
            </div> 
            <div class="bg-[#313d4a] p-1 rounded-full">
                <svg fill="#ffffff" class="w-6 h-6"  version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 86.285 86.285" xml:space="preserve" stroke="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                    <g id="SVGRepo_iconCarrier"> <g> <path d="M9.83,40.531c0-10.4,4.728-20.016,12.969-26.381c1.577-1.218,1.868-3.484,0.65-5.062c-1.219-1.577-3.484-1.87-5.063-0.65 C8.362,16.181,2.613,27.878,2.613,40.531c0,4.96,0.885,9.803,2.631,14.396c0.548,1.441,1.919,2.327,3.374,2.327 c0.426,0,0.859-0.076,1.281-0.236c1.863-0.708,2.799-2.792,2.091-4.655C10.557,48.592,9.83,44.611,9.83,40.531z"/> <path d="M43.143,0c-4.357,0-8.644,0.689-12.743,2.046c-1.893,0.626-2.918,2.668-2.292,4.56c0.626,1.892,2.668,2.916,4.56,2.292 c3.367-1.115,6.892-1.68,10.476-1.68c18.368,0,33.312,14.944,33.312,33.313c0,18.37-14.944,33.316-33.312,33.316 c-4.274,0-8.415-0.816-12.288-2.357l4.341-0.578c1.976-0.264,3.364-2.078,3.101-4.054c-0.264-1.977-2.091-3.36-4.054-3.101 l-13.864,1.848c-1.976,0.264-3.364,2.078-3.101,4.054c0.024,0.179,0.07,0.348,0.118,0.517c0.015,0.537,0.139,1.077,0.402,1.578 l6.624,12.601c0.646,1.229,1.899,1.931,3.197,1.931c0.566,0,1.141-0.134,1.676-0.415c1.765-0.928,2.443-3.109,1.516-4.873 L29.64,78.77c4.29,1.516,8.836,2.295,13.503,2.295c22.348,0,40.529-18.183,40.529-40.533C83.672,18.182,65.49,0,43.143,0z"/> <path d="M41.477,36.553c0-3.083-2.577-5.129-5.811-5.129c-2.325,0-4.195,0.581-5.61,1.288c-0.379,0.202-0.556,0.506-0.556,0.936 c0,0.556,0.404,0.984,0.96,0.984c0.202,0,0.43-0.101,0.48-0.126c1.137-0.505,2.603-0.909,4.321-0.909 c2.931,0,3.992,1.339,3.992,3.133c0,4.119-10.107,5.938-10.107,11.27c0,0.784,0.556,1.314,1.339,1.314h9.754 c0.606,0,1.087-0.455,1.087-1.062c0-0.606-0.48-1.086-1.087-1.086h-8.794C32.81,44.209,41.477,41.758,41.477,36.553z"/> <path d="M54.31,49.439c0.632,0,1.162-0.505,1.162-1.137v-3.437h1.921c0.581,0,1.035-0.43,1.035-1.011 c0-0.581-0.454-1.036-1.035-1.036h-1.921v-9.805c0-0.809-0.581-1.465-1.466-1.465h-0.505c-0.506,0-0.985,0.252-1.264,0.607 l-7.935,10.133C44.126,42.517,44,42.87,44,43.198v0.228c0,0.809,0.657,1.44,1.466,1.44h7.706v3.437 C53.172,48.935,53.678,49.439,54.31,49.439z M46.451,42.819l6.721-8.667v8.667H46.451z"/> <path d="M28.158,24.259c3.995-3.487,9.119-5.407,14.429-5.407c12.105,0,21.953,9.85,21.953,21.956c0,0.996,0.809,1.805,1.805,1.805 c0.996,0,1.805-0.809,1.805-1.805c0-14.096-11.468-25.564-25.563-25.564c-6.183,0-12.149,2.236-16.802,6.297 c-0.751,0.655-0.828,1.795-0.173,2.546C26.268,24.836,27.408,24.914,28.158,24.259z"/> </g> </g>
                </svg>
            </div>
        </div>
        <div class="flex items-center justify-center gap-4 h-24 rounded bg-[#24303f] dark:bg-gray-800">
            <div class="gap-6">
                <p class=" text-lg text-left" >Resolved</p>
                <h1 class="mt-1" >11 <span class="text-base text-gray-400">Tickets</span></h1>
            </div> 
            <div class="bg-[#313d4a] p-1.5 rounded-full">
                <svg fill="#ffffff"  version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17px" height="17px" viewBox="0 0 72 72" enable-background="new 0 0 72 72" xml:space="preserve" stroke="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                    <g id="SVGRepo_iconCarrier"> <g> <path d="M24.014,70.462c-2.617,0-5.073-1.016-6.917-2.859L2.175,53.877c-1.908-1.906-2.926-4.364-2.926-6.979 s1.018-5.072,2.866-6.92c1.849-1.849,4.307-2.866,6.921-2.866c2.591,0,5.029,1,6.872,2.818l8.102,7.109L55.861,4.618 c0.057-0.075,0.119-0.146,0.186-0.213c1.849-1.85,4.307-2.867,6.921-2.867s5.072,1.018,6.921,2.867 c3.784,3.784,3.815,9.923,0.093,13.747L31.697,67.416c-0.051,0.065-0.106,0.128-0.165,0.188c-1.914,1.912-4.498,2.926-7.214,2.854 C24.216,70.46,24.116,70.462,24.014,70.462z M9.037,41.112c-1.546,0-2.999,0.602-4.093,1.695C3.851,43.9,3.25,45.353,3.25,46.898 s0.602,3,1.694,4.093l14.922,13.726c1.148,1.146,2.6,1.914,4.148,1.914l0.227,0.164c0.05,0,0.1,0,0.151,0l0.221-0.164 c1.51,0,2.929-0.654,4.008-1.69l38.275-49.294c0.051-0.065,0.105-0.148,0.165-0.207c2.256-2.258,2.256-5.939,0-8.195 c-1.094-1.094-2.547-1.701-4.093-1.701c-1.502,0-2.917,0.566-3.999,1.602L25.914,51.169c-0.335,0.445-0.84,0.73-1.394,0.787 c-0.551,0.057-1.106-0.118-1.525-0.486l-9.771-8.573c-0.032-0.028-0.064-0.058-0.095-0.089 C12.036,41.714,10.583,41.112,9.037,41.112z"/> </g> </g>
                </svg>
            </div>
        </div>

    </div>
        
    <div class="">
            <div class="flex justify-end mb-2 ">
                    <input type="search" v-model="search" class="h-8 w-[200px]" placeholder="Search"></input>
            </div>
        <table class="">
            <thead>
                <tr class="text-white font-extrabold bg-[#1d2631] shadow-lg">
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th v-if="can.delete_user">Delete</th>
                </tr>
            </thead>
            <tbody class="bg-[#24303f]">
                <tr class=" hover:text-gray-500 hover:rounded-lg " v-for="user in users.data" :key="user.id">
                    <th><img class="w-12 h-12 rounded-full mr-3 " src="./Frame.png" alt="Neil image"></th>
                    <th >{{user.name}}</th>
                    <th>{{user.email}}</th>
                    <th v-if="can.delete_user"><button>delete</button></th>
                </tr>
            </tbody>
        </table>
        <div class="flex w-full  justify-end items-end ">
            <Link v-for="link in users.links" :key="link.label"
              v-html="link.label"
              :href="link.url" 
              class="text-base bg-[#24303f] rounded-md text-right p-1 px-3 mx-1 "
              :class="{'text-[#37475c]' : !link.url, 'bg-[#576479]' : link.active}"></Link>
        
            </div>
    </div>


    <!-- <div class="flex items-start flex-col p-4 px-10  justify-center h-full mb-4 rounded bg-[#24303f] dark:bg-gray-800">
          <h3 class="text-xl font-bold leading-none mb-4 text-white">Last 5 Tickets status</h3>
                <div class="border  border-white w-full border-b-0 ">
                </div>
                <ul class=" w-full">
                    
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center">
                            <div>
                                <img class="w-8 h-8 rounded-full mr-3" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" alt="Neil image">
                            </div>
                            <div>
                                <p class="text-sm text-left font-medium truncate text-white">
                                    Neil Sims
                                </p>
                                <p class="text-xs text-gray-300 truncate">
                                    email@windster.com
                                </p>
                            </div>
                            <div class="ml-auto text-sm font-semibold text-white flex gap-2">
                                <h1 class=" bg-green-500 p-1 rounded-lg ">solved</h1>
                                <button class="bg-yellow p-1 px-2 bg-gray-700 rounded-lg hover:bg-gray-500">Details</button>
                            </div>

                        </div>
                    </li>
                    
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center">
                            <div>
                                <img class="w-8 h-8 rounded-full mr-3" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" alt="Neil image">
                            </div>
                            <div>
                                <p class="text-sm text-left font-medium truncate text-white">
                                    Neil Sims
                                </p>
                                <p class="text-xs text-gray-300 truncate">
                                    email@windster.com
                                </p>
                            </div>
                            <div class="ml-auto text-sm font-semibold text-white flex gap-2">
                                <h1 class=" bg-gray-500 p-1 px-2 rounded-lg ">Pending</h1>
                                <button class="bg-yellow p-1 px-2 bg-gray-700 rounded-lg hover:bg-gray-500">Details</button>
                            </div>

                        </div>
                    </li>
                    
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center">
                            <div>
                                <img class="w-8 h-8 rounded-full mr-3" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" alt="Neil image">
                            </div>
                            <div>
                                <p class="text-sm text-left font-medium truncate text-white">
                                    Neil Sims
                                </p>
                                <p class="text-xs text-gray-300 truncate">
                                    email@windster.com
                                </p>
                            </div>
                            <div class="ml-auto text-sm font-semibold text-white flex gap-2">
                                <h1 class=" bg-gray-500 p-1 px-2 rounded-lg ">Pending</h1>
                                <button class="bg-yellow p-1 px-2 bg-gray-700 rounded-lg hover:bg-gray-500">Details</button>
                            </div>

                        </div>
                    </li>
                    
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center">
                            <div>
                                <img class="w-8 h-8 rounded-full mr-3" src="https://flowbite.com/docs/images/people/profile-picture-1.jpg" alt="Neil image">
                            </div>
                            <div>
                                <p class="text-sm text-left font-medium truncate text-white">
                                    Neil Sims
                                </p>
                                <p class="text-xs text-gray-300 truncate">
                                    email@windster.com
                                </p>
                            </div>
                            <div class="ml-auto text-sm font-semibold text-white flex gap-2">
                                <h1 class=" bg-gray-500 p-1 px-2   rounded-lg ">In progress</h1>
                                <button class="bg-yellow p-1 px-2 px-2  bg-gray-700 rounded-lg hover:bg-gray-500">Details</button>
                            </div>

                        </div>
                    </li>     
                </ul>
    </div> -->
        </div>
    </div>
</h1>
</div>
</template>