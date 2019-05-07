<template>
    <div class="w-100">
        
        <div class="row d-flex justify-content-around align-items-center mt-4">
            
            <div class="col-3 offset-1">
                <form class="form-inline" action="/buscar">
                    <div class="input-group w-100">
                        <input type="text" class="form-control" 
                                 aria-label="Buscar productos"
                                placeholder="Que estas buscando?"
                                name="search">
                        <div class="input-group-prepend">
                            <span class="white-bold input-group-text bg-second d-flex justify-content-center" 
                                  id="basic-addon1">
                            <i class="fa fa-search"></i>
                                
                            </span>
                        </div>
                    </div>  
                </form>
            </div>
            
            <div class="col-4 p-4">
                <div class="p-4">
                    <image-logo></image-logo>
                </div>
            </div>

            <div class="col-4 flex-button">
                <span class="white-bold bg-second p-2 flex-button rounded" style="width:60px">
                    <span class="fa fa-phone"></span>
                </span>  
                <span class=" p-3 d-big"> 11 6234 4492</span>
            </div>
        </div>
        <div class="row nav-row">
            <div class="row col-12">
                <ul class="navbar">
                     <li> <router-link to="/cotizador"> <span class="fa fa-shopping-cart mr-2 text-focus"></span> HACE TU PEDIDO</router-link></li>
                     <li> <router-link to="/sucursales"> <span class="fas fa-map-marker-alt mr-2 text-focus"></span> UBICACION</router-link></li>
                    <li> <router-link to="/contacto">  <span class="fas fa-mobile-alt mr-2 text-focus"></span> CONTACTO</router-link></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row nav-row">
            <div class="row col-12">
                <ul class="navbar">
                    <li v-for="supercategory in supercategories" 
                        :key="supercategory.id"
                        :class="{'hovered':supercat_id == supercategory.id && (overMenu || overNav)}" @mouseleave="overNav=false"  
                        @mouseover="setsupercat(supercategory.id)"> 
                        <router-link :to="supercategory.slug">  
                            {{supercategory.name}} <i class="fa fa-chevron-down"></i>  
                        </router-link>
                    </li>
                    
                   
                </ul>
            </div>
        </div>
          <transition enter-active-class="animated fadeIn fastest"
                            leave-active-class="animated fadeOut fastest">
                    <div v-if="overMenu || overNav" 
                        @mouseover="overMenu=true"
                        @mouseleave="overMenu=false" 
                        class="nav-row row bg-first d-flex justify-content-center" >
                        <router-link v-for="category in menucats" :key="category.id"
                            :to="category.slug" 
                             class="subcat col-2 align-items-center d-flex justify-content-center">

                            {{category.name | uc}}
                        
                        </router-link>
                    </div> 
            </transition>
    </div>
</template>

<script>
import imageLogo from '../images/image-logo.vue';

import {mapGetters} from 'vuex';
export default {
    components : {
        imageLogo,
     
    },
    data(){
        return{
            supercat_id :1,
            overMenu : false,
            overNav : false,
     }
    },
    computed :{
        ...mapGetters({
            categories : 'getCategories',
            supercategories: 'getSupercategories'
        }),
        menucats(){
            return this.categories.filter(cat => {
                return cat.supercategory_id == this.supercat_id
            });
        }
    },
    methods:{
        setsupercat(id){
            this.supercat_id = id;
            this.overNav = true;
        },
        mouseleaved(){
            setTimeout(()=>{
               if (!this.showMenu){
                   this.supercat_id = null;
               }
            },1000);
        }
    }
}
</script>

<style lang="scss"  >

 $color-first : #d32381;


// El verde es 09cca2 
$color-second : #24FFB8;

// Rosa fuerte es ff0aaf
$color-focus: #1EAAFF; 

// Rosa claro es ff97dd
$color-back: #0FE0E8;

$color-other: #104DE8;

.fa-chevron-down{
    margin-left: 5px;
    font-weight: normal;
}

.subcat
{
    text-align: center;
    padding: 10px;
    margin-bottom: 5px;
   //border:1px solid #fff;
    cursor: pointer;
     color: #fff;
     font-weight: bold;
    &:hover{
       background-color: #eee;
        color: $color-first;
        border-bottom: 3px solid $color-second;
    }
}

.focus-nav-item
{
    background-color: $color-focus;
    width: 80%;
    margin-left: 10%;
    padding: 15px 6px;
}

.fa-phone{
    font-size: 2rem;
}
.nav-row{
           margin: 0px -7.5%;
       }
  
.navbar{
    /* font-weight: bold; */
    color:#000;
    display:flex;
    width: 100%;
    justify-content: space-around;
    align-items: center;
    margin: 0;
    padding: 0;
    li{
        a{
            &:hover{
                color:inherit;
                text-decoration: none;
            }
                display: flex;
                 align-items:center;
                justify-content: center;
                width: 100%;
                height: 100%;
        }

        cursor:pointer;
        padding: 1;
        
        height: 100%;
        width: 20%;
        display: flex;
        align-items:center;
        justify-content: center;
        &:hover{
             background-color: $color-first;
             color: #fff;
             border-bottom: 3px solid $color-second;
            }
        
    }

    .hovered{
           background-color: $color-first;
            color: #fff;
            border-bottom: 3px solid $color-second;
    }
 
     
   

}
</style>