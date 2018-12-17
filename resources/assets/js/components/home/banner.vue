<template>
   <div class="row full">
       <a href="/cotizador" class="col-12 mb-3">
            <div>
                <v-lazy-image src="/storage/images/app/home1.jpg" alt="pedido online" />
            </div>
            <div class="overlay">
                <h1 class="big">PEDIDO ONLINE</h1>
                <h4>Envíos a todo el país</h4>
                <div>
                    <button class="btn home-btn"> HACER PRESUPUESTO </button>
                </div>
            </div>
       </a>
    <!--    <a href="/contacto" class="col-12 col-lg-3 p-1">
           <div class="text-center ">
               <div class="overflow-hidden">
                    <v-lazy-image class="img-container" src="/storage/images/app/contacto.jpg" alt="contacto" />
               </div>
               
                    <div class="sm-overlay">
                        <h4>CONTACTO</h4>
                    </div>
            </div>
       </a> -->
       <a v-for="sc in supercategories"
            :key="sc.id"
            :href="sc.slug" class="col-12 col-lg-4 p-1">
           <div class="text-center ">
               <div class="overflow-hidden">
                    <v-lazy-image class="img-container" :src="sc.image" alt="limpieza" />
               </div>
               
                    <div class="sm-overlay">
                        <h4> {{sc.name}} </h4>
                    </div>
                </div>
       </a>
       
       <!-- <a href="/sucursales" class="col-12 col-lg-3 p-1">
           <div class="text-center ">
               <div class="overflow-hidden">
                    <v-lazy-image class="img-container" src="/storage/images/app/sucursal.jpg" alt="sucursal" />
               </div>
               
                    <div class="sm-overlay">
                        <h4>SUCURSAL</h4>
                    </div>
                </div>
       </a> -->
      
    </div>
</template>

<script>
export default {
    computed:{
        supercategories(){
            return this.$store.getters.getSupercategories;
        }
    }
}
</script>

<style lang="scss">

.overflow-hidden{
    overflow: hidden;
}

        .img-container:hover{
            transform: scale(1.2);
              transition: all 1s;
        }
        .sm-overlay{
            h4{
                padding: 10px;
                background-color: #33333366;
                color:#fff;
                display: flex;
                width: 80%;
                margin:auto;
                text-align: center;
                justify-content: center;
            }
             position: absolute;
            top:60%;
            right:0;
            width: 100%;    
            text-align: center;

        }


    .home-btn{
        background-color: #888;
        border-radius: 0;
        padding:10px;
        color:#fff;
        font-weight: bold;
        margin-top: 30px;
        &:hover{
            background-color: #fff;
            border:1px solid #000;
            color:#000;
        }
    }

    
 
     .overlay{
            color: #333;
            text-align: center;
            display: flex;
            flex-direction: column ;
           /*  align-items: center; */
            justify-content: center;
            margin-top: 10px;
        }

        .full{
            margin-right: -16%;
        }

    @media(min-width:900px){
        .full{
    margin-right: -10%;
    margin-left: -9.5%;
}

           .relative{
        position:relative;
    }
    
        .overlay{
            color: #333;
            text-align: right;
            align-items: right;
            position: absolute;
            top:0;
            right:8%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height:100%;
            .big{
                font-size: 3.6rem;
      
    }
        }
    }

</style>
