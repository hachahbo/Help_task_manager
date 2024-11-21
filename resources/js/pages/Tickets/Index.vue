<template>
  <div class="max-w-4xl mx-auto bg-[#24303f] p-5 rounded sm:ml-64">
      <h1 class="text-2xl font-semibold text-white mb-4">Tickets</h1>
      <div v-if="tickets.length" class="space-y-4">
          <div
              v-for="ticket in tickets"
              :key="ticket.id"
              class="p-4 bg-gray-800 text-white rounded shadow"
          >
              <h2 class="text-lg font-semibold">{{ ticket.title }}</h2>
              <p class="text-sm text-gray-400">Priority: {{ ticket.priority }}</p>
              <p class="text-sm text-gray-400">Category: {{ ticket.category }}</p>
              <p class="text-sm text-gray-400">Description: {{ ticket.description || 'N/A' }}</p>
          </div>
      </div>
      <div v-else class="text-gray-400">No tickets found.</div>
  </div>
</template>

<script>
export default {
  props: {
      tickets: Array,
  },
};
</script>
