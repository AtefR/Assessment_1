<script setup>
import { Head, Link } from '@inertiajs/vue3';
import moment from 'moment'
import Pagination from "@/Components/Pagination.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

defineProps({ quizzes: Object });
</script>

<template>
    <GuestLayout title="Welcome">
        <div>
            <template v-for="quiz in quizzes.data">
                <Link :href="route('quiz.show', quiz)" class="flex justify-between items-center px-5 py-3 my-0.5 bg-white hover:bg-gray-200">
                    <div>
                        <div class="inline-flex items-center justify-center">
                            <h1 class="text-lg">{{ quiz.title }}</h1>
                            <span class="text-gray-400 text-xs mx-2 justify-center">{{ moment(quiz.created_at).fromNow() }}</span>
                        </div>
                        <p class="mt-1 text-sm">
                            {{ quiz.description }}
                        </p>
                    </div>

                    <span class="justify-center">{{ quiz.responses_count }}</span>
                </Link>
            </template>

            <Pagination :links="quizzes.links" class="mt-3 m-auto"/>
        </div>
    </GuestLayout>
</template>
