const QuestionCard = {
    props: ['question', 'showDelete'],
    emits: ['favorite', 'delete', 'comment'],
    template: `
        <div class="question-card">
            <div class="question-header">
                <h3>{{ question.title }}</h3>
                <div class="question-actions">
                    <button @click="$emit('favorite', question.id)" class="btn-icon" title="Favorite">⭐</button>
                    <button v-if="showDelete" @click="$emit('delete', question.id)" class="btn-icon" title="Delete">🗑️</button>
                </div>
            </div>
            <p class="question-content">{{ question.content }}</p>
            <div class="question-meta">
                <span>📍 {{ question.location }}</span>
                <span>📅 {{ formatDate(question.date) }}</span>
                <span>👤 {{ question.user?.name || 'Unknown' }}</span>
            </div>
            <div class="question-footer">
                <button @click="$emit('comment', question.id)" class="btn-small">💬 Add Comment</button>
            </div>
        </div>
    `,
    setup() {
        const formatDate = (date) => new Date(date).toLocaleDateString();
        return { formatDate };
    }
};
