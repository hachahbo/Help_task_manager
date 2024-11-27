<!-- <template>
  <div class="p-6  sm:ml-64 bg-gray-800 text-white rounded">
    <div class="flex mb-4 items-end gap-1">
      <h2 class="text-2xl font-semibold">{{ ticket.title }}
        <span class="text-sm mb-1 text-gray-400">  {{ getDate(ticket.created_at)}}</span>
      </h2>
    </div>
      <div class=" bg-gray-700 p-3 rounded-md w-fit">
        <p class ="text-sm text-gray-400"><span class="text-white">Submitter</span>: {{ ticket.submitter || 'N/A' }}</p>
        <p class="text-sm text-gray-400"><span class="text-white">Category</span>: {{ ticket.category }}</p>
        <p class="text-sm text-gray-400"><span class="text-white">Priority</span> : {{ ticket.priority }}</p>
      </div>
      <div class="bg-gray-700 mt-2 p-3 rounded-md">
        <p class ="text-sm text-gray-400"><span class="text-white">Description </span></p>  
         <div class="bg-gray-800 mt-2 p-3 rounded-xl" > 
          {{ ticket.description || 'N/A' }}
         </div> 

      </div> -->

      <!-- <div class=" mt-3">
          <div class=" flex justify-end  gap-4 p-2 ">
            <div class=" w-80 p-2 px-3 bg-gray-700 rounded-lg">
              hi Sir . Lorem Ipsum is simply dummy text of the puser took a galley of type and scrambled it to make a type specimen bookinto electronic typesetting
            </div>
            <div class="">
              <img class="w-12 h-12  rounded-full mr-4 mt-2 " src="../Frame.png" alt="Neil image">
            </div>
          </div>
       </div>
       <div class=" mt-3">
          <div class=" flex p-4">
            <div>
              <img class="w-12 h-12  rounded-full mr-4 mt-2 " src="../Frame.png" alt="Neil image">
            </div>
            <div class="w-full p-2 bg-gray-700 rounded-lg">
              <textarea
                    id="text"
                    class="mt-1 block w-full rounded-md shadow-sm resize-none overflow-hidden"
                    rows="3"
                    placeholder="Type here..."
                ></textarea>
                <div class="flex justify-end">
                  <button type="submit" class="p-1 flex items-center gap-1 px-3 m-2 bg-gray-800 rounded-lg">
                    Send
                    <svg id="Layer_1"  class="fill-white h-4 "
                    data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.56 122.88"><path class="cls-1" d="M2.33,44.58,117.33.37a3.63,3.63,0,0,1,5,4.56l-44,115.61h0a3.63,3.63,0,0,1-6.67.28L53.93,84.14,89.12,33.77,38.85,68.86,2.06,51.24a3.63,3.63,0,0,1,.27-6.66Z"/>
                    </svg>
                  </button>
                
                </div>
            </div>
          </div>
       </div> -->
  <!-- </div>
</template>

<script>
export default {
  props: {
      ticket: Object,
  },
  methods: {
    getDate(date) {
      return new Date(date).toLocaleDateString("en-us", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });
    },
  },
};
</script> -->

<template>
  <div class="p-6 sm:ml-64 bg-gray-800 text-white rounded">
    <!-- Ticket Details -->
    <div class="flex mb-4 items-end gap-1">
      <h2 class="text-2xl font-semibold">{{ ticket.title }}
        <span class="text-sm mb-1 text-gray-400">{{ getDate(ticket.created_at) }}</span>
      </h2>
    </div>
    
    <div class="bg-gray-700 p-3 rounded-md w-fit">
      <p class="text-sm text-gray-400"><span class="text-white">Submitter</span>: {{ ticket.submitter || 'N/A' }}</p>
      <p class="text-sm text-gray-400"><span class="text-white">Category</span>: {{ ticket.category }}</p>
      <p class="text-sm text-gray-400"><span class="text-white">Priority</span>: {{ ticket.priority }}</p>
    </div>

    <div class="bg-gray-700 mt-2 p-3 rounded-md">
      <p class="text-sm text-gray-400"><span class="text-white">Description</span></p>  
      <div class="bg-gray-800 mt-2 p-3 rounded-xl">
        {{ ticket.description || 'N/A' }}
      </div> 
    </div>

    <!-- Comments Section -->
    <div class="comments-section mt-4">
      <h3 class="text-lg text-white font-semibold">Comments</h3>

      <div v-for="comment in ticket.comments" :key="comment.id" class="comment bg-gray-700 p-3 rounded-md mt-2">
        <p class="text-base font-semibold text-white">{{ comment.user.name }} 
        <span class="text-gray-400 text-xs">{{ getDate(comment.created_at) }}</span></p>
        <p class="text-sm ml-2 text-white">{{ comment.comment }}</p>
      </div>

      <!-- Add Comment Form -->
      <div >
        <textarea v-model="newComment" placeholder="Add a comment..." class="comment-input mt-3 p-2 w-full bg-gray-800 text-white border rounded-md"></textarea>
        <button @click="submitComment(ticket.id)" class="btn-submit mt-2 p-2 bg-blue-500 text-white rounded-md">Submit</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    ticket: Object,
  },
  data() {
    return {
      newComment: '',  // New comment content
    };
  },
  computed: {
    canComment() {
      return this.$page.props.auth.user.role !== 'user'; // For example, only admins and technicians can comment
    },
  },
  methods: {
    getDate(date) {
      return new Date(date).toLocaleDateString("en-us", {
        year: "numeric",
        month: "long",
        day: "numeric",
      });
    },
    submitComment(ticketId) {
      if (!this.newComment) {
        return; // Don't submit empty comments
      }

      this.$inertia.put(route('tickets.addComment', { ticket: ticketId }), {
        content: this.newComment,
      });

      this.newComment = '';
    },
  },
  mounted() {
    // Print ticket.comments to the console when the component is mounted
    console.log(this.ticket.comments);
  },
};
</script>

<style scoped>
.comment-input {
  width: 100%;
  height: 80px;
  background-color: #333;
  color: white;
  border: 1px solid #555;
}
.btn-submit {
  background-color: #4c7faf;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 5px;
}
</style>

