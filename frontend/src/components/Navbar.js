const Navbar = {
    props: ['user'],
    emits: ['logout'],
    template: `
        <header class="header">
            <h1>🧠 LocalMind</h1>
            <div class="user-info">
                <span>Welcome, {{ user.name }}!</span>
                <button @click="$emit('logout')" class="btn-secondary">Logout</button>
            </div>
        </header>
    `
};
