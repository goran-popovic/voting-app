<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Link class="block w-full px-4 py-2 text-left text-sm leading-5 text-black focus:outline-none transition duration-150 ease-in-out">
        <slot />
    </Link>
</template>
