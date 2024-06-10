<template>
    <div
        class="min-h-screen flex items-center justify-center bg-gray-900 text-white"
    >
        <div class="w-full max-w-2xl p-8 rounded-lg bg-gray-800 shadow-lg">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold">
                    Welcome to the <br />
                    Frontend Quiz!
                </h1>
                <button @click="toggleTheme" class="focus:outline-none">
                    <span v-if="isDarkMode" class="text-yellow-500 text-2xl"
                        >☀️</span
                    >
                    <span v-else class="text-white text-2xl">🌙</span>
                </button>
            </div>
            <p class="mb-6 text-gray-400">Pick a subject to get started.</p>
            <div class="space-y-4">
                <button
                    class="flex items-center bg-gray-700 p-4 rounded-lg w-full hover:bg-gray-600 transition"
                >
                    <img
                        src="path/to/html-icon.png"
                        alt="HTML"
                        class="w-8 h-8 mr-4"
                    />
                    <span>HTML</span>
                </button>
                <button
                    class="flex items-center bg-gray-700 p-4 rounded-lg w-full hover:bg-gray-600 transition"
                >
                    <img
                        src="path/to/css-icon.png"
                        alt="CSS"
                        class="w-8 h-8 mr-4"
                    />
                    <span>CSS</span>
                </button>
                <button
                    class="flex items-center bg-gray-700 p-4 rounded-lg w-full hover:bg-gray-600 transition"
                >
                    <img
                        src="path/to/js-icon.png"
                        alt="Javascript"
                        class="w-8 h-8 mr-4"
                    />
                    <span>Javascript</span>
                </button>
                <button
                    class="flex items-center bg-gray-700 p-4 rounded-lg w-full hover:bg-gray-600 transition"
                >
                    <img
                        src="path/to/accessibility-icon.png"
                        alt="Accessibility"
                        class="w-8 h-8 mr-4"
                    />
                    <span>Accessibility</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

// Theme toggling logic
const isDarkMode = ref(false);

const toggleTheme = () => {
    isDarkMode.value = !isDarkMode.value;
};
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
