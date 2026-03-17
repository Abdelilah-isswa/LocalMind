const CommentForm = {
    props: ['questionId'],
    emits: ['submit', 'cancel'],
    template: `
        <div class="comment-form">
            <textarea v-model="content" placeholder="Write your comment..." rows="2"></textarea>
            <button @click="onSubmit" class="btn-primary btn-small">Post</button>
            <button @click="$emit('cancel')" class="btn-secondary btn-small">Cancel</button>
        </div>
    `,
    setup(props, { emit }) {
        const { ref } = Vue;
        const content = ref('');

        const onSubmit = () => {
            if (!content.value.trim()) return;
            emit('submit', props.questionId, content.value);
            content.value = '';
        };

        return { content, onSubmit };
    }
};
