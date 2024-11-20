<script setup>
import { Head, router, useForm } from '@inertiajs/vue3';
import Textinput from '../Components/Textinput.vue';
const form = useForm({
    email: null,
    password: null,
});

// Submit handler
const submit = () => {
    form.post(route('login'), {
        onSuccess: () => {
            console.log('User logged successfully');
            // router.visit('/home');  
        },
        onError: () => form.reset("password") 
    });
};
</script>

<template>
  <Head title="Login"/>
    <div class=" ">

        
          <div class="w-2/4 mx-auto bg-[#24303f] rounded-xl p-10 ">
        
              <h1 class="title">Login</h1>
        
              
              <form @submit.prevent="submit" class="  bg-[#24303f]  py-3 flex flex-col justify-center items-center rounded-lg">
                  <!-- <label>Name</label> -->
                  <Textinput
                  name="email"
                  v-model="form.email"
                  :message="form.errors.email"/>
                  <Textinput
                  name="password"
                  type="password"
                  v-model="form.password" :message="form.errors.password"/>
                  <div class="flex items-center">
                      <p class="text-slate-600 mb-2 mr-2">you don't have an account?</p>
                      <a :href="route('register')" class="text-link mb-2">Sing up</a>
                    </div>
            <div class="">
                <button type="submit" :disabled="form.processing" class="primary-btn">Login</button>
            </div>
        </form>
        </div>
    </div>
</template>
