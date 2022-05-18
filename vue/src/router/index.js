import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "../views/Dashboard.vue";
import Register from "../views/Register.vue";
import Login from "../views/Login.vue";
import AuthLayout from "../components/AuthLayout.vue";
import DashboardLayout from "../components/DashboardLayout.vue";
import Messages from "../views/Messages.vue";
import NewClientRegisteration from "../views/NewClientRegisteration.vue";
import store from "../store";
import CustomerDashboard from "../views/CustomerDashboard.vue";
import Customer from "../components/Customer.vue";
import GuestPath from "../views/GuestPath.vue";
import AccountsView from "../views/AccountsView.vue";
import Expenses from "../views/Super_admin_dev_tools/Expenses.vue";
import TotalMessages from "../views/Super_admin_dev_tools/TotalMessages.vue";
import Positions from "../views/Super_admin_dev_tools/Positions.vue";
import TotalCustomers from "../views/Super_admin_dev_tools/TotalCustomers.vue";
import TotalBranches from "../views/Super_admin_dev_tools/TotalBranches.vue";
import TotalLoan from "../views/Super_admin_dev_tools/TotalLoan.vue";
import TotalWorkers from "../views/Super_admin_dev_tools/TotalWorkers.vue";
import TotalBalance from "../views/Super_admin_dev_tools/TotalBalance.vue";
import HandlingUserInput from "../views/vue_tutorials_examples/HandlingUserInput.vue";
import TreeItem from "../views/vue_tutorials_examples/TreeItem.vue";
import SortAndFilterList from "../views/vue_tutorials_examples/SortAndFilterList.vue";
import AttributeBinding from "../views/vue_tutorials_examples/AttributeBinding.vue";
import ConditionalLooping from "../views/vue_tutorials_examples/ConditionalLooping.vue";
import FormInputBinding from "../views/vue_tutorials_examples/FormInputBinding.vue";
import TutorialLayout from "../components/vue_tutorials_components/TutorialLayout.vue";
import Transactions from "../views/Transactions.vue";
import AccountView from "../views/Super_admin_dev_tools/AccountView.vue";
import PermisionsTable from "../views/Super_admin_dev_tools/PermisionsTable.vue";
import StaffProfile from "../views/Super_admin_dev_tools/StaffProfile.vue";
import ViewExpenses from "../views/ViewExpenses.vue";
import AllExpenses from "../views/AllExpenses.vue";
import Settings from "../views/Settings.vue";
import LoanRegisteration from "../views/LoanRegisteration.vue";
import UserAccountStatment from "../views/UserAccountStatment.vue";
import ViewSingleStatement from "../views/ViewSingleStatement.vue";
import OtherIncome from "../views/Super_admin_dev_tools/OtherIncome.vue";
import TotalIncome from "../views/Super_admin_dev_tools/TotalIncomeView.vue";
import SuperAdminTool from "../views/Super_admin_dev_tools/SuperAdminTool.vue";
import Notification from '../views/Notification.vue';
import DisbursementPage from "../views/disbursement/DisbursementPage.vue";
import LoansViews from "../views/LoansViews.vue";
import LoanPayment from "../views/LoanPayment.vue";
import singleLoanView from "../views/singleLoanView.vue";
import MarketersPayin from "../views/MarketersPayin.vue";
import TotalMarketersPayin from "../views/TotalMarketersPayin.vue";
import SuperAdminComponent from '../components/SuperAdminComponent.vue'
import PageLayout from '../components/landingpage/PageLayout.vue'
import Home from '../views/landingpage/Home.vue'
import About from '../views/landingpage/About.vue'
import Faq from '../views/landingpage/Faq.vue'
import TermsAndConditions from '../views/landingpage/TermsAndConditions.vue'
import CustomerService from '../views/landingpage/CustomerService.vue'
import SingleBlog from '../views/landingpage/SingleBlog.vue'
import NotFound from '../views/landingpage/NotFound.vue'
import BlogUpload from '../views/BlogsUpload.vue'



