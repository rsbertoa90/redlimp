
<template>
<div class="row" v-if="offers.length > 0" >
  <hr>
  <div class="col-12 text-center">
    <h2 class="mb-4">OFERTAS DEL MES DE REDLIMP</h2>
  </div>
  <div class="col-12 row">
    <div v-for="product in offers" :key="product.id">
      
    </div>
  </div>
</div>
</template>

<script>
  export default {
    data() {
      return {
       
       
        
      }
    },
    computed:{
     
        offers(){
            return this.$store.getters['categories/getOffers'];
        }
    },
    methods: {
      appendSlide() {
        this.swiperSlides.push(this.swiperSlides.length + 1)
      },
      prependSlide() {
        this.swiperSlides.unshift(this.swiperSlides[0] - 1)
      },
      popSlide() {
        this.swiperSlides.pop()
      },
      shiftSlide() {
        this.swiperSlides.shift()
      }
    }
  }
</script>

<style scoped>


  .badge{
    font-size: 1.2rem;
  }
  .append-buttons {
    text-align: center;
    margin-top: 20px;
  }
  .append-buttons a {
    display: inline-block;
    margin: 0 10px;
  }
  .container{
      width: 100vw;
  }
  .card-img-overlay{
    max-height: 60%;
  }
</style>