<template>
    <div
        class="flex items-center justify-center min-h-screen text-white bg-gray-900"
    >
        <div class="w-full max-w-2xl p-8 bg-gray-800 rounded-lg shadow-lg">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold">
                    Welcome to the Quiz!
                </h1>
               
            </div>
            <p class="mb-6 text-gray-400">Pick a subject to get started.</p>
            <div class="space-y-4" v-for="(category, index) in category"
            :key="index">
                <button @click="selectCategory(category)"
                    class="flex items-center w-full p-4 mb-3 transition bg-gray-700 rounded-lg hover:bg-gray-600"
                >
                    <img
                        src="https://rainsaxfrontend-mentor-projects.github.io/frontend-quiz-app/assets/images/icon-html.svg"
                        alt="HTML"
                        class="w-8 h-8 mr-4"
                    />
                    <span class="text-3xl font-bold">{{ category }}</span>
                </button>
                <!-- <button
                    class="flex items-center w-full p-4 transition bg-gray-700 rounded-lg hover:bg-gray-600"
                >
                    <img
                        src="https://rainsaxfrontend-mentor-projects.github.io/frontend-quiz-app/assets/images/icon-css.svg"
                        alt="CSS"
                        class="w-8 h-8 mr-4"
                    />
                    <span class="text-3xl font-bold">CSS</span>
                </button>
                <button
                    class="flex items-center w-full p-4 transition bg-gray-700 rounded-lg hover:bg-gray-600"
                >
                    <img
                        src="https://rainsaxfrontend-mentor-projects.github.io/frontend-quiz-app/assets/images/icon-js.svg"
                        alt="Javascript"
                        class="w-8 h-8 mr-4"
                    />
                    <span class="text-3xl font-bold">Javascript</span>
                </button>
                <button
                    class="flex items-center w-full p-4 transition bg-gray-700 rounded-lg hover:bg-gray-600"
                >
                    <img
                        src="https://rainsaxfrontend-mentor-projects.github.io/frontend-quiz-app/assets/images/icon-accessibility.svg"
                        alt="Accessibility"
                        class="w-8 h-8 mr-4"
                    />
                    <span class="text-3xl font-bold ">Accessibility</span>
                </button> -->
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import QuasarLayout from "@/Layouts/QuasarLayout.vue";
import { useForm } from "@inertiajs/vue3";
defineOptions({
    layout: QuasarLayout
})
const form = useForm({
    name:""
})
const props = defineProps({
    category:Object
})


const selectCategory = (category) => {
    form.name = category
    console.log(form.name)
    // updateForm.post(route("updateUserRole", selectedUser.value));
    form.get(route('quiz_show'));
}
</script>

<style>
body.dark-mode {
    --tw-bg-opacity: 1;
    background-color: rgba(31, 41, 55, var(--tw-bg-opacity));
    --tw-text-opacity: 1;
    color: rgba(255, 255, 255, var(--tw-text-opacity));
}

body.light-mode {
    --tw-bg-opacity: 1;
    background-color: rgba(255, 255, 255, var(--tw-bg-opacity));
    --tw-text-opacity: 1;
    color: rgba(0, 0, 0, var(--tw-text-opacity));
}
</style>
