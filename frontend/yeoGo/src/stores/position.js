import {ref, computed, reactive} from "vue";
import {defineStore} from 'pinia'

const ObtenirPositionUser = ()=>{
    return new Promise((res, rej)=>{
        navigator.geolocation.getCurrentPosition((res,rej))
    })
}
export const usePositionStore = defineStore('position ', ()=>{
    const destination = reactive({
        name:'',
        address: '',
        coordonnees:{
            lat:null,
            lng:null
        }
    })
    const position_actuelle =reactive({
        coordonnees: {
            lat:null,
            lng: null
        }
    })
    const majPositionActuelle = async ()=>{
        const PositionUser = await ObtenirPositionUser()
        position_actuelle.coordonnees = {
            lat: PositionUser.coords.latitude,
            lng: PositionUser.coords.longitude
        }
    }
    return { destination, position_actuelle, majPositionActuelle}
})






























