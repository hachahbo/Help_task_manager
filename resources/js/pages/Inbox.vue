
<template>
    <div class="inbox p-6 lg:ml-64">
        <div class="flex-1  px-2" x-data="{ checkAll: false, filterMessages: false }">
        <div class="h-16 flex items-center justify-between">
            <div class="flex items-center">
                <div class="relative flex items-center px-0.5 space-x-0.5">
                    <input @click="checkAll = !checkAll" type="checkbox" class="focus:ring-0">
                    <div x-show="filterMessages" @click.away="filterMessages = false" class="bg-gray-200  shadow-2xl absolute left-0 top-6 w-32 py-2 text-gray-900 rounded z-10" style="display: none;">
                        <button @click="filterMessages = false" class=" w-full text-sm py-1 hover:bg-blue-600 hover:bg-opacity-30">
                            All
                        </button>
                        <button @click="filterMessages = false" class="w-full text-sm py-1 hover:bg-blue-600 hover:bg-opacity-30">
                            None
                        </button>
                        <button @click="filterMessages = false" class="w-full text-sm py-1 hover:bg-blue-600 hover:bg-opacity-30">
                            Read
                        </button>
                        <button @click="filterMessages = false" class="w-full text-sm py-1 hover:bg-blue-600 hover:bg-opacity-30">
                            Unread
                        </button>
                        <button @click="filterMessages = false" class="w-full text-sm py-1 hover:bg-blue-600 hover:bg-opacity-30">
                            Starred
                        </button>
                        <button @click="filterMessages = false" class="w-full text-sm py-1 hover:bg-blue-600 hover:bg-opacity-30">
                            Unstarred
                        </button>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ml-3">
                        <button title="Reload" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100" onclick="location.reload();">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </button>

                    </div>
                    <span class="bg-gray-300 h-6 w-[.5px] mx-3"></span>
                    <div class="flex items-center space-x-2">
                        <button title="Archive" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path>
                            </svg>
                        </button>
                        <button title="Mark As Spam" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </button>
                        <button title="Delete" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                    <span class="bg-gray-300 h-6 w-[.5px] mx-3"></span>
                    <div class="flex items-center space-x-2">
                        <button title="Mark As Read" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path>
                            </svg>
                        </button>
                        <button title="Mark As Unread" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                        <button title="Add Star" class="text-gray-700 px-2 py-1 border border-gray-300 rounded-lg shadow hover:bg-gray-200 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="px-2 flex items-center space-x-4">
                <span class="text-sm text-gray-500">1-15 of 1,323</span>
                <div class="flex items-center space-x-2">
                    <button class="bg-gray-200 text-gray-400 p-1.5 rounded-lg" title="Newer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <button class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-1.5 rounded-lg transition duration-150" title="Older">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        </div>
        <!-- Comments -->
        <div class="bg-gray-800 text-white mb-6 px-2 py-2  rounded-xl"> 
        <div
            v-for="comment in comments.slice().reverse()"
            :key="comment.id"
            class="comment-item  p-1 rounded-lg cursor-pointer"
        >
            <!-- Clickable Comment -->
            <Link :href="route('tickets.show', { ticket: comment.ticket.id })" class="block">
                <div class="grid group grid-cols-12 justify-center items-center h-14  px-2 text-white hover:bg-gray-200 hover:rounded-xl hover:text-gray-600">
                    <!-- Comment Info -->
                    <div class="flex col-span-3 gap-2">
                        <input type="checkbox" class="focus:ring-0 border-2 border-gray-400 py-6" :checked="checkAll">
                        <div class="flex items-center  space-x-1">
                                <button title="Not starred">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                </button>
                                <button title="Click to mark this email as important">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 hover:text-gray-900 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                    </svg>
                                </button>
                            </div>
                        <p class="text-base font-semibold">{{ comment.user.name }}</p>
                        
                    </div>
                    <div class=" col-span-6" >
                        <p class="  text-base font-normal  flex justify-center items-center ">
                            <svg   class=" fill-slate-100 group-hover:fill-slate-600  g w-8 h-8 mr-2 text-gray-500 transition duration-75 dark:text-gray-400  " version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        viewBox="0 0 512.005 512.005" xml:space="preserve">
                                        <g>
                                            <g>
                                                <g>
                                                    <path d="M511.513,223.904L452.508,42.326c-1.708-5.251-7.348-8.125-12.602-6.42L6.912,176.612
                                                        c-5.252,1.707-8.126,7.349-6.42,12.602l27.93,85.949c-0.008,0.168-0.025,0.333-0.025,0.503v190.925c0,5.522,4.478,10,10,10
                                                        H493.68c5.522,0,10-4.478,10-10V275.666c0-5.522-4.478-10-10-10h-78.32l89.734-29.16
                                                        C510.345,234.799,513.219,229.157,511.513,223.904z M483.679,285.666v170.925H48.396V285.666h55.392v111.408
                                                        c0,5.522,4.478,10,10,10c5.522,0,10-4.478,10-10V285.666h228.441H483.679z M350.645,265.666H46.365l-23.762-73.123l52.711-17.129
                                                        l20.162,61.276c1.385,4.208,5.296,6.877,9.497,6.877c1.036,0,2.09-0.162,3.128-0.504c5.246-1.727,8.1-7.378,6.373-12.625
                                                        l-20.139-61.206L436.577,58.017l52.825,162.558L350.645,265.666z"/>
                                                    <path d="M421.405,101.849c-1.708-5.251-7.349-8.124-12.602-6.42l-260.728,84.727c-5.252,1.707-8.126,7.349-6.42,12.602
                                                        c1.374,4.226,5.293,6.912,9.509,6.912c1.024,0,2.066-0.159,3.093-0.492l260.728-84.727
                                                        C420.237,112.744,423.112,107.102,421.405,101.849z"/>
                                                    <path d="M377.434,166.804l49.352-16.037c5.252-1.707,8.126-7.349,6.42-12.602c-1.708-5.252-7.349-8.125-12.602-6.42
                                                        l-49.352,16.037c-5.252,1.707-8.126,7.349-6.42,12.602c1.374,4.226,5.293,6.912,9.509,6.912
                                                        C375.365,167.296,376.408,167.137,377.434,166.804z"/>
                                                    <path d="M419.143,212.741c1.374,4.226,5.293,6.912,9.509,6.912c1.023,0,2.066-0.159,3.093-0.492l15.617-5.075
                                                        c5.252-1.707,8.127-7.349,6.42-12.602c-1.708-5.252-7.348-8.126-12.602-6.42l-15.617,5.075
                                                        C420.311,201.846,417.436,207.488,419.143,212.741z"/>
                                                    <path d="M390.685,211.473l-15.618,5.075c-5.252,1.707-8.127,7.349-6.42,12.602c1.373,4.226,5.293,6.912,9.509,6.912
                                                        c1.023,0,2.065-0.159,3.093-0.492l15.618-5.075c5.252-1.707,8.126-7.349,6.42-12.602
                                                        C401.581,212.641,395.944,209.768,390.685,211.473z"/>
                                                    <path d="M251.132,186.817l-91.255,29.654c-5.252,1.707-8.127,7.349-6.42,12.602c1.374,4.226,5.293,6.912,9.509,6.912
                                                        c1.023,0,2.066-0.159,3.093-0.492l91.255-29.654c5.252-1.707,8.126-7.349,6.42-12.602
                                                        C262.025,187.985,256.384,185.112,251.132,186.817z"/>
                                                    <path d="M113.788,420.364c-5.522,0-10,4.478-10,10v3.916c0,5.522,4.478,10,10,10c5.522,0,10-4.478,10-10v-3.916
                                                        C123.788,424.842,119.31,420.364,113.788,420.364z"/>
                                                    <path d="M161.554,322.663c0,5.522,4.478,10,10,10h274.148c5.522,0,10-4.478,10-10c0-5.522-4.478-10-10-10H171.554
                                                        C166.032,312.663,161.554,317.14,161.554,322.663z"/>
                                                    <path d="M445.703,350.847H393.81c-5.522,0-10,4.478-10,10c0,5.522,4.478,10,10,10h51.893c5.522,0,10-4.478,10-10
                                                        C455.703,355.325,451.225,350.847,445.703,350.847z"/>
                                                    <path d="M445.703,417.427h-16.422c-5.522,0-10,4.478-10,10c0,5.522,4.478,10,10,10h16.422c5.522,0,10-4.478,10-10
                                                        C455.703,421.905,451.225,417.427,445.703,417.427z"/>
                                                    <path d="M392.608,417.427h-16.421c-5.522,0-10,4.478-10,10c0,5.522,4.478,10,10,10h16.421c5.522,0,10-4.478,10-10
                                                        C402.608,421.905,398.131,417.427,392.608,417.427z"/>
                                                    <path d="M267.507,350.847h-95.952c-5.522,0-10,4.478-10,10c0,5.522,4.478,10,10,10h95.952c5.522,0,10-4.478,10-10
                                                        C277.507,355.325,273.029,350.847,267.507,350.847z"/>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                            <div class="text-left felx items-center w-full">
                                <span class="">{{ comment.ticket.title }} - </span>
                                <span class=" text-gray-400 text-sm truncate">{{ getFirstThreeWords(comment.comment) }}</span>
                            </div>
                        </p>
                            
                        </div >
                        <!-- Ticket Info -->
                        <div class="text-right col-span-3">
                        <p class="text-xs text-gray-400"> {{ formatDate(comment.created_at) }}</p>
                       
                    </div>
                </div>
            </Link>
        </div>
        <div v-if="!comments.length" class="py-3 text-center text-gray-400">
                        No messages found
                    </div>
    </div>
    </div>
   
</template>


<script>
export default {
    props: {
        comments: Array,
    },
    methods: {
        formatDate(date) {
            return new Date(date).toLocaleString("en-US", {
                day: "numeric",
                hour: "2-digit",
                minute: "2-digit",
            });
        },
        getFirstThreeWords(text) {
            return text.split(' ').slice(0, 3).join(' ') + '...';
        },
    },
};

</script>