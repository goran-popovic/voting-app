<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean
})
</script>

<template>
    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen bg-black sm:items-center sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:pt-0">
                <h1 class="text-yellow-400 text-4xl">Voting App</h1>
            </div>

            <div class="mt-8 overflow-hidden">
                <div class="grid text-center">
                    <div v-if="canLogin" class="px-6 py-4 sm:block">
                        <div v-if="$page.props.auth.user" class="max-w-lg">
                            <p class="text-lg text-yellow-400 mb-16">
                                Please proceed to your dashboard in order to vote or to check what you voted for.
                            </p>

                            <Link :href="route('dashboard')"
                                  class="text-base uppercase text-black bg-yellow-400 p-2 rounded font-bold"
                            >
                                Dashboard
                            </Link>
                        </div>

                        <template v-else>
                            <div class="max-w-lg">
                                <p class="text-lg text-yellow-400 mb-16">
                                    Please login or register in order to vote.
                                </p>

                                <div class="flex justify-center align-middle">
                                    <div class="basis-1/2 px-3">
                                        <Link :href="route('login')"
                                              class="block text-base uppercase text-black bg-yellow-400 p-2 rounded font-bold"
                                        >
                                            Log in
                                        </Link>
                                    </div>
                                    <div class="basis-1/2 px-3">
                                        <Link v-if="canRegister" :href="route('register')"
                                              class="block text-base uppercase text-black bg-yellow-400 p-2 rounded font-bold"
                                        >
                                            Register
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