const routes = [
    { path: '/:pathMatch(.*)', name: 'NotFound', component: NotFound, meta: {transition: 'slide-right'}, },
    {
        path: "/dashboard",
        redirect: "Dashboard",
        component: DashboardLayout,
        meta: { requiresAuth: true, IsAdmin: true },
        children: [
            { path: "/dashboard", name: "Dashboard", component: Dashboard },
            { path: "/messages", name: "Messages", component: Messages },
            { path: "/upload-blog", name: "BlogUpload", component: BlogUpload },
            {
                path: "/newclient/:id",
                name: "NewClientRegisteration",
                component: NewClientRegisteration,
            },
            {
                path: "/customerdashboard",
                name: "CustomerDashboard",
                component: CustomerDashboard,
            },
            { path: "/expenses", name: "Expenses", component: Expenses },
            {
                path: "/total-messages",
                name: "TotalMessages",
                component: TotalMessages,
            },
            { path: "/positions", name: "Positions", component: Positions },
            {
                path: "/total-customers",
                name: "TotalCustomers",
                component: TotalCustomers,
            },
            {
                path: "/total-branches",
                name: "TotalBranches",
                component: TotalBranches,
            },
            { path: "/total-loan", name: "TotalLoan", component: TotalLoan },
            {
                path: "/total-worker",
                name: "TotalWorkers",
                component: TotalWorkers,
            },
            {
                path: "/total-balance",
                name: "TotalBalance",
                component: TotalBalance,
            },
            {
                path: "/account-view/:id",
                name: "AccountsView",
                component: AccountsView,
            },
            {
                path: "/transactions",
                name: "Transactions",
                component: Transactions,
            },
            {
                path: "/account-views",
                name: "AccountView",
                component: AccountView,
            },
            {
                path: "/user-role-management/:id",
                name: "PermisionsTable",
                component: PermisionsTable,
            },
            {
                path: "/staff-profile/:id",
                name: "StaffProfile",
                component: StaffProfile,
            },
            {
                path: "/view-expenses/:id",
                name: "ViewExpenses",
                component: ViewExpenses,
            },
            {
                path: "/view-all-expenses",
                name: "AllExpenses",
                component: AllExpenses,
            },
            { path: "/settings", name: "Settings", component: Settings },
            {
                path: "/loan/registeration",
                name: "LoanRegisteration",
                component: LoanRegisteration,
            },
            {
                path: "/loan/:id",
                name: "LoanView",
                component: LoanRegisteration,
            },
            {
                path: "/account-view/account-statement/:id",
                name: "UserAccountStatment",
                component: UserAccountStatment,
            },
            {
                path: "/account-view/account-statement/transaction-statement/:id",
                name: "ViewSingleStatement",
                component: ViewSingleStatement,
            },
            {
                path: "/other-income",
                name: "OtherIncome",
                component: OtherIncome,
            },
            {
                path: "/other-total-income",
                name: "TotalIncome",
                component: TotalIncome,
            },
            {
                path: "loan/disbursement/page/:id",
                name: "DisbursementPage",
                component: DisbursementPage,
            },
            {
                path: "/loan-masterall",
                name: "LoansViews",
                component: LoansViews,
            },
            {
                path: "/loan-payment",
                name: "LoanPayment",
                component: LoanPayment,
            },
            {
                path: "/single-loan-view/:id",
                name: "singleLoanView",
                component: singleLoanView,
            },
            {
                path: "/marketers-payin",
                name: "MarketersPayin",
                component: MarketersPayin,
            },
            {
                path: "/total-marketers-payin",
                name: "TotalMarketersPayin",
                component: TotalMarketersPayin,
            },
        ],
    },
    {
        path: '/',
        redirect: '/',
        component: PageLayout,
        meta: {transition: 'slide-right'},
        name: 'Home',
        children: [
            { path: '/', name: 'Home', component: Home, meta: {transition: 'slide-right'}, },
            { path: '/about', name: 'About', component: About, meta: {transition: 'slide-right'}, },
            { path: '/faq', name: 'Faq', component: Faq, meta: {transition: 'slide-right'}, },
            { path: '/terms-and-conditions', name: 'TermsAndConditions', component: TermsAndConditions },
            // { path: '/login', name: 'Login', component: Login },
            // { path: '/getstarted', name: 'Getstarted', component: Getstarted },
            { path: '/customer-service', name: 'CustomerService', component: CustomerService },
            { path: '/single-blog', props: route => ({query: route.query.title}), name: 'SingleBlog', component: SingleBlog },
    ]
    },
    {
        path: "/admintool",
        component: SuperAdminComponent,
        meta: { requiresAuth: true, IsAdmin: true, transition: 'slide-right' },
        children: [
            {
                path: '/super_admin_tool',
                component: SuperAdminTool,
                name: 'SuperAdminTool'
            },
            {
                path: '/notification',
                component: Notification,
                name: 'Notification'
            },
        ],
    },
    {
        path: "/tutorial",
        name: "TutorialLayout",
        redirect: "/attribute-binding",
        component: TutorialLayout,
        children: [
            {
                path: "/handling-user-input",
                name: "HandlingUserInput",
                component: HandlingUserInput,
            },
            {
                path: "/attribute-binding",
                name: "AttributeBinding",
                component: AttributeBinding,
            },
            {
                path: "/conditional-looping",
                name: "ConditionalLooping",
                component: ConditionalLooping,
            },
            {
                path: "/form-input-binding",
                name: "FormInputBinding",
                component: FormInputBinding,
            },
            {
                path: "/sort-and-filter",
                name: "SortAndFilterList",
                component: SortAndFilterList,
            },
            {
                path: "/tree-item",
                name: "TreeItem",
                component: TreeItem,
            },
        ],
    },

    {
        path: "/auth",
        redirect: "/login",
        name: "Auth",
        component: AuthLayout,
        meta: { isGuest: true },
        children: [
            { path: "/register", name: "Register", component: Register },
            { path: "/login", name: "Login", component: Login },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({ name: "Login" });
    } else if (store.state.user.token && to.meta.isGuest) {
        next({ name: "Dashboard" });
    } else {
        next();
    }
});

export default router;
