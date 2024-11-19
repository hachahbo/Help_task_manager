<script setup>
const model = defineModel({
    type: null,
    required : true
})
    defineProps({
        name:
        {
            type: String,
            Required: true,
        },
        type: {
            type : String,
            default: 'text',

        },
        message: String,

    })
</script>

<template>
    <div>
        <div class="mb-6">
      <label class="text-white">{{ name }}</label>
        <input :type="type"  v-model="model"/>
        <small v-if="message" class="text-red-500 font-sm error">
            {{ message}}  
        </small>
    </div>
    </div>
</template>