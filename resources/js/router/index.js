import { createRouter, createWebHistory } from 'vue-router'
import IndexView from '@/views/IndexView.vue'
import { getInitialLocale } from '@/utils/locale'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            redirect: `/${getInitialLocale()}`,
        },
        {
            name: 'Index',
            component: IndexView,
            path: '/:locale'
        },
        {
            name: 'Categories',
            path: '/:locale/categories',
            component: () => import('@/views/CategoriesView.vue'),
        },
        {
            name: 'Category',
            path: '/:locale/category/:slug',
            component: () => import('@/views/CategoryView.vue'),
        },
        {
            name: 'About',
            path: '/:locale/about',
            component: () => import('@/views/AboutView.vue'),
        },
    ]
})

export default router
