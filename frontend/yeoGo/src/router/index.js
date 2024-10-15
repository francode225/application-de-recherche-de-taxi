import { createRouter, createWebHistory } from 'vue-router'
import connexionView from '@/views/connexionView.vue'
import LandingView from '@/views/LandingView.vue'
import PositionView from '@/views/PositionView.vue'
import axios from "axios";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: connexionView,
    },
    {
      path: '/landing',
      name: 'landing',
      component: LandingView,
    },
    {
      path: '/position',
      name: 'position',
      component: PositionView,
    }
  ]
})

router.beforeEach((to, from)=>{
  if (to.name === 'login'){
    return true
  }

  if (!localStorage.getItem('token')){
    return {
      name: 'login'
    }
  }
  verifieTokenAuthentification()
})

const verifieTokenAuthentification = () =>{
  const token = localStorage.getItem('token');

  if (token){
    axios.get('http://localhost:8000/api/user', {
      headers: {
        Authorization: `Bearer ${token}`
      }
    })
        .then((response)=>{
          console.log('Utilisateur authentifié', response.data);
        })
        .catch((error)=>{
          localStorage.removeItem('token')
          router.push({
            name:'login'
          })
        })
  }
  else {
    console.error('Pas de token trouvé');
    router.push({ name: 'login' });
  }
}

export default router
