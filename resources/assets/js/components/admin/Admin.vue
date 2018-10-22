<template>
    <div class="container">   
        
     
        <div>
           
             <!-- <div class="row w-100 d-flex justify-content-center">
                 <img src="/storage/images/app/logo.png" style="width : 200px ; height: 110px" alt="logo">
             </div>  --> 
                <hr>
                <h1>Administrar Productos</h1>
                <button @click="toggleHidePrices" 
                        v-if="config && !config.hide_prices" class="btn btn-lg btn-outline-danger">
                    Ocultar precios al publico
                </button>
                <button @click="toggleHidePrices" v-else class="btn btn-lg btn-outline-success">
                    Mostrar precios al publico
                </button>
                <hr>
                <div class="row w-100">
                    <div class="col-12 col-lg-8">
                        <admin-create :supercategories="supercategories" @productSaved="refresh"></admin-create>
                    </div>
                    <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                        <h4>Cambiar precios masivo</h4>
                        <h5> {{selectedProducts.length}} Productos seleccionados </h5>
                        <button @click="selectAllProducts" class="btn btn-sm btn-outline-danger mb-2">Seleccionar todos</button>
                        <div class="d-flex justify-content-center"> 
                            <button class="mr-2" @click="variation-=1">-</button>
                            <input style="width:45px; text-align-center" type="number" v-model="variation"> %
                            <button class="ml-2" @click="variation+=1">+</button>
                        
                        </div>
                            <button class="btn btn-md btn-outline-success mt-1" v-if="variation != 0 && selectedProducts.length > 0" @click="applyVariation">Aplicar</button>
                    </div>
                </div>
                <hr>
                <div >
                    <div v-for="category in categories" :key="category.id" class="card flex-wrap">
                        <div class="card-header" :id="category.id">
                            <div class="d-flex align-items-center justify-content-start">
                                
                                    <input type="checkbox" class=" form-control" 
                                            v-model="category.selected" @change="categoryChekbox(category)">
                                    <h5 class="mb-0 ">
                                        {{category.name.ucfirst()}}
                                    </h5>
                            
                            </div>
                        </div>
                        <div :id="'category-'+category.id" class="" 
                              aria-labelledby="headingOne" >
                            <div class="card-body">
                            <table class="table table-striped table-bordered ">
                                <thead class="">
                                    <th >imagen</th>
                                    <th>Codigo</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                </thead>
                                <transition-group tag="tbody" 
                                                    enter-active-class="animated slideInLeft faster "
                                                    leave-active-class="animated fadeOutDown faster position-absolute ">
                                    <tr v-for="product in category.products" :key="product.id">
                                        <td >
                                            <img v-if="product.images.length > 0" 
                                                  :src="product.images[0].url" 
                                                  :alt="product.name" 
                                                  @click="imgModal(product)">  
                                            <img v-else src="/storage/images/app/no-image.png" 
                                                alt="no-image" @click="imgModal(product)"> 
                                        </td>
                                        <td>  
                                            <input v-model.lazy="product.code" @change="saveChange(product,'code')" type="text" class="nametd"> 
                                        </td>
                                        <td>  
                                            <textarea rows="2" placeholder="Nombre" v-model.lazy="product.name" @change="saveChange(product,'name')" type="text"> </textarea> 
                                            <textarea placeholder="Descripcion" v-model="product.description" @change="saveChange(product,'description')" rows="3"></textarea>
                                        </td>
                                        
                                        <td class="text-info text-center"> 
                                            $<input style="width:80%" type="number" v-model.lazy="product.price" @change="saveChange(product,'price')"> 
                                            <button class="btn btn-block mt-3" :class="{'bg-focus white-bold':product.offer}" @click="toggleOffer(product)">Oferta</button>
                                        </td>                
                                        <td class="d-flex flex-column justify-content-center align-items-center">
                                            <input type="checkbox" class="form-control" v-model="product.selected">
                                            <button @click.prevent="deleteProduct(product)" class="btn btn-sm btn-outline-danger m-1">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <button @click.prevent="togglePause(product)" class="btn btn-sm m-1" :class="{'btn-info' : !product.paused, 'btn-success': product.paused}">
                                                <i :class="{'fa fa-pause-circle' : !product.paused , 'fa fa-play' : product.paused}"></i>
                                            </button>
                                            
                                        </td>
                                    </tr>
                                </transition-group>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                <image-modal :product="product"  ref="modal" @refresh="refresh()"></image-modal>
        </div>

        
    </div>
</template>

