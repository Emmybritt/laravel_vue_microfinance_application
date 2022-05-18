import { ref, computed, onMounted, onServerPrefetch, watch, reactive } from "vue";
import { useStore } from "vuex";
import {useRoute} from "vue-router"

export function usePermission() {
    const store = useStore();





    const userPerm = reactive({
        permission: null
    });

 
    watch(() => store.state.user.userPermission, (newValue, oldValue) => {
        // userPerm.permission = JSON.parse(newValue)

        setTimeout(() => {
            userPerm.permission = Object.values(JSON.parse(newValue))
        }, 3000)
   })



    const route = useRoute();



    let routeName = ref(null);

    let isRoute = ref(false);

    let isUserPermission = ref(false);


    // function checkUserPermission(key) {
    //     if (!userPerm.permission) return true
    //     let isPermitted = reactive({is: false});
    //     for(let d of userPerm.permission){
    //         // console.log(d);
    //         if (route.name == d.name) {
    //             if (d[key]) {
    //                 isPermitted.is = true
    //                 break;
    //             }else{
    //                 break;
    //             }
    //         }
    //     }
    //     return isPermitted.is
    // }
   
    


    const isReadPermited = computed(() => {
            if (!userPerm.permission) return true
            let isPermitted = reactive({is: false});
            for(let d of userPerm.permission){
                // console.log(d);
                if (route.name == d.name) {
                    if ('read') {
                        isPermitted.is = true
                        break;
                    }else{
                        break;
                    }
                }
            }
            return isPermitted.is
    });

    const isWritePermitted = computed(() => {
        if (!userPerm.permission) return true
            let isPermitted = reactive({is: false});
            for(let d of userPerm.permission){
                // console.log(d);
                if (route.name == d.name) {
                    if ('write') {
                        isPermitted.is = true
                        break;
                    }else{
                        break;
                    }
                }
            }
            return isPermitted.is
    });

    const isUpdatePermitted = computed(() => {
        if (!userPerm.permission) return true
            let isPermitted = reactive({is: false});
            for(let d of userPerm.permission){
                console.log(d);
                if (route.name == d.name) {
                    // if ('update') {
                    //     isPermitted.is = true
                    //     break;
                    // }else{
                    //     break;
                    // }
                    // console.log(d);
                }
            }
            return isPermitted.is
    });
    const isDeletePermitted = computed(() => {
        if (!userPerm.permission) return true
            let isPermitted = reactive({is: false});
            for(let d of userPerm.permission){
                // console.log(d);
                if (route.name == d.name) {
                    if ('delete') {
                        isPermitted.is = true
                        break;
                    }else{
                        break;
                    }
                }
            }
            return isPermitted.is
    })

    return { 
        userPerm,
        isReadPermited, 
        routeName, 
        isRoute, 
        isUserPermission, 
        userPerm, 
        isReadPermited, 
        isWritePermitted,  
        isUpdatePermitted,
        isDeletePermitted,
    }

}
