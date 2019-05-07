<template>
    <div>
        <Category :category="objectProp"  v-if="comp=='Category'"></Category>
        <SuperCategory :supercategory="objectProp"  v-if="comp=='SuperCategory'"></SuperCategory>
        <err404  v-if="comp=='err404'"></err404>
    </div>
</template>

<script>
import SuperCategory from './Supercategory.vue';
import Category from '../category/Category.vue';
import err404 from './err404.vue';
export default {
    components:{Category,SuperCategory,err404},
    data(){
        return{
            objectProp:null
        }
    },
  
    computed:{
        categories(){
            return this.$store.getters.getCategories;
        },
        superCategories(){
         
            return this.$store.getters.getSupercategories;
        },
        comp(){
            if (this.categories && this.superCategories)
            {
               
               

                let category = this.categories.find (cat => {
                    let slug = '/'+cat.slug;
                    slug = slug.replace('//','/');
                    slug = slug.replace('//','/');
                    return slug === '/'+this.$route.params.category_slug;
                });

                if (!category)
                {
                    let superC = this.superCategories.find (cat => {
                        let slug = '/'+cat.slug;
                        slug = slug.replace('//','/');
                        slug = slug.replace('//','/');
                        return slug === '/'+this.$route.params.category_slug;
                    });
                    if(superC){
                        this.objectProp= superC;
                        return  "SuperCategory";
                    } else{
                       return  'err404';
                    }
                } else{
                    this.objectProp= category;
                    return 'Category';

                }
                
            
            }
        },
       
    }
}
</script>
