const HomeView = {
    components: { Navbar, SearchBar, QuestionCard, CommentForm, CreateQuestionForm },
    template: `
        <div class="home-container">

            <Navbar :user="user" @logout="handleLogout" />

            <SearchBar @search="onSearch" @clear="loadQuestions" />

            <nav class="nav-tabs">
                <button @click="showAll"       :class="{ active: currentView === 'all' }">All Questions</button>
                <button @click="showMine"      :class="{ active: currentView === 'my' }">My Questions</button>
                <button @click="showFavorites" :class="{ active: currentView === 'favorites' }">Favorites</button>
                <button @click="currentView = 'create'" :class="{ active: currentView === 'create' }">Create Question</button>
            </nav>

            <CreateQuestionForm
                v-if="currentView === 'create'"
                @created="onQuestionCreated"
                @cancel="currentView = 'all'"
            />

            <div v-else class="questions-list">
                <div v-if="loading" class="loading">Loading...</div>
                <div v-else-if="questions.length === 0" class="no-data">No questions found</div>
                <template v-else>
                    <div v-for="question in questions" :key="question.id">
                        <QuestionCard
                            :question="question"
                            :showDelete="currentView === 'my'"
                            @favorite="toggleFavorite"
                            @delete="deleteQuestion"
                            @comment="openCommentForm"
                        />
                        <CommentForm
                            v-if="activeCommentId === question.id"
                            :questionId="question.id"
                            @submit="submitComment"
                            @cancel="activeCommentId = null"
                        />
                    </div>
                </template>
            </div>

        </div>
    `,
    setup() {
        const { ref, onMounted } = Vue;

        const user            = ref(JSON.parse(localStorage.getItem('user') || '{}'));
        const questions       = ref([]);
        const loading         = ref(false);
        const currentView     = ref('all');
        const activeCommentId = ref(null);

        const loadQuestions = async (search = '', location = '') => {
            loading.value = true;
            try {
                questions.value = await api.getQuestions(search, location);
            } catch (e) {
                console.error(e);
            }
            loading.value = false;
        };

        const showAll = () => {
            currentView.value = 'all';
            loadQuestions();
        };

        const showMine = async () => {
            currentView.value = 'my';
            loading.value = true;
            try {
                questions.value = await api.getMyQuestions();
            } catch (e) {
                console.error(e);
            }
            loading.value = false;
        };

        const showFavorites = async () => {
            currentView.value = 'favorites';
            loading.value = true;
            try {
                questions.value = await api.getFavorites();
            } catch (e) {
                console.error(e);
            }
            loading.value = false;
        };

        const onSearch = (search, location) => loadQuestions(search, location);

        const onQuestionCreated = () => showMine();

        const deleteQuestion = async (id) => {
            if (!confirm('Are you sure?')) return;
            try {
                await api.deleteQuestion(id);
                showMine();
            } catch (e) {
                alert('Failed to delete question');
            }
        };

        const toggleFavorite = async (id) => {
            try {
                const res = await api.toggleFavorite(id);
                alert(res.message);
            } catch (e) {
                alert('Failed to toggle favorite');
            }
        };

        const openCommentForm = (id) => {
            activeCommentId.value = activeCommentId.value === id ? null : id;
        };

        const submitComment = async (questionId, content) => {
            try {
                await api.addComment(questionId, content);
                activeCommentId.value = null;
                alert('Comment added!');
            } catch (e) {
                alert('Failed to add comment');
            }
        };

        const handleLogout = async () => {
            try { await api.logout(); } catch (e) { console.error(e); }
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            window.location.hash = '#/';
        };

        onMounted(() => loadQuestions());

        return {
            user, questions, loading, currentView, activeCommentId,
            loadQuestions, showAll, showMine, showFavorites,
            onSearch, onQuestionCreated, deleteQuestion,
            toggleFavorite, openCommentForm, submitComment, handleLogout
        };
    }
};
