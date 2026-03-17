const API_BASE_URL = 'http://localhost:8000/api';

const api = {
    async call(endpoint, method = 'GET', body = null, requiresAuth = false) {
        const headers = {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        };

        if (requiresAuth) {
            const token = localStorage.getItem('token');
            if (token) headers['Authorization'] = `Bearer ${token}`;
        }

        const config = { method, headers };
        if (body) config.body = JSON.stringify(body);

        const response = await fetch(`${API_BASE_URL}${endpoint}`, config);
        const data = await response.json();

        if (!response.ok) throw { status: response.status, data };
        return data;
    },

    // Auth
    register: (name, email, password) => api.call('/register', 'POST', { name, email, password }),
    login:    (email, password)        => api.call('/login', 'POST', { email, password }),
    logout:   ()                       => api.call('/logout', 'POST', null, true),

    // Questions
    getQuestions: (search = '', location = '') => {
        const params = new URLSearchParams();
        if (search)   params.append('search', search);
        if (location) params.append('location', location);
        const query = params.toString() ? '?' + params.toString() : '';
        return api.call('/questions' + query);
    },
    getMyQuestions: ()     => api.call('/questions/my', 'GET', null, true),
    createQuestion: (data) => api.call('/questions', 'POST', data, true),
    deleteQuestion: (id)   => api.call(`/questions/${id}`, 'DELETE', null, true),

    // Comments
    addComment: (questionId, content) => api.call(`/questions/${questionId}/comments`, 'POST', { content }, true),

    // Favorites
    toggleFavorite: (questionId) => api.call(`/questions/${questionId}/favorite`, 'POST', null, true),
    getFavorites:   ()           => api.call('/favorites', 'GET', null, true),
};
