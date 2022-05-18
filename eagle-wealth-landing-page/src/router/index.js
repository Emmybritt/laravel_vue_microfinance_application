import {createRouter, createWebHistory} from 'vue-router'
import Home from '../views/Home.vue'
import About from '../views/About.vue'
import Faq from '../views/Faq.vue'
import PageLayout from '../components/PageLayout.vue'
import TermsAndConditions from '../views/TermsAndCondition.vue'
import Login from '../views/Login.vue'
import Getstarted from '../views/Getstarted.vue'
import CustomerService from '../views/CustomerService.vue'

const routes = [
    {
        path: '/',
        redirect: '/',
        component: PageLayout,
        name: 'Home',
        children: [
            { path: '/', name: 'Home', component: Home },
            { path: '/about', name: 'About', component: About },
            { path: '/faq', name: 'Faq', component: Faq },
            { path: '/terms-and-conditions', name: 'TermsAndConditions', component: TermsAndConditions },
            { path: '/login', name: 'Login', component: Login },
            { path: '/getstarted', name: 'Getstarted', component: Getstarted },
            { path: '/customer-service', name: 'CustomerService', component: CustomerService },
    ]
    },
    
]

const router = createRouter({
    history: createWebHistory(),
      routes
});

export default router;