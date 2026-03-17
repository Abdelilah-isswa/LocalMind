const CreateQuestionForm = {
    emits: ['created', 'cancel'],
    template: `
        <div class="create-form">
            <h2>Create New Question</h2>
            <input    v-model="form.title"    type="text" placeholder="Title"    required>
            <textarea v-model="form.content"  placeholder="Content" rows="4"    required></textarea>
            <input    v-model="form.location" type="text" placeholder="Location" required>
            <input    v-model="form.date"     type="date"                        required>
            <button @click="onSubmit" class="btn-primary">Create</button>
            <button @click="$emit('cancel')"  class="btn-secondary">Cancel</button>
            <div v-if="error" class="error">{{ error }}</div>
        </div>
    `,
    setup(props, { emit }) {
        const { ref } = Vue;

        const form = ref({ title: '', content: '', location: '', date: '' });
        const error = ref('');

        const onSubmit = async () => {
            try {
                error.value = '';
                await api.createQuestion(form.value);
                form.value = { title: '', content: '', location: '', date: '' };
                emit('created');
            } catch (e) {
                error.value = e.data?.message || 'Failed to create question';
            }
        };

        return { form, error, onSubmit };
    }
};
