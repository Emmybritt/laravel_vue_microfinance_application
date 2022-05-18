import { createStore } from "vuex";
import axiosClient from "../axios";
import abilityPlugin from './ability'
import { TYPE_KEY } from '../services/utils'
import { Ability } from '@casl/ability'

const store = createStore({
    state: {
        user: {
            data: {},
            isLoading: false,
            token: sessionStorage.getItem("TOKEN"),
            type: sessionStorage.getItem("TYPE"),
            userPermission: null,
        },
        rules: [],
        abilities: {
            data: null,
        },
        allAccounts: {
            loading: false,
            data: [],
            account_detail: [],
            searchedAccounts: null,
            links: null,
            AllLinks: [],
        },
        accountBalance: {
            totalDebit: null,
            totalCredit: null,
        },
        expenses: {
            loading: false,
            data: [],
            totalExpenses: null,
            AllExpenses: [],
            totalExpensesLinks: [],
            recentExpenses: [],
            searchedExp: [],
            singleExpenses: null,
        },
        rolesPermission: {
            data: [],
        },
        Transactions: {
            loading: false,
            data: [],
        },
        loan: {
            data: {},
            loading: false,
            TotalRegistered: null,
            Links: null,
            loanCounts: null,
            singleUserDetails: null,
            totalLoansCounts: null,
            TotalLoanUsers: null,
        },
        staffs: {
            staffCounts: 0,
            loading: false,
            data: {},
            addedStaff: 0,
        },
        currentAccount: {
            data: {},
            loading: false,
        },
        roles: {
            roleCounts: 0,
            loading: false,
            data: {},
            addedRoles: 0,
            singleRole: null,
        },
        customers: {
            customerCounts: 0,
            loading: false,
            data: {},
            accountsLinks: null,
            addedCustomers: 0,
            accountTransactions: null,
            AllAccountTransactions: null,
        },
        otherIncome: {
            data: null,
        },
        branches: {
            branchCounts: 0,
            loading: false,
            data: {},
            addedBranches: 0,
        },
        notification: {
            show: false,
            message: null,
            type: null,
            notificationCount: null,
        },
        // sidebar: [...sidebar],
        showBar: true,
    },

    getters: {
        getUserPermission(state) {
            return state.user.userPermission;
        },
        ability() {
        return new Ability([], {
            subjectName(subject) {
            return !subject || typeof subject === 'string'
                ? subject
                : subject[TYPE_KEY]
            }
        })
    }
    },
    actions: {
        getUserRolePermission({commit, getters}, id) {
            return axiosClient.get(`/GetRolesPermission/${id}`).then((res) => {
                // console.log(res.data);
                // getters.ability.update(
                //     {subject: 'all', actions: JSON.stringify(res.data)}
                // );
                commit("setUsersRolePermission", res.data);
            });
        },
        getRolePermission({commit}, id) {
            return axiosClient.get(`/GetRolesPermission/${id}`).then((res) => {
                commit("setRolePermission", res.data);
            });
        },
        // getRolePermission({commit}, id) {
        //     return axiosClient.get(`/getUserRolePermission/${id}`).then((res) => {
        //         commit("setUserRolePermission", res.data);
        //     });
        // },
        assignPermission({commit}, {value, id}) {
            return axiosClient.post(`/newPermission/${id}`,value).then((res) =>{
                commit("setRolePermission", res.data);
            })
        },
        getsingleRole({commit}, id) {
            return axiosClient.get(`singleRole/${id}`).then((res) => {
                commit("setSingleRoleVal", res.data)
            })
        },
        getAbilities({commit}) {
            return axiosClient.get('/getAllLoanUsers').then((res) => {
                // commit('setTotalLoansUsers', res.data);
                // return res;
                console.log(res.data);
            })
        },
        SubmitPayment({commit}, payment) {
            return axiosClient.post('/postLoanUsersPayment', payment).then((res) => {
                commit('setLoansPayment', res.data);
                return res;
            })
        },
        getARegisteredLoanUser({commit}) {
            return axiosClient.get('/getAllLoanUsers').then((res) => {
                commit('setTotalLoansUsers', res.data);
                return res;
            })
        },
        getAllTotalLoanCount({commit}) {
            return axiosClient.get('/AlltotalLoansCounts').then((res) => {
                commit('setTotalLoansCounts', res.data);
                return res;
            })
        },
        getNotificationCounts({commit}) {
            return axiosClient.get('/notifications').then((res) => {
                commit('setNotificationCount', res.data)
                return res;
            })
        },
        getSingleLoan({commit}, id) {
            commit("setRegisteredLoanLoading", true);
            
            return axiosClient.get(`loan/${id}`).then((res) => {
                // console.log(res.data);
                commit("setRegisteredLoanLoading", false);
                commit('setRegisteredUserLoanDetails', res.data)
            })
        
        },
        deleteRegisteredLoansAccount({commit}, id) {
            return axiosClient.delete(`/loan/${id}`);
        },
        getAllLoanCount({commit}) {
            return axiosClient.get('/loan_users_count').then((res) => {
                commit("SetCurrentLoanCount", res.data);
            })
        },
        disburse({commit}, amount) {
            return axiosClient.post('/disbursement', amount);
        },
        GetAllRegisteredLoan({ commit }, { url = null } = {}) {
            url = url || "/loan";
            commit("setCurrentLoanLoading", true);
            return axiosClient.get(url).then((res) => {
                commit("setRegisteredLoan", res.data);
                commit("setRegisteredLoanLinks", res.data);
                commit("setCurrentLoanLoading", false);
            });
        },
        getLoan({ commit }, id) {
            commit("setCurrentLoanLoading", true);
            return axiosClient.get(`/loan/${id}`).then((res) => {
                commit("setCurrentLoanLoading", false);
                commit("setCurrentLoan", res.data);
                return res;
            });
        },
        SubmitForm({ commit, dispatch }, loan) {
            // console.log(loan);
            delete loan.image_url;
            for (let index = 0; index < loan.guarantors.length; index++) {
                const element = loan.guarantors[index];
                delete element.image_url;
            }
            let response;

            if (loan.id) {
                response = axiosClient
                    .put(`loan/${loan.id}`, loan)
                    .then((res) => {
                        commit("setCurrentLoan", res.data);
                        return res;
                    });
            } else {
                response = axiosClient.post("/loan", loan).then((res) => {
                    commit("setCurrentLoan", res.data);
                    return res;
                });
            }
            return response;
        },
        getRecentAddedIncome({ commit }) {
            return axiosClient.get("/recent-income").then((res) => {
                commit("setRecentIncome", res.data);
            });
        },
        submitOtherIncome({ commit }, incomes) {
            // console.log(incomes);
            return axiosClient.post("/income", incomes).then((res) => {
                commit("setOtherIncome", res.data);
                return res.data;
            });
        },
        getTotalDebitAndCreditTrans({ commit }, account_id) {
            return axiosClient
                .get(`total-debit-and-credit/${account_id}`)
                .then((res) => {
                    commit("SetCreditDebitBalance", res.data);
                    return res.data;
                });
        },

        getAccountTransactions({ commit }, account_id) {
            return axiosClient
                .get(`accounts-transactions/${account_id}`)
                .then((res) => {
                    commit("seAccountTransaction", res.data);
                });
        },
        searchAccountinformation({ commit }, details) {
            return axiosClient.get(`search-accounts/${details}`).then((res) => {
                commit("SetSearchedResults", res.data);
                commit("setSearchedLinks", res.data);
                return res.data;
            });
        },
        getAllExpenses({ commit }, { url = null } = {}) {
            commit("setLoadingState", true);
            url = url || "/expenses";
            return axiosClient
                .get(url)
                .then((res) => {
                    commit("setLoadingState", false);
                    commit("setAllExpensesLinks", res.data.links);
                    commit("setAllExpenses", res.data.data);
                })
                .catch((err) => {
                    commit("setLoadingState", false);
                });
        },
        GetExpenses({ commit }, id) {
            return axiosClient.get(`/expenses/${id}`).then((res) => {
                commit("setSingleExpenses", res.data);
            });
        },
        DeleteExpenses({ commit }, id) {
            return axiosClient.delete(`expenses/${id}`);
        },
        SearchForExpenses({ commit }, query) {
            return axiosClient.get(`search-expenses/${query}`).then((res) => {
                commit("setSearchForExpenses", res.data);
                return res.data;
            });
        },
        GetExpensesBalance({ commit }) {
            return axiosClient.get("/calculate-expenses").then((res) => {
                commit("SetExpensesAmount", res.data);
                return res.data.sumExpenses;
                // console.log(typeof(res.data.sumExpenses));
            });
        },
        getRecentExpenses({ commit }) {
            commit("setExpensesLoadingState", true);
            return axiosClient
                .get("/recent-expenses")
                .then((res) => {
                    commit("SetRecentExpenses", res.data);
                    commit("setExpensesLoadingState", false);
                    return res.data;
                })
                .catch((err) => {
                    commit("setExpensesLoadingState", false);
                });
        },
        submitExpenses({ commit }, expenses) {
            return axiosClient.post("/expenses", expenses).then((res) => {
                commit("setExpenses", res.data);
                return res.data;
            });
            // console.log(expenses);
        },
        UpdateRolesPermission({ commit }, { data, num }) {
            const nums = parseInt(num);
            console.log(nums);
            return axiosClient
                .put(`/permission/${nums}`, { data })
                .then((res) => {
                    commit("setPermission", res.data);
                    return res;
                });
        },
        logout({ commit }) {
            return axiosClient.post("/logout").then((response) => {
                commit("logout");
                return response;
            });
        },
        CreditAccount({ commit }, transactions) {
            console.log(transactions);
            return axiosClient
                .post("/transaction", transactions)
                .then((res) => {
                    return res.data;
                });
        },
        getAccountDetail({ commit }, accountdetails) {
            return axiosClient
                .get(`/get-account-detail/${accountdetails}`)
                .then((res) => {
                    commit("setAcountDetail", res.data);
                    return res;
                });
        },
        GetAllAccounts({ commit }) {
            commit("setAcountLoadingStatus", true);
            return axiosClient.get("/allAccounts").then((res) => {
                commit("SetAllAccountDetails", res.data);
                commit(
                    "setAccountPaginationLink",
                    res.data.total_accounts.links
                );
                commit("setAcountLoadingStatus", false);
            });
        },
        UpdateAccountDetails({ commit }, account) {
            return axiosClient
                .put(`/account/${account.id}`, account)
                .then((res) => {
                    commit("setCurrentAccountDetails", res.data);
                    return res;
                });
        },

        getAccount({ commit }, id) {
            commit("setCurrentAccountLoading", true);
            return axiosClient
                .get(`account/${id}`)
                .then((res) => {
                    commit("setCurrentAccountDetails", res.data);
                    commit("setCurrentAccountLoading", false);
                    // commit("setAccountTransactions", res.data);
                    return res;
                })
                .catch((err) => {
                    commit("setCurrentAccountLoading", false);
                    throw err;
                });
        },

        // getUser({commit}) {
        //   return axiosClient.get('/user')
        //   .then(res => {
        //     console.log(res);
        //     commit('setUser', res.data)
        //   })
        // },
        getUser({ commit, dispatch }) {
            return axiosClient.get("/user").then((res) => {
                commit("setUser", res.data.user);
                dispatch("getUserRolePermission", res.data.user.role_id);
                commit("setPermission", res.data.permission);
                // console.log();
            });
        },
        deleteAccount({ commit }, id) {
            // console.log(id);
            return axiosClient.delete(`/account/${id}`);
        },
        getAccountsCount({ commit }) {
            return axiosClient.get("/accounts-counts").then((res) => {
                commit("SetAccountCounts", res.data);
                return res;
            });
        },
        GetAllClients({ commit }, { url = null } = {}) {
            commit("setGetCurrentAccountsLoading", true);
            url = url || "/account";
            return axiosClient.get(url).then((res) => {
                commit("setAccountsDetails", res.data.accounts);
                commit("setGetCurrentAccountsLoading", false);
                return res;
            });
        },
        Createaccount({ commit, dispatch }, account) {
            commit("setAccountLoadingStatus", true);
            delete account.image_url;
            return axiosClient.post("/account", account).then((res) => {
                commit("setAccountLoadingStatus", false);
                commit("setCurrentAccount", res.data);
                return res.data;
            });
        },
        deleteStaff({ commit }, staffId) {
            return axiosClient.delete(`/deleteStaff/${staffId}`);
        },
        createStaff({ commit }, staff) {
            return axiosClient.post("/register", staff).then((res) => {
                commit("setCurrentStaffs", res.data);
                return res;
            });
        },
        DeleteAllBranches() {
            return axiosClient.delete("/deleteAllBranches");
        },
        DeleteBranch({ commit, dispatch }, id) {
            return axiosClient.delete(`/branch/${id}`).then((res) => {
                dispatch("GetAllBranches");
                commit("notify", {
                    type: "success",
                    message: "Branch was deleted successfully",
                });
                return res;
            });
        },
        GetAllStaffs({ commit }) {
            commit("setCurrentStaffsLoading", true);
            return axiosClient.get("/staffs").then((res) => {
                commit("setCurrentStaffsLoading", false);
                commit("setCurrentStaffs", res.data);
            });
        },
        GetAllBranches({ commit }) {
            commit("setCurrentBranchLoading", true);
            return axiosClient.get("/branch").then((res) => {
                commit("setCurrentBranchLoading", false);
                commit("setCurrentBranch", res.data);
                return res;
            });
        },
        CreateBranch({ commit }, branch) {
            return axiosClient.post("/branch", branch).then((res) => {
                commit("setCurrentBranches", res.data);
                return res;
            });
        },
        DeleteRole({ commit, dispatch }, id) {
            return axiosClient.delete(`role/${id}`).then((res) => {
                dispatch("getRoles");
                commit("notify", {
                    type: "success",
                    message: "role have been deleted successfully",
                });
                return res;
            });
        },
        getBranchesCount({ commit }) {
            return axiosClient.get("/branch-counts").then((res) => {
                commit("setBranchCount", res.data);
                return res;
            });
        },
        getStaffCounts({ commit }) {
            return axiosClient.get("/staff-counts").then((res) => {
                commit("setStaffCounts", res.data);
                return res;
            });
        },
        getRolesCount({ commit }) {
            return axiosClient.get("/role-counts").then((res) => {
                commit("setRolesCount", res.data);
                return res;
            });
        },
        DeleteAllSurvey() {
            return axiosClient.delete("/delete");
        },
        getRoles({ commit }) {
            commit("setRolesLoading", true);
            return axiosClient.get("/role").then((res) => {
                commit("setRolesLoading", false);
                commit("setRoles", res.data);
                return res;
            });
        },
        CreateRole({ commit }, role) {
            return axiosClient.post("/role", role).then((res) => {
                commit("setCurrentRoles", res.data);
                commit("AddRolesBonus", 1);
                return res;
            });
        },
        login({ commit, dispatch }, user) {
            return axiosClient.post("/login", user).then(({ data }) => {
                console.log(data.user);
                console.log(data.token);
                store.dispatch("getUserRolePermission", data.user.role_id);
                commit("setUser", data.user);
                commit("setToken", data.token);
                return data;
            });
        },
        
        register({ commit }, user) {
            commit("setCurrentRegisteringLoading", true);
            return axiosClient
                .post("/register", user)
                .then(({ data }) => {
                    commit("setUser", data.user);
                    commit("setToken", data.token);
                    commit("setCurrentRegisteringLoading", false);
                    return data;
                })
                .catch(() => {
                    commit("setCurrentRegisteringLoading", false);
                });
        },
    },
    mutations: {
        setUsersRolePermission: (state, permission) => {
            state.rules = JSON.parse(JSON.stringify(permission));
            // console.log(typeof JSON.parse(JSON.stringify(permission)));
        },
        setUserRolePermission: (state, userPermission) => {

        },
        setRolePermission: (state, permissions) => {
            state.rolesPermission.data = permissions
        },
        setSingleRoleVal: (state, role) => {
            state.roles.singleRole = role;
        },
        setTotalLoansUsers: (state, loans) => {
            state.loan.TotalLoanUsers = loans;
        },
        setTotalLoansCounts: (state, counts) => {
            state.loan.totalLoansCounts = counts;
        },
        setNotificationCount: (state, count) => {
            state.notification.notificationCount = count;
        },
        setRegisteredLoanLoading: (state, loading) => {
            state.loan.loading = loading;
        },
        setRegisteredUserLoanDetails: (state, data) => {
            state.loan.singleUserDetails = data;
        },
        SetCurrentLoanCount: (state, counts) => {
            state.loan.loanCounts = counts;
        },
        setRegisteredLoanLinks: (state, links) => {
            state.loan.links = links.loans.links;
        },
        setRegisteredLoan: (state, registeredLoan) => {
            state.loan.TotalRegistered = registeredLoan.loans;
        },
        setCurrentLoanLoading: (state, loading) => {
            state.loan.loading = loading;
        },

        setCurrentLoan: (state, loan) => {
            state.loan.data = loan;
        },
        setRecentIncome: (state, recentIncome) => {
            state.otherIncome.data = recentIncome;
        },
        setOtherIncome: (state, income) => {
            state.otherIncome.data = income;
        },
        SetCreditDebitBalance: (state, balance) => {
            state.accountBalance.totalCredit = balance.credit;
            state.accountBalance.totalDebit = balance.debit;
        },
        seAccountTransaction: (state, transactions) => {
            state.customers.AllAccountTransactions = transactions;
        },
        setAccountPaginationLink: (state, links) => {
            state.allAccounts.AllLinks = links;
        },
        SetSearchedResults: (state, results) => {
            state.allAccounts.searchedAccounts = results.data;
        },
        setSearchedLinks: (state, links) => {
            state.allAccounts.links = links.links;
        },
        setAllExpensesLinks: (state, links) => {
            state.expenses.totalExpensesLinks = links;
        },

        setLoadingState: (state, loading) => {
            state.expenses.loading = loading;
        },
        setAllExpenses: (state, expenses) => {
            state.expenses.AllExpenses = expenses;
        },
        setSingleExpenses: (state, expenses) => {
            state.expenses.singleExpenses = expenses;
        },
        setExpenses: (state, expenses) => {
            state.expenses.recentExpenses = expenses;
        },
        setSearchForExpenses: (state, result) => {
            state.expenses.searchedExp = result;
        },
        SetExpensesAmount: (state, expensesAmount) => {
            state.expenses.totalExpenses = expensesAmount;
        },
        SetRecentExpenses: (state, expenses) => {
            state.expenses.recentExpenses = expenses;
        },
        setExpensesLoadingState: (state, loading) => {
            state.expenses.loading = loading;
        },
        setPermission: (state, permission) => {
            state.user.userPermission = permission;
        },
        SetTransactions: (state, transactions) => {},
        setAcountDetail: (state, detail) => {
            state.allAccounts.account_detail = detail;
        },
        SetAllAccountDetails: (state, accounts) => {
            state.allAccounts.data = accounts;
        },
        setAcountLoadingStatus: (state, loading) => {
            state.allAccounts.loading = loading;
        },
        setCurrentAccountLoading: (state, loading) => {
            state.currentAccount.loading = loading;
        },
        setCurrentAccountDetails: (state, details) => {
            state.currentAccount.data = details.data;
        },
        setAccountLoadingStatus: (state, loading) => {
            state.customers.loading = loading;
        },

        SetAccountCounts: (state, accountCounts) => {
            state.customers.customerCounts = accountCounts;
        },
        setAccountsDetails: (state, account) => {
            state.customers.data = account;
        },
        setGetCurrentAccountsLoading: (state, loading) => {
            state.customers.loading = loading;
        },
        setCurrentAccount: (state, account) => {
            state.customers.data = account.data;
        },
        setStaffCounts: (state, staffs) => {
            state.staffs.staffCounts = staffs;
        },
        setCurrentStaffsLoading: (state, loading) => {
            state.staffs.loading = loading;
        },
        setCurrentStaffs: (state, staff) => {
            state.staffs.data = staff;
        },
        setCurrentBranch: (state, BranchData) => {
            state.branches.data = BranchData;
        },
        setCurrentBranchLoading: (state, loading) => {
            state.branches.loading = loading;
        },
        AddRolesBonus: (state, num) => {
            state.roles.addedRoles += num;
        },
        setBranchCount: (state, branches) => {
            state.branches.branchCounts = branches;
        },
        setRolesCount: (state, counts) => {
            state.roles.roleCounts = counts;
        },
        setRoles: (state, roles) => {
            state.roles.data = roles;
        },
        setRolesLoading: (state, loading) => {
            state.roles.loading = loading;
        },
        setCurrentRoles: (state, role) => {
            state.roles.data = role.data;
        },
        setCurrentBranches: (state, branch) => {
            state.branches.data = branch.data;
        },
        setCurrentRegisteringLoading: (state, loading) => {
            state.user.isLoading = loading;
        },
        ChangeStatus: (state) => {
            state.showBar = !state.showBar;
        },
        logout: (state) => {
            state.user.token = null;
            state.user.data = {};
            sessionStorage.removeItem("TOKEN");
            sessionStorage.removeItem("TYPE");
        },
        setUser: (state, user) => {
            // console.log(user);
            state.user.data = user;
            state.user.type = user.role;
            // sessionStorage.setItem('TOKEN', user.token);
            sessionStorage.setItem("TYPE", user.role);
        },
        setToken: (state, token) => {
            state.user.token = token;
            sessionStorage.setItem("TOKEN", token);
        },
        notify: (state, { message, type }) => {
            state.notification.show = true;
            state.notification.type = type;
            state.notification.message = message;
            setTimeout(() => {
                state.notification.show = false;
            }, 5000);
        },
    },
    modules: {},
});

export default store;
