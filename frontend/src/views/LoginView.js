const LoginView = {
    template: `
        <div class="auth-container">
            <div class="auth-card">
                <h1>🧠 LocalMind</h1>

                <div class="auth-tabs">
                    <button @click="isLogin = true"  :class="{ active: isLogin }">Login</button>
                    <button @click="isLogin = false" :class="{ active: !isLogin }">Register</button>
                </div>

                <form @submit.prevent="isLogin ? handleLogin() : handleRegister()" class="auth-form">
                    <input v-if="!isLogin" v-model="name"     type="text"     placeholder="Name"     required>
                    <input                 v-model="email"    type="email"    placeholder="Email"    required>
                    <input                 v-model="password" type="password" placeholder="Password" required>
                    <button type="submit" class="btn-primary">
                        {{ isLogin ? 'Login' : 'Register' }}
                    </button>
                    <div v-if="error" class="error">{{ error }}</div>
                </form>
            </div>
        </div>
    `,
    setup() {
        const { ref } = Vue;

        const isLogin  = ref(true);
        const name     = ref('');
        const email    = ref('');
        const password = ref('');
        const error    = ref('');

        const handleLogin = async () => {
            try {
                error.value = '';
                const res = await api.login(email.value, password.value);
                localStorage.setItem('token', res.token);
                localStorage.setItem('user', JSON.stringify(res.user));
                window.location.hash = '#/home';
            } catch (e) {
                error.value = e.data?.message || 'Login failed';
            }
        };

        const handleRegister = async () => {
            try {
                error.value = '';
                const res = await api.register(name.value, email.value, password.value);
                localStorage.setItem('token', res.token);
                localStorage.setItem('user', JSON.stringify(res.user));
                window.location.hash = '#/home';
            } catch (e) {
                error.value = e.data?.message || 'Registration failed';
            }
        };

        return { isLogin, name, email, password, error, handleLogin, handleRegister };
    }
};
