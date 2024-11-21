<template>
    <div>
      <h1>{{ ticket.title }}</h1>
      <p>{{ ticket.description }}</p>
      <p><strong>Priority:</strong> {{ ticket.priority }}</p>
      <p><strong>Status:</strong> {{ ticket.status }}</p>
      <router-link :to="'/tickets'">Back to Tickets</router-link>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      ticket: Object, // The ticket data passed from the controller
    },
  }
  </script>
  