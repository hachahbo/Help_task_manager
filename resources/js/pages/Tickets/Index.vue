<template>
    <div>
      <h1>All Tickets</h1>
      <div v-if="tickets.length === 0">
        <p>No tickets found.</p>
      </div>
      <div v-for="ticket in tickets" :key="ticket.id" class="ticket">
        <h3>{{ ticket.title }}</h3>
        <p>{{ ticket.priority }} - {{ ticket.status }}</p>
        <router-link :to="`/tickets/${ticket.id}`">View Details</router-link>
        <form :action="`/tickets/${ticket.id}`" method="POST" @submit.prevent="deleteTicket(ticket.id)">
          @csrf
          @method('DELETE')
          <button type="submit">Delete</button>
        </form>
      </div>
      <router-link to="/tickets/create">Create New Ticket</router-link>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      tickets: Array, // This will be passed from the backend
    },
    methods: {
      deleteTicket(ticketId) {
        if (confirm('Are you sure you want to delete this ticket?')) {
          this.$inertia.delete(`/tickets/${ticketId}`);
        }
      },
    },
  }
  </script>
  