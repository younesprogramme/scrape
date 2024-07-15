import DealerSearch from './components/dealer/search.vue';
import DealerDetails from './components/dealer/dealer.vue';


export const routes = [
    {path: '/', redirect: '/dealer/search', name: 'homepage'},
    {path: '/dealer/search', component: DealerSearch, name: 'dealer_search'},
    {path: '/dealer/show/:id', component: DealerDetails, name: 'dealer_show', props: true},
];
