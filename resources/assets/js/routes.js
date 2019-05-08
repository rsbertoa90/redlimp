
import Vue from 'vue';

import VueRouter from 'vue-router';
import VueMeta from 'vue-meta';

import {store} from './store/store.js';

Vue.use(VueRouter);
Vue.use(VueMeta);





function guardAdmin(to, from, next)
{  
    setTimeout(() => {
        
        let user = store.getters.getUser;
        if (user && user.role_id < 3)
        {
            next();
        }else{
            next('/login');
        }
        
    }, 100);
}

function guardLogin(to, from, next)
{  
    setTimeout(() => {
        
        let user = store.getters.getUser;
        if (user && user.role_id < 3)
        {
            next('/admin');
        }else{
           next();
        }
        
    }, 100);
}

/* 
import "core-js/modules/es6.promise";
import "core-js/modules/es6.array.iterator";
 */




import Home from  './components/home/Home.vue'; 
import Cotizer from './components/cotizer/Cotizer.vue';
import Contact from './components/contacto/Contacto.vue';
import Sucursales from './components/sucursales/Sucursales.vue';

import Decider from './components/supercategory/decider.vue'; 
import CategoryRouter from './components/category/Category-router.vue';
import Category from './components/category/Category.vue';
import Product from './components/category/product/Product.vue';

import Login from  './components/login/Login.vue';
import Admin from './components/admin/Admin.vue';
import Orders from  './components/admin/Orders.vue';
import Metadata from  './components/super/Super.vue';

import Upnext from './components/upnext/upnext.vue';
/* import SearchStatics from './components/admin/search-statics/Search-statics.vue'; */

const router = new VueRouter({
    scrollBehavior() {
        return { x: 0, y: 0 }
    },
    mode:'history',
    routes:[
       
        {
            path:'/login',
            name:'login',
            component:Login,
            beforeEnter:guardLogin
        },
        {
            path:'/admin',
            name:'admin',
            component:Admin,
            beforeEnter:guardAdmin
        },
       
        {
            path:'/admin/pedidos',
            name:'orders',
            component:Orders,
            beforeEnter:guardAdmin
        },
        {
            path:'/admin/metadata',
            name:'meta',
            component:Metadata,
            beforeEnter:guardAdmin
        },
        {
            path: '/',
            component: Upnext,
        },

        {
            path:'/',
            name:'home',
            component:Home
        },
       
        {
            path:'/contacto',
            name:'contacto',
            component:Contact
        },
        {
            path:'/sucursales',
            name:'sucursales',
            component:Sucursales
        },
        {
            path:'/cotizador',
            name:'cotizador',
            component: Cotizer
        },
       

       
       {
           path: '/:category_slug',
           component: CategoryRouter,
           children: [{
                   path: '',
                   component: Decider,
                   name: 'category'
               },
               {
                   path: ':product_slug',
                   component: Product,
                   name: 'product'
               }
           ]

       }
    ]
    
});

export default router;