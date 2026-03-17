const { createApp } = Vue;

const app = createApp({
    template: '<router-view></router-view>'
});

app.use(router);
app.mount('#app');
