<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
// import Link from "@inertiajs/vue3";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header class="flex">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
            <Link :href="route('usersRole')">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    User
                </h2>
            </Link>
            <Link :href="route('roles')">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Roles
                </h2>
            </Link>
            <Link :href="route('permissions')">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Permissions
                </h2>
            </Link>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
