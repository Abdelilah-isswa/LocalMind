const SearchBar = {
    emits: ['search', 'clear'],
    template: `
        <div class="search-section">
            <input v-model="searchQuery"   type="text" placeholder="Search questions...">
            <input v-model="locationQuery" type="text" placeholder="Filter by location...">
            <button @click="$emit('search', searchQuery, locationQuery)" class="btn-primary">Search</button>
            <button @click="onClear" class="btn-secondary">Clear</button>
        </div>
    `,
    setup(props, { emit }) {
        const { ref } = Vue;

        const searchQuery   = ref('');
        const locationQuery = ref('');

        const onClear = () => {
            searchQuery.value   = '';
            locationQuery.value = '';
            emit('clear');
        };

        return { searchQuery, locationQuery, onClear };
    }
};
