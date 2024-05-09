import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: () => import('@/views/HomeView.vue')
    },
    {
      path: '/links',
      component: () => import('@/views/LinksView.vue')
    },
    {
      path: '/calendar',
      component: () => import('@/views/CalendarView.vue')
    }
  ]
})

export default router
