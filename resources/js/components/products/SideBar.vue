<template>
   
<div class="">
    <!--Widget-->
    <div class="widget">
        <h3 class="widget-title">
            <a data-toggle="collapse" href="#widget-category" role="button" aria-expanded="true" aria-controls="widget-body-2"><h4>{{ categories.name }}</h4></a>
        </h3>

        <div class="collapse show" id="widget-category">
            <div class="widget-body">
                <ul class="cat-list">
                    <li v-for="sub_category in categories.children" :key="sub_category.id"><a href="">{{ sub_category.name }} </a></li>
                </ul>
            </div><!-- End .widget-body -->
        </div><!-- End .collapse -->
    </div><!-- End .widget -->

    <div v-for="filter in categories.attributes" :key="filter.id"  class="widget">
        <h3 class="widget-title">
            <a data-toggle="collapse" :href="'#widget-body-4'+ filter.id" role="button" aria-expanded="true" :aria-controls="'widget-body-4'+ filter.id">{{ filter.name }}</a>
        </h3>

        <div class="collapse cln show" :class="filter.children.length" :id="'widget-body-4'+ filter.id">
            <div class="widget-body">
                <ul class="cat-list">
                    <li v-for="children in filter.children" :key="children.id" >
                        <div class="checkbox">
                            <label @change="activateFilter(filter.name,children)" :id="'box'+ children" class="checkbox-label">
                            <input for="'box'+ children" :name="filter.name" :value="children" class="filter-product" type="checkbox">
                                <span class="checkbox-custom rectangular"></span>
                                <span class="checkbox-label-text">{{ children }}</span> 
                            </label>
                        </div>
                    </li>
                </ul>
            </div><!-- End .widget-body -->
        </div><!-- End .collapse -->
    </div><!-- End .widget -->
    <!-- Content -->
    
</div>
</template>

<script>
export default {
    props:{
       category: Object
    },
    data(){
        return {
            isOpen: false,
            filters:[],
            categories:[],
            selectedFilters: _.omit(this.$route.query, ['page']),
            qS: [],
            filter: true
        }  
    },
    watch(){

    },
    created(){
      
    },
    mounted(){
        let path = this.$route.path
        axios.get("/api/filters" +path).then((response) => {
            this.filters = response.data.data
            this.categories = response.data.data
        })
         
    },
    methods:{
        toggleAccordion(){
           this.isOpen = !this.isOpen
        },
        activateFilter (key,value) {
            var inputs = document.querySelectorAll("input.filter-product:checked");
            var checkboxesChecked = [];
            var checked = []
            let values;
            let filters ={}
            console.log(inputs.length)
            for(var i = 0; i < inputs.length; i++) {
                checked.push(key)
                if (inputs[i].checked) {
                    filters = {
                        [inputs[i].name] : inputs[i].value,
                    }
                    checkboxesChecked.push(filters); 
                }  
            }
          // console.log(checkboxesChecked)

            const res = checkboxesChecked.reduce((acc, x) => {
            const key = Object.keys(x)[0];
            const index = acc.findIndex(obj => Object.keys(obj)[0].includes(key))
            if (index >= 0) {
                acc[index][key] = acc[index][key] + '-' + x[key];
            } else {
                acc.push(x)
            }
            return acc;
            }, [])
            if (res.length){
                for (const f in res) {
                    const element = res[f];
                    //console.log(res[f]) 
                    //console.log(Object.keys(res[0]).includes(key)) 
                    console.log(res)

                    if (element[key]){
                        this.selectedFilters = Object.assign({}, this.selectedFilters, { [key]: element[key] })  
                    }

                    console.log(this.selectedFilters) 
                      //  console.log(key)
                       // delete this.selectedFilters[key]
                  // }
                }
                this.selectedFilters = Object.assign({}, this.selectedFilters, { filter: true}) 
            } else {
                this.selectedFilters =  {} 
            }

            this.updateQueryString()
        },
       
        updateQueryString () {
            this.$router.replace({
                query: {
                   ...this.selectedFilters,
                }
            })
        }


    },
    computed: {
        accordionClasses: function(){
            return {
                'slideDown': this.isOpen
            }
        }
    }
    
}
</script>

<style>
.slideInDown {
   transition: all 0.4s;
   display: block;
}

</style>