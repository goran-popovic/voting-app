<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:selected']);

const props = defineProps({
    selected: {
        type: String,
        default: '',
    },
    value: {
        default: null,
    },
    voteItems: Array
});

const proxySelect = computed({
    get() {
        return props.selected;
    },

    set(val) {
        emit("update:selected", val);
    },
});
</script>

<template>
    <select
        class="bg-black appearance-none text-yellow-400
        border-yellow-400 focus:border-yellow-400 focus:shadow-none
        focus:ring-yellow-400"
        v-model="proxySelect"
        :value="value"
    >
        <option value="">Please select one</option>
        <option v-for="item in props.voteItems" :value="item">
            {{ item }}
        </option>
    </select>
</template>
