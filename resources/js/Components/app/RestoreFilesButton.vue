<template>
    <SecondaryButton @click="onClick">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-4 h-4 mr-2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
        </svg>
        Restore
    </SecondaryButton>

    <ConfirmationDialog
        :show="showConfirmationDialog"
        message="Are you sure you want to restore selected files"
        @cancel="onCancel"
        @confirm="onConfirm"
    >

    </ConfirmationDialog>
</template>

<script setup>
// Imports
import {ref} from "vue";
import {usePage, useForm} from "@inertiajs/vue3";
import ConfirmationDialog from "@/Components/ConfirmationDialog.vue";
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
const showConfirmationDialog = ref(false);

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
const emit = defineEmits(['restore']);

// Methods
function onClick() {
    if (!props.allSelected && !props.selectedIds.length) {
        showErrorDialog('Please select al least one file to restore');
        return;
    }
    showConfirmationDialog.value = true;
}

function onCancel() {
    showConfirmationDialog.value = false;
}

function onConfirm() {
    if (props.allSelected) {
        form.all = true;
    } else {
        form.ids = props.selectedIds;
    }

    form.post(route('file.restore'), {
        onSuccess: () => {
            showConfirmationDialog.value = false;
            emit('restore');
            showSuccessNotification('Selected files have been restored');
        }
    });
}
</script>
