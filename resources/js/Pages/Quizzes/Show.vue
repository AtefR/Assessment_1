<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import {ref} from "vue"
import DangerButton from "@/Components/DangerButton.vue"
import Pagination from "@/Components/Pagination.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import {useForm} from "@inertiajs/vue3";

defineProps({
    quiz: Object,
    responses: Object,
})

const deleteQuizResponseForm = useForm({});
const responseBeingDeleted = ref(null)

const confirmResponseDeletion = (quiz) => {
    responseBeingDeleted.value = quiz;
}

const deleteQuizResponse = () => {
    deleteQuizResponseForm.delete(route('quiz-responses.destroy', responseBeingDeleted.value), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => (responseBeingDeleted.value = null),
    });
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <div class="inline-flex justify-between w-full">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ quiz.title }}
                </h2>
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
                            <th class="border-b font-medium p-4 pt-0 pb-3 text-left">Submitted At</th>
                            <th class="border-b font-medium p-4 pr-8 pt-0 pb-3 text-left"></th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        <template v-if="responses.data.length > 0">
                            <tr v-for="response in responses.data" :key="response.id">
                            <td class="border-b border-slate-100 p-4">{{ response.email }}</td>
                            <td class="border-b border-slate-100 p-4">{{ response.response }}</td>
                            <td class="border-b border-slate-100 p-4">{{ new Date(response.created_at).toLocaleString() }}</td>
                            <td class="border-b border-slate-100 p-4 pr-8">
                                <DangerButton  @click="confirmResponseDeletion(response)">
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

                    <Pagination :links="responses.links" class="mt-3 m-auto"/>
                </div>
            </div>
        </div>

        <!-- Delete Quiz Modal -->
        <ConfirmationModal :show="responseBeingDeleted != null" @close="responseBeingDeleted = null">
            <template #title>
                Delete Quiz Response
            </template>

            <template #content>
                Are you sure you would like to delete this quiz response?
            </template>

            <template #footer>
                <SecondaryButton @click="responseBeingDeleted = null">
                    Cancel
                </SecondaryButton>

                <DangerButton
                    class="ms-3"
                    :class="{ 'opacity-25': deleteQuizResponseForm.processing }"
                    :disabled="deleteQuizResponseForm.processing"
                    @click="deleteQuizResponse"
                >
                    Delete
                </DangerButton>
            </template>
        </ConfirmationModal>
    </AppLayout>
</template>
