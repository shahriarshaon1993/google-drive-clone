<template>
    <SecondaryButton @click="onClick" class="mr-3">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
        </svg>

        Add to favourites
    </SecondaryButton>
</template>

<script setup>
// Imports
import {ref} from "vue";
import {usePage, useForm} from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {showErrorDialog} from "@/event-bus";
import {showSuccessNotification} from "@/event-bus";

// Uses
const page = usePage();
const form = useForm({
    all: null,
    ids: [],
    parent_id: null
});

// Refs

// Props & Emit
const props = defineProps({
    allSelected: {
        type: Boolean,
        required: false,
        default: false
    },
    selectedIds: {
        type: Array,
        required: false
    }
});

// Methods
function onClick() {
    if (!props.allSelected && !props.selectedIds.length) {
        showErrorDialog('Please select al least one file');
        return;
    }

    form.parent_id = page.props.folder.id;
    if (props.allSelected) {
        form.all = true;
    } else {
        form.ids = props.selectedIds;
    }

    form.post(route('file.addToFavourites'), {
        onSuccess: () => {
            form.ids = [];
            showSuccessNotification('Selected files have been added to favourites');
        }
    });
}
</script>
