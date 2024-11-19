
<script setup>
import { Head, router, useForm } from '@inertiajs/vue3';
import Textinput from '../Components/Textinput.vue';
import { route } from '../../../../vendor/tightenco/ziggy/src/js';
// Initialize the form with initial values and errors object
const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});

// Submit handler
const submit = () => {
    form.post(route('register'), {
        onSuccess: () => {
            console.log('User registered successfully');
            // router.visit('/home');  
        },
        onError: () => form.reset("password", "password_confirmation") 
    });
    // router.post("./register");
    // console.log(form);
};
</script> 
<template>
      <Head title="Register" />
    <div>
        <div class="w-2/4 mx-auto   bg-[#24303f] rounded-xl p-10">
            <h1 class="title">Register a new account</h1>
            <form @submit.prevent="submit" class=" bg-[#24303f]  py-5 flex flex-col justify-center items-center rounded-lg">
                <Textinput
                    name="name"
                    v-model="form.name"
                    :message="form.errors.name"/>
                    <Textinput
          name="email"
          v-model="form.email"
          :message="form.errors.email"/>
          <Textinput
          name="password"
          type="password"
          v-model="form.password" :message="form.errors.password"/>
          <Textinput
          name="confirm password"
          type="password"
          v-model="form.password_confirmation" :message="form.errors.password_confirmation"/>
          
          <div class="flex  items-center">
              <p class="text-slate-600 mb-2 mr-2">Already a user?</p>
              <a :href="route('login')" class="text-link mb-2">Login</a>
            </div>
            <div class="">
                <button type="submit" :disabled="form.processing" class="primary-btn">Register</button>
            </div>
        </form>
            
        </div>

    </div>
</template>
