import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
import categories from './modules/categories.js'
export const store = new Vuex.Store({
    state : {
        user : null,
        config : null,
        states:[],
        supercategories:[
            {id:1, name:'limpieza'},
            {id:2,name:'bazar'}
        ]
    },
    getters :{
        getSupercategories(store){
            return store.supercategories;
        },
        getSupercategory: (state) => (id) => {
               if (state.supercategories.length > 0) {
                   return state.supercategories.find(cat => {
                       return cat.id == id;
                   });
               }
           },
        getUser(store){
            return store.user;
        },
        getConfig(store){
            return store.config;
        },
        getStates(store){
            return store.states;
        },
        getCity: store => id => {
            if (store.states){
            
                store.states.forEach(state => {
                    let cit = state.cities.find(city => {
                        return city.id == id;
                    });
                    if (cit){
                        return cit;
                    }
                })  ;
            }
        }
    },
    mutations : {
        setUser(state,payload){
            state.user = payload;
           
        },
        setConfig(state,payload){
            state.config = payload;
        },
        setStates(state,payload){
            state.states = payload
        }
    },
    actions : {
       fetchUser: ({
           commit
       }, payload) => {

           Vue.http.get('/getUser')
               .then(response => {
                   commit('setUser', response.data);
                  
               });
       },
       fetchConfig: ({
           commit
       }, payload) => {

           Vue.http.get('/config')
               .then(response => {
                   commit('setConfig', response.data);
               });
       },
       fetchStates: ({
           commit
       }, payload) => {
           Vue.http.get('/api/states')
               .then(response => {
                   commit('setStates', response.data);
               });
       },
    },
    modules : {
        categories
    }

});

