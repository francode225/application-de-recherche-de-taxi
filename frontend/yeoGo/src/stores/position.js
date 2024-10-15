import {ref, computed, reactive} from "vue";
import {defineStore} from 'pinia'

export const usePositionStore = defineStore('position ', ()=>{
    const destination = reactive({
        name:'',
        address: '',
        coordonnees:{
            lat:null,
            lng:null
        }
    })
    return { destination}
})