<script>
import imageModal from './Img-modal.vue';
import adminCreate from './Create.vue';
import { mapActions } from 'vuex';
    export default {
        components : {
            imageModal : imageModal,
            adminCreate : adminCreate
        },
        computed : {
            supercategories()
            {
                return this.$store.getters.getSupercategories;
            },
            config(){
                return this.$store.getters.getConfig;
            },
            selectedProducts()
            {
                var list =[];
                this.categories.forEach(cat => {
                    cat.products.forEach(prod => {
                        if (prod.selected)
                        {
                            list.push(prod);
                        }
                    });
                });
                return list;
            }
        },
        data(){
            return {
                variation : 0,
                categories : [],
                list : [],
                product : null,
                showModal : false,
            }
        },
        methods : {
             ...mapActions({
            fetchUser : 'fetchUser',
            fetchConfig : 'fetchConfig',
            }),
            toggleHidePrices(){
                if (this.config.hide_prices)
                {
                    this.config.hide_prices =0;
                }else{
                    this.config.hide_prices =1;
                }
                var vm = this;
                this.$http.put('/admin/config',{field:'hide_prices',value:this.config.hide_prices})
                    .then(response => {
                       vm.fetchConfig;
                       console.log(vm.config.hide_prices);
                    });
            },
            toggleOffer(product){
                product.offer = ! product.offer;
                var data = {
                    product : product.id,
                    field : 'offer',
                    value : product.offer ? 1 : 0
                }
                $.ajax({
                    method : 'put',
                    data : data,
                    url : '/admin/product'
                });
            },
            togglePause(product){
                var vm = this;
                product.paused = !product.paused;
                vm.saveChange(product,'paused');
                for (const key in vm.categories) {
                    if (vm.categories.hasOwnProperty(key)) {
                        const category = vm.categories[key];
                        for (const k in category.products) {
                            if (category.products.hasOwnProperty(k)) {
                                const prod = category.products[k];
                                if (prod.id == product.id )
                                {
                                    vm.categories[key].products[k].paused = product.paused;
                                    return;
                                }
                            }
                        }
                    }
                }

                
            },
            deleteProduct(product){
                var vm = this;
                this.$http.delete('/admin/product/'+product.id)
                    .then(response => {
                        // console.log(response);
                        for (const key in vm.categories) {
                            if (vm.categories.hasOwnProperty(key)) {
                                const cat = vm.categories[key];
                                for (const k in cat.products) {
                                    if (cat.products.hasOwnProperty(k)) {
                                        const prod = cat.products[k];
                                        if(prod.id == product.id)
                                        {
                                            vm.categories[key].products.splice(k,1);
                                            if (vm.categories[key].products.length == 0){
                                                vm.categories.splice(key,1);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        
                    });
            },
            logme(e){console.log(e)},
            refresh(){
                var vm = this;
                $.ajax({
                    url : 'api/categories',
                    success(response){
                         vm.categories = _.sortBy(response,'name');
                    }
                });
            },
            saveChange(product,field){
                var data = {
                    product : product.id,
                    field : field,
                    value : product[field]
                }
                if (data.field == 'paused')
                {
                    data.value = data.value ? 1 : 0;
                }
                $.ajax({
                    method : 'put',
                    data : data,
                    url : '/admin/product'
                });
            },
            imgModal(product){
                this.product = product;
                this.showModal = true;
                let element = this.$refs.modal.$el
                
                $(element).modal('show')
            },
            categoryChekbox(category)
            {
                 if (category.selected == undefined){
                        Vue.set(category,'selected',true);
                    }
                category.products.forEach(product => {     
                    if (product.selected == undefined)
                    {
                        Vue.set(product,'selected',true);
                    }
                   product.selected = category.selected;
                   console.log('product', product.selected);
                   console.log('category', category.selected);
                });
            },
            selectAllProducts()
            {
                this.categories.forEach(cat => {
                    if(cat.selected == undefined)
                    {
                      Vue.set(cat,'selected',true)
                    }
                    else {
                        cat.selected = true;
                    }

                    cat.products.forEach(prod => {
                        if (prod.selected == undefined)
                        {
                            Vue.set(prod,'selected',true)
                        }
                        else {
                            prod.selected = true;
                        }
                    });
                });
            },
            applyVariation()
            {
                var vm =this;
                var variation = 1+(this.variation/100);
                this.selectedProducts.forEach(prod => {
                    prod.price = prod.price * variation;
                    vm.saveChange(prod,'price');
                });
                vm.refresh();
                vm.variation = 0;
            }
        },
        created(){
            var vm = this;
            $.ajax({
                url : 'api/categories',
                success(response){
                    vm.categories = _.sortBy(response,'name');
                    
                    // console.log (vm.categories);
                }
            });

            
        },
        filters : {
            price(value){
                return  value.toFixed(2);
            }
        }
    }
</script>

<style scoped>
.btn-link {color : black;}
    td img {
        width: 10vw;
    }
textarea{
    width:100%;
}
input[type="checkbox"]{
    width: 25px;
    margin: 0 10px;
}
   @media(max-width: 600px){
       table,.container,.card,.card-body {font-size: 0.66rem ; padding : 0}
       
       th,td, input{
           white-space:nowrap;
           width: 13vw;
           padding: 2px;
       }
       .form-control{width: 20vw;}
       .nametd {width: 25vw;}
   }
</style>
