import axios from 'axios';
import {ref, computed, watch} from 'vue'
import { useRoute } from 'vue-router'
import axiosClient from './axios';


export function useAbPermissionAbility()
{
    const route = useRoute();

    watch(() => route, (newVal, oldVal) => {
        return axiosClient.get('/abilities').then(response => {
            // abili
        })
    })
}