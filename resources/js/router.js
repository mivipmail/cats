import { createRouter } from "vue-router";
import { createWebHistory } from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/', component: () => import('./components/Cat/Index.vue'),
            name: 'cat.index',
        },
        {
            path: '/cats/create', component: () => import('./components/Cat/Edit.vue'),
            name: 'cat.create',
        },
        {
            path: '/cats/:id/edit', component: () => import('./components/Cat/Edit.vue'),
            name: 'cat.edit',
        },
        {
            path: '/cats/:id', component: () => import('./components/Cat/Show.vue'),
            name: 'cat.show',
        },
        //---------------------------------------------------------------------------------
        {
            path: '/breeds', component: () => import('./components/Breed/Index.vue'),
            name: 'breed.index',
        },
        {
            path: '/breeds/create', component: () => import('./components/Breed/Edit.vue'),
            name: 'breed.create',
        },
        {
            path: '/breeds/:id/edit', component: () => import('./components/Breed/Edit.vue'),
            name: 'breed.edit',
        },
        {
            path: '/breeds/:id', component: () => import('./components/Breed/Show.vue'),
            name: 'breed.show',
        },
        //---------------------------------------------------------------------------------
        { 
            path: '/404', component: () => import('./components/NotFound.vue'),
            name: 'page404'
        },
        {
            path: '/:catchAll(.*)', redirect: '/404',
        },
    ], // short for `routes: routes`
})

export default router
