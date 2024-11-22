<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Swal from "@/Components/Swal.vue";

defineProps({
    title: String,
});
</script>

<template>
    <Head :title="title" />

    <Swal v-if="$page?.props.flash?.status" :status="$page?.props.flash?.status" />

    <div class="bg-gray-100 ">
        <div class="relative min-h-screen flex flex-col items-center selection:bg-[#FF2D20] selection:text-white">
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="flex">
                    <nav class="-mx-3 flex flex-1 justify-end mt-3">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                        >
                            Dashboard
                        </Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                            >
                                Log in
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="mt-6">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
