<template>
    <Head title="Quiz"/>
    <!-- <h4>Quizzes</h4> -->
    <div class="flex items-center justify-center min-h-screen bg-zinc-300">
      <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg dark:bg-zinc-800">
        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center">
            <h1 class="text-lg font-semibold text-black-900 dark:text-zinc-900">{{ currentQuestion.category }}</h1>
          </div>
          <button @click="toggleTheme" class="focus:outline-none">
            <span v-if="isDarkMode" class="text-yellow-500">☀️</span>
            <span v-else class="text-zinc-500">🌙</span>
          </button>
        </div>
        <p class="mb-2 text-zinc-700 dark:text-zinc-700">Question {{ currentQuestionIndex + 1 }} of {{ props.question.length }}</p>
        <h2 class="mb-4 text-xl font-bold text-zinc-900 dark:text-zinc-900">{{ currentQuestion.question }}</h2>
        <div class="space-y-2">
          <label v-for="(answer, index) in answers" :key="index" :class="{
            'bg-green-500': showResults && answer.correct, 
            'bg-red-500': showResults && !answer.correct && selectedAnswer === answer.value, 
            'bg-zinc-700': !showResults,
            'dark:bg-zinc-700': !showResults 
          }" class="block p-3 rounded-lg cursor-pointer">
            <input type="radio" name="answer" :value="answer.value" v-model="selectedAnswer" class="mr-2" :disabled="showResults"> {{ answer.label }}
          </label>
        </div>
        <div v-if="showNotification" class="mt-2 text-red-500">Please select an answer before submitting.</div>
        <button @click="submitAnswer" class="w-full p-3 mt-4 text-white bg-purple-600 rounded-lg">
          {{ showResults && currentQuestionIndex.value === props.question.length - 1 ? 'Restart Quiz' : (showResults ? 'Next Question' : 'Submit') }}
        </button>
      </div>
    </div>
  </template>
  
  <script setup>
  import QuasarLayout from "@/Layouts/QuasarLayout.vue";
  import { ref, computed } from 'vue';
  import { useQuasar } from "quasar";
  const $q = useQuasar();
  const props = defineProps({
    question: Array
  });
  
  defineOptions({
    layout: QuasarLayout
  });
  
  const isDarkMode = ref(false);
  const currentQuestionIndex = ref(0);
  const selectedAnswer = ref(null);
  const showResults = ref(false);
  const correctAnswerCount = ref(0);
  const showNotification = ref(false);
  const toggleTheme = () => {
    isDarkMode.value = !isDarkMode.value;
  };
  
  const currentQuestion = computed(() => props.question[currentQuestionIndex.value]);
  
  const answers = computed(() => [
    currentQuestion.value.answer_a ? { label: `A. ${currentQuestion.value.answer_a}`, value: 'A', correct: currentQuestion.value.answer_a_correct === 'true' } : null,
    currentQuestion.value.answer_b ? { label: `B. ${currentQuestion.value.answer_b}`, value: 'B', correct: currentQuestion.value.answer_b_correct === 'true' } : null,
    currentQuestion.value.answer_c ? { label: `C. ${currentQuestion.value.answer_c}`, value: 'C', correct: currentQuestion.value.answer_c_correct === 'true' } : null,
    currentQuestion.value.answer_d ? { label: `D. ${currentQuestion.value.answer_d}`, value: 'D', correct: currentQuestion.value.answer_d_correct === 'true' } : null
  ].filter(Boolean));
  
  const submitAnswer = () => {

    if (!selectedAnswer.value) {
    showNotification.value = true;
    return;
  }

  showNotification.value = false;
    if (showResults.value) {
      // Move to the next question or restart quiz
      if (currentQuestionIndex.value < props.question.length - 1) {
        currentQuestionIndex.value++;
        selectedAnswer.value = null;
        showResults.value = false;
      } else {
        $q.dialog({
        dark: true,
        title: "Congratulations",
        message:`Quiz Completed! You answered ${correctAnswerCount.value} questions correctly.`,
    })
        // alert(`Quiz Completed! You answered ${correctAnswerCount.value} questions correctly.`);
        currentQuestionIndex.value = 0;
        selectedAnswer.value = null;
        showResults.value = false;
        correctAnswerCount.value = 0;
      }
    } else {
      // Show results and update correct answer count
      showResults.value = true;
      const correctAnswer = answers.value.find(answer => answer.correct);
      if (selectedAnswer.value === correctAnswer.value) {
        correctAnswerCount.value++;
      }
    }
  };
  
  </script>
  
  <style scoped>
  .bg-green-500 {
    background-color: green !important;
  }
  .bg-red-500 {
    background-color: red !important;
  }
  </style>
  