<template>
  <div v-if="$page.props.auth.user" class="max-w-4xl mx-auto bg-[#24303f] p-5 rounded sm:ml-64">
      <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-white">Tickets</h1>

        <div class="">
              <Link
              :href="route('tickets.create')"
                  class="flex items-center p-1.5 text-white rounded-lg dark:text-white hover:bg-gray-500 dark:hover:bg-gray-700 group">
                  <svg fill="white" class="text-gray-500 transition duration-75 dark:text-gray-400  group-hover:text-gray-900 dark:group-hover:text-white" width="20px" height="20px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><title>ionicons-v5-n</title><path d="M459.94,53.25a16.06,16.06,0,0,0-23.22-.56L424.35,65a8,8,0,0,0,0,11.31l11.34,11.32a8,8,0,0,0,11.34,0l12.06-12C465.19,69.54,465.76,59.62,459.94,53.25Z"/><path d="M399.34,90,218.82,270.2a9,9,0,0,0-2.31,3.93L208.16,299a3.91,3.91,0,0,0,4.86,4.86l24.85-8.35a9,9,0,0,0,3.93-2.31L422,112.66A9,9,0,0,0,422,100L412.05,90A9,9,0,0,0,399.34,90Z"/><path d="M386.34,193.66,264.45,315.79A41.08,41.08,0,0,1,247.58,326l-25.9,8.67a35.92,35.92,0,0,1-44.33-44.33l8.67-25.9a41.08,41.08,0,0,1,10.19-16.87L318.34,125.66A8,8,0,0,0,312.69,112H104a56,56,0,0,0-56,56V408a56,56,0,0,0,56,56H344a56,56,0,0,0,56-56V199.31A8,8,0,0,0,386.34,193.66Z"/></svg>
                  <span class="ml-1 font-semibold text-base">Create</span>
              </Link>
          </div>
      </div>
      <div v-if="tickets.length" class="space-y-4">
        <div
        v-for="ticket in tickets"
        :key="ticket.id"
        class="p-4 gap-4 bg-gray-800  text-white rounded shadow flex justify-between"
        >
        <div>
          <h2 class="text-lg font-semibold">{{ ticket.title }}</h2>
          <p class ="text-sm text-gray-400"><span class="text-white">Submitter</span>: {{ ticket.submitter || 'N/A' }}</p>
          <p class="text-sm text-gray-400"><span class="text-white">Category</span>: {{ ticket.category }}</p>
          <p class="text-sm text-gray-400"><span class="text-white">Priority</span> : {{ ticket.priority }}</p>
          <p class ="text-sm text-gray-400"><span class="text-white">Description</span>: {{ ticket.description || 'N/A' }}</p>
          <button
          @click="deleteTicket(ticket.id)"
          class="bg-red-500 m-2 text-white text-sm px-3 py-1 rounded hover:bg-red-600"
        >
          Delete
        </button>
        </div>
        <div class=" flex items-center ">
              <svg fill="#ffffff"  class="w-16 h-16  text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
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
        </div>
          </div>
          
      </div>
      <div v-else class="text-gray-400">No tickets found.</div>
  </div>
</template>

<script>
import { useForm, router } from '@inertiajs/vue3';

export default {
    props: {
        tickets: Array,
    },
    methods: {
        deleteTicket(ticketId) {
            if (confirm('Are you sure you want to delete this ticket?')) {
                // Perform the DELETE request using router.delete
                router.delete(route('tickets.destroy', ticketId), {
                    onSuccess: () => {
                        console.log('Ticket deleted successfully');
                        // Optionally, you can redirect to another page after deletion
                        // router.visit('/tickets');
                    },
                    onError: () => {
                        console.log('Failed to delete ticket');
                    },
                });
            }
        },
    },
};
</script>