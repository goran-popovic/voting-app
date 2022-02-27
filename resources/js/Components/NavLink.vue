<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'inline-flex items-center pt-1 text-sm font-medium leading-5 text-yellow-400 transition duration-150 ease-in-out'
    : 'inline-flex items-center pt-1 text-sm font-medium leading-5 text-yellow-400 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
