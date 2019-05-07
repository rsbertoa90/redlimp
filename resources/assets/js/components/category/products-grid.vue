<template>
    <div class="row" v-if="products">
        <div v-for="product in products" :key="product.id"
                    v-if="!product.paused"
                 class="col-12 col-lg-4 mt-3" itemscope itemtype="https://schema.org/Product">
            
                <div class="card text-center p-1">
                    <div class="card-img-top" @click="show(product)" >
                        <v-lazy-image v-if="product.images[0]" :alt="product.name"
                        :src="product.images[0].url" 
                        
                        :title="product.name"
                        itemprop="image" />
                        <v-lazy-image v-else src="/storage/images/app/no-photo.png" 
                             alt="no hay foto" />
                    </div>
                    <div class="card-img-overlay" v-if="product.offer">
                        <span class="badge bg-focus white-bold "> Oferta! </span>
                    </div>
                    <div class="card-body p-0">
                        <h5 style="height:40px" class="card-title font-weight-bold" itemprop="name">{{product.name | ucFirst}}</h5>
                        <h5 v-if="config && !config.hide_prices" class="card-subtitle">${{product.price |price}}</h5>
                      <!--   <p class="card-text"> {{product.description}} </p> -->
                        <router-link :to="getSlug(product)" class="btn btn-outline-focus mt-2" itemprop="url">Ver mas</router-link>
                        <router-link to="/cotizador" class="btn btn-outline-success mt-2"> <span class="fa fa-shopping-cart"></span> Hacer un pedido</router-link>
                    </div>
                </div>
        </div>   
         <carousel v-if="carouselProduct" ref="modal" :product ="carouselProduct"></carousel>
    </div>
</template>

<script>
 import carousel from '../cotizer/Carousel.vue';
export default {
    components:{carousel},
    props:['products'],
    data(){
        return {
            carouselProduct : null
        }
    },
    methods:{ 
         getSlug(product){
            return this.$store.getters.getProductSlug(product);
        },
             show(product){
                if (product.images[0]){
                    this.carouselProduct = product;
                    this.showCarousel = true;
    
                    let element = this.$refs.modal.$el;
                  
                    $(element).modal('show');
                }
                else
                {
                    var content = document.createElement("img");
                    $(content).attr('src','/storage/images/app/no-photo.png');
                    content.style.width = '100%';
                    swal({content : content});
                }
            }
    }
    ,
    computed : {
            config(){
                return this.$store.getters.getConfig;
            }
        },
}
</script>

<style lang="scss" scoped>
    a{
        &:hover{
            text-decoration: none;
            color: inherit;
        }
    }
    img:hover{
        cursor: pointer;
    }
   .card-title,.card-subtitle{
       text-align: center;

   }
   .badge{
       margin-right: 80%;
       margin-top:2%;
       padding: 5px;
   }
</style>

