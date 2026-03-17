const { createRouter, createWebHashHistory } = VueRouter;

const routes = [
    { path: '/',     component: LoginView },
    { path: '/home', component: HomeView  },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

// Auth Guard - protect /home from unauthenticated users
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token');
    if (to.path === '/home' && !token) next('/');
    else if (to.path === '/' && token)  next('/home');
    else next();
});
