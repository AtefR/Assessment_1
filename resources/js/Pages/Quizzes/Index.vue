<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import PrimaryButton from "@/Components/PrimaryButton.vue"
import InputError from "@/Components/InputError.vue"
import SecondaryButton from "@/Components/SecondaryButton.vue"
import TextInput from "@/Components/TextInput.vue"
import DialogModal from "@/Components/DialogModal.vue"
import {ref} from "vue"
import {router, useForm} from "@inertiajs/vue3"
import TextArea from "@/Components/TextArea.vue"
import DangerButton from "@/Components/DangerButton.vue"
import Pagination from "@/Components/Pagination.vue"
import ConfirmationModal from "@/Components/ConfirmationModal.vue";

defineProps({ quizzes: Object })

const deleteQuizForm = useForm({});
const form = useForm({
    title: '',
    description: '',
})
const updateQuizForm = useForm({
    title: '',
    description: '',
});

const creatingQuiz = ref(false)
const quizBeingDeleted = ref(null)
const quizBeingEdited = ref(null)

const closeModal = () => {
    creatingQuiz.value = false

    form.reset()
}

const saveQuiz = () => {
    form.post(route('quizzes.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()

            closeModal()
        },
        onFinish: () => form.reset(),
    })
}

const confirmQuizDeletion = (quiz) => {
    quizBeingDeleted.value = quiz;
}

const deleteQuiz = () => {
    deleteQuizForm.delete(route('quizzes.destroy', quizBeingDeleted.value), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => (quizBeingDeleted.value = null),
    });
}

const editQuiz = (quiz) => {
    updateQuizForm.title = quiz.title;
    updateQuizForm.description = quiz.description;

    quizBeingEdited.value = quiz;
}

const updateQuiz = () => {
    updateQuizForm.put(route('quizzes.update', quizBeingEdited.value), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => (quizBeingEdited.value = null),
    });
}

const viewQuiz = (quiz) => {
    router.visit(route('quizzes.show', quiz))
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="inline-flex justify-between w-full">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Quizzes
                </h2>

                <PrimaryButton type="button" href="/quizzes/create" @click="creatingQuiz = true">Create</PrimaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="border-collapse table-fixed w-full text-sm mt-4">
                        <thead>
                        <tr>
                            <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-left">Title</th>
                            <th class="border-b font-medium p-4 pt-0 pb-3 text-left">Description</th>
                            <th class="border-b font-medium p-4 pr-8 pt-0 pb-3 text-left"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        <template v-if="quizzes.data.length > 0">
                            <tr v-for="quiz in quizzes.data" :key="quiz.id">
                            <td class="border-b border-slate-100 p-4">{{ quiz.title }}</td>
                            <td class="border-b border-slate-100 p-4">{{ quiz.description }}</td>
                            <td class="border-b border-slate-100 p-4 pr-8">
                                <PrimaryButton @click="viewQuiz(quiz)" class="mr-2">
                                    View
                                </PrimaryButton>

                                <SecondaryButton @click="editQuiz(quiz)" class="mr-2">
                                    Edit
                                </SecondaryButton>

                                <DangerButton  @click="confirmQuizDeletion(quiz)">
                                    Delete
                                </DangerButton>
                            </td>
                        </tr>
                        </template>
                        <tr v-else>
                            <td colspan="4">There's No Records Yet</td>
                        </tr>
                        </tbody>
                    </table>

                    <Pagination :links="quizzes.links" class="mt-3 m-auto"/>
                </div>
            </div>
        </div>

        <!-- Create Quiz Modal -->
        <DialogModal :show="creatingQuiz" @close="closeModal">
            <template #title>
                Create Quiz
            </template>

            <template #content>
                <div class="mt-4">
                    <label for="message" class="block mb-2 text-sm font-medium">Title</label>
                    <TextInput
                        ref="titleInput"
                        v-model="form.title"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Title"
                    />
                    <InputError :message="form.errors.title" class="mt-2" />

                    <label for="message" class="block mt-3 mb-2 text-sm font-medium">Description</label>
                    <TextArea
                        ref="descriptionInput"
                        v-model="form.description"
                        class="mt-1 block w-full"
                        placeholder="Description"
                    />
                    <InputError :message="form.errors.description" class="mt-2" />

                </div>
            </template>

            <!-- Delete Quiz Modal -->
            <template #footer>
                <SecondaryButton @click="closeModal">
                    Cancel
                </SecondaryButton>

                <PrimaryButton
                    class="ms-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="saveQuiz"
                >
                    Save
                </PrimaryButton>
            </template>
        </DialogModal>

        <!-- Edit Quiz Modal -->
        <DialogModal :show="quizBeingEdited != null" @close="quizBeingEdited = null">
            <template #title>
                Edit Quiz
            </template>

            <template #content>
                <div class="mt-4">
                    <label for="message" class="block mb-2 text-sm font-medium">Title</label>
                    <TextInput
                        ref="titleInput"
                        v-model="updateQuizForm.title"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Title"
                    />
                    <InputError :message="updateQuizForm.errors.title" class="mt-2" />

                    <label for="message" class="block mt-3 mb-2 text-sm font-medium">Description</label>
                    <TextArea
                        ref="descriptionInput"
                        v-model="updateQuizForm.description"
                        class="mt-1 block w-full"
                        placeholder="Description"
                    />
                    <InputError :message="updateQuizForm.errors.description" class="mt-2" />

                </div>
            </template>

            <!-- Edit Quiz Modal -->
            <template #footer>
                <SecondaryButton @click="quizBeingEdited = null">
                    Cancel
                </SecondaryButton>

                <PrimaryButton
                    class="ms-3"
                    :class="{ 'opacity-25': updateQuizForm.processing }"
                    :disabled="updateQuizForm.processing"
                    @click="updateQuiz"
                >
                    Save
                </PrimaryButton>
            </template>
        </DialogModal>

        <!-- Delete Quiz Modal -->
        <ConfirmationModal :show="quizBeingDeleted != null" @close="quizBeingDeleted = null">
            <template #title>
                Delete Quiz
            </template>

            <template #content>
                Are you sure you would like to delete this quiz?
            </template>

            <template #footer>
                <SecondaryButton @click="quizBeingDeleted = null">
                    Cancel
                </SecondaryButton>

                <DangerButton
                    class="ms-3"
                    :class="{ 'opacity-25': deleteQuizForm.processing }"
                    :disabled="deleteQuizForm.processing"
                    @click="deleteQuiz"
                >
                    Delete
                </DangerButton>
            </template>
        </ConfirmationModal>
    </AppLayout>
</template>
