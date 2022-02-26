<script setup>

const props = defineProps({
    selected: {
        type: String,
        default: '',
    },
});
</script>

<template>
    <select
        class="bg-black appearance-none text-yellow-400
        border-yellow-400 focus:border-yellow-400 focus:shadow-none
        focus:ring-yellow-400"
        v-model="selected"
    >
        <option value="">Please select one</option>
        <option value="Doki Doki Literature Club">Doki Doki Literature Club</option>
        <option value="Silent Hill 2">Silent Hill 2</option>
        <option value="Amnesia: The Dark Descent">Amnesia: The Dark Descent</option>
        <option value="Layers of Fear">Layers of Fear</option>
    </select>
</template>
