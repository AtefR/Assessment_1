<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import moment from 'moment'
import TextArea from "@/Components/TextArea.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

const {quiz} = defineProps({ quiz: Object });

const form = useForm({
    email: '',
    response: '',
    quiz_id: quiz.id,
})
</script>

<template>
    <GuestLayout :title="quiz.title">
        <div class="bg-white px-5 py-3 my-0.5">
            <div class="flex justify-between items-center border-b pb-3">
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
            </div>

            <div class="mt-5">
                <form @submit.prevent="form.post(route('quiz-response.store', quiz))">
                    <TextInput
                        ref="titleInput"
                        v-model="form.email"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Email"
                    />
                    <InputError :message="form.errors.email" class="mb-2" />

                    <TextArea
                        ref="descriptionInput"
                        v-model="form.response"
                        class="mt-1 block w-full"
                        placeholder="Response"
                        rows="6"
                    />
                    <InputError :message="form.errors.response" class="mb-2" />

                    <PrimaryButton
                        class="mt-2"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        type="submit"
                    >
                        Submit
                    </PrimaryButton>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>
