import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state : {
        user : null,
        config : null,
        states:[],
        supercategories:null,
         categories: [],
         meta: [],
        searchTerm: '',
    },
    getters :{
         getTotal(store) {
                 var tot = 0;
                 if (store.categories && store.categories.length) {
                     store.categories.forEach(function (category) {
                         category.products.forEach(function (product) {
                             if (product.units > 0) {

                                 tot += product.price * product.units

                             }
                         });
                     });
                 }
                 return tot;
             },
             getList(store) {
                 if (store.categories && store.categories.length) {
                     var result = [];
                     store.categories.forEach(function (category) {
                         var prods = category.products.filter(function (el) {
                             return (el.units != null & el.units > 0);
                         });
                         if (prods.length > 0) {
                             result.push(prods);
                         }
                     });
                     return [].concat.apply([], result);
                 }


             },
        getCategories(store){
            return store.categories
        },
        getMeta(store){
            return store.meta
        },
        getSearchTerm(store){
            return store.searchTerm
        },
        getProductSlug: store => product => {
            if (store.categories && store.categories.length > 0){
                let category = store.categories.find(c => {
                    return c.id == product.category_id;
                });
                if (category)
                {
                    let slug = category.slug + '/' + product.slug;
                    slug = slug.replace ('//','/');
                    slug = slug.replace ('//','/');
                    return slug;
                }
            }
        },
        getSupercategories(store){
            return store.supercategories;
        },
        getSupercategory: (state) => (id) => {
               if (state.supercategories) {
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
        },
          getOffers(store) {
              if(store.categories && store.categories.length > 0){

                  let res = [];
                  
                  store.categories.forEach(cat => {
                      let prods = cat.products.filter(prod => {
                          return !prod.paused && prod.offer;
                      });
                      if (prods.length > 0) {
    
                          res = res.concat(prods);
                      }
                  });
                  return res;
              }
          },
          getProduct:store=>product_id=>{
              let res = null;
              if(store.categories && store.categories.length>0)
              {
                  store.categories.forEach(c => {
                      let pr = c.products.find(p => {
                        return p.id == product_id;
                      });
                      if(pr)
                      {
                        res=pr;  
                        return res;
                      }
                  });
              }
              return res;
          },
          getCategory:store=>category_id=>{
              if(store.categories){
                  return store.categories.find(c => {
                      return c.id==category_id;
                  })
              }
          }
    },
    mutations : {
        
        setCategories(state,payload){
            state.categories = payload; 
        },
        setMeta(state,payload){
            state.meta = payload; 
        },
        setSearchTerm(state,payload){
            state.searchTerm = payload; 
        },
        setUser(state,payload){
            state.user = payload; 
        },
        setConfig(state,payload){
            state.config = payload;
        },
        setStates(state,payload){
            state.states = payload;
        },
        setSupercategories(state,payload){
            state.supercategories = payload;
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
       fetchCategories: ({
           commit
       }, payload) => {

           Vue.http.get('/api/categories')
               .then(response => {
                   commit('setCategories', response.data);
                  
               });
       },
       fetchMeta: ({
           commit
       }, payload) => {

           Vue.http.get('/api/getMeta')
               .then(response => {
                   commit('setMeta', response.data);
                  
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
       fetchSupercategories: ({
           commit
       }, payload) => {

           Vue.http.get('/api/supercategories')
               .then(response => {
                   commit('setSupercategories', response.data);
               });
       },
    },
  

});

