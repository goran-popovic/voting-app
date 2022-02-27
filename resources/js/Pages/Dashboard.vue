<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeSelect from '@/Components/Select.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';

const props = defineProps({
    alreadyVoted: false,
    voteItems: Array
});

const form = useForm({
    vote: ''
});

const submit = () => {
    form.post(route('votes.store'), {
        onFinish: () => form.reset('vote')
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
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="shadow-sm sm:rounded-lg">
                    <BreezeValidationErrors class="mb-4" />
                    <template v-if="!alreadyVoted">
                        <p class="py-6 text-yellow-400">
                            Vote for the best psychological horror game of all times bellow:
                        </p>

                        <form @submit.prevent="submit">
                            <div class="mb-6 inline-block">
                                <BreezeSelect name="vote" v-model:selected="form.vote" :vote-items="voteItems" />
                            </div>

                            <div class="inline-block submit-vote">
                                <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Submit your vote
                                </BreezeButton>
                            </div>
                        </form>
                    </template>
                    <template v-else>
                        <p class="py-6 text-yellow-400">
                            Thank you for voting!
                        </p>
                    </template>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<style scoped>
    @media screen and (min-width: 456px) {
        .submit-vote {
            margin-left: 2rem;
        }
    }
</style>
