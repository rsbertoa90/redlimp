<template>
    <div class="w-100" id="top">
        <div style="height:190px">

        </div>
        <div class="fixthis row d-flex justify-content-between pt-2 pb-1">
             <button aria-label="menu" 
             class="col-2 navbar-toggler
                    font-weight-bold" 
                     @click="shomenu" >
                <span class="fa fa-bars"></span>
            </button>
            <div class="col-8 mb-4 ">
                <div :class="{'displayed' : scrollOnTop,
                    'nondisplayed': !scrollOnTop}">
                    <image-logo></image-logo>
                </div>
            </div>
            <div class="col-2">

            </div>
        </div>
         
        <mobile-menu v-if="showMenu" :categories='categories' 
                        @close="showMenu=false"></mobile-menu>

  

    


         

      
    </div>
</template>

<script>
import imageLogo from '../images/image-logo.vue';
import mobileMenu from './mobile-menu.vue'
import {mapGetters} from 'vuex';
export default {
    components : {
        imageLogo,
        mobileMenu
    },
    data(){
        return{
            showMenu : false,
            scrollOnTop:true
     }
    },
    computed :{
        ...mapGetters({
            categories : 'categories/getCategories'
        }),
    },
    methods:{
        shomenu(){
            this.showMenu=true;
            window.scrollTo(0, 0);
        },
        handleScroll(){
          this.scrollOnTop =  window.scrollY < 100;
      }
      
    },
    created () {
        window.addEventListener('scroll', this.handleScroll);

    }
}
</script>

<style>
  
    .fixthis{
        position: fixed;
        z-index: 200;
        top:0;
        left:0;
        background-color: #f5f8fa;
    }

    .displayed{
    max-width: 100%;
    transition: max-width 0.5s ease-in-out;
}
.nondisplayed{
    max-width: 60%;
    margin-left: 24%;
    transition: max-width 0.5s ease-in-out;
    transition: margin-left 0.5s ease-in-out;
}

</style>