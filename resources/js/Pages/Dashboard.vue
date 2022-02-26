<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeSelect from '@/Components/Select.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';

const props = defineProps({
    voteResult: null,
});

const form = useForm({
    vote: ''
});

const submit = () => {
    form.post(route('votes.store'), {
        onFinish: () => form.reset('vote'),
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-yellow-400 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="shadow-sm sm:rounded-lg">
                    <template v-if="!voteResult">
                        <p class="py-6 text-yellow-400">
                            Vote for the best psychological horror game of all times bellow:
                        </p>

                        <BreezeValidationErrors class="mb-4" />

                        <form @submit.prevent="submit">
                            <BreezeSelect name="vote" v-model="form.vote" />

                            <div class="ml-4 inline-block">
                                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Submit your vote
                                </BreezeButton>
                            </div>
                        </form>
                    </template>
                    <template v-else>
                        <p class="py-6 text-yellow-400">
                            Thank you for voting!
                        </p>
                        <p class="text-yellow-400">
                            Your vote was: {{ voteResult.result }}
                        </p>
                    </template>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
