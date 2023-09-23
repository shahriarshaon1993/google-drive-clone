<template>
    <Modal :show="props.modalValue" @show="onShow" max-width="sm">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Share Files
            </h2>
            <div class="mt-6">
                <InputLabel for="shareEmail" value="Enter email address" class="sr-only" />

                <TextInput
                    ref="emailInput"
                    type="text"
                    id="shareEmail"
                    v-model="form.email"
                    :class="form.errors.email ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : ''"
                    class="mt-1 block w-full"
                    placeholder="Enter email address"
                    @keyup.enter="share"
                />

                <InputError :message="form.errors.email" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                <PrimaryButton class="ml-3" :class="{ 'opacity-25': form.processing }" @click="share"
                    :disable="form.processing">
                    Submit
                </PrimaryButton>
            </div>
        </div>
    </Modal>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { nextTick, ref } from 'vue';
import {showSuccessNotification} from "../../event-bus";

const props = defineProps({
    modalValue: Boolean,
    allSelected: Boolean,
    selectedIds: Array
});

const emit = defineEmits(['update:modalValue']);

const form = useForm({
    email: null,
    all: false,
    ids: [],
    parent_id: null
});
const page = usePage();

const emailInput = ref(null);

// Methods
function onShow() {
    nextTick(() => emailInput.value.focus());
}

function share() {
    form.parent_id = page.props.folder.id;
    if (props.allSelected) {
        form.all = true;
        form.ids = [];
    } else {
        form.ids = props.selectedIds;
    }
    const email = form.email;
    form.post(route('file.share'), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal();
            form.reset()
            // Show success notification
            showSuccessNotification(`Selected files will be shared to "${email}" if the email exists in the system`);
        },
        onError: () => emailInput.value.focus()
    });
}

function closeModal() {
    emit('update:modalValue');
    form.clearErrors();
    form.reset();
}
</script>
