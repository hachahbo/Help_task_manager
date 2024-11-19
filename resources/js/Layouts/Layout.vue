
<script setup>
    import { Link, Head } from '@inertiajs/vue3';
import { route } from '../../../vendor/tightenco/ziggy/src/js';
</script>
<template>
    <div>
        <Head>
            <title>My app</title>
        </Head>
        <header >
            <nav class="bg-[#24303f]">
                <div v-if="$page.props.auth.user">
                    <Link class="nav-link"  :href="route('dashboard')">Dashbord</Link>
                </div>
                <div v-else class="space-x-6 ">
                    <Link class="nav-link" :href="route('home')">Home</Link>
                </div>
                <div v-if="$page.props.auth.user">
                    <Link class="nav-link"  :href="route('settings')">Settings</Link>
                    <Link class="nav-link" method="post" :href="route('logout')">Logout</Link>
                </div>
                <div v-else  class="space-x-6 ">
                    <Link class="nav-link" :href="route('register')">Register</Link>
                    <Link class="nav-link" :href="route('login')">Login</Link>
                </div> 
            </nav>
    </header>
    <main class=" p-4">
        <div v-if="$page.props.auth.user">
                <sidebar class=" border-white">
                        <h1>hiii</h1>
                </sidebar>
        </div>
            <slot></slot>
        </main>
    </div>
</template>