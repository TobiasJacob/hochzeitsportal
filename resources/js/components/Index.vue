<template>
    <div>
        <div class="container mb-3">
            <input class="form-control mb-2 mr-sm-2" v-model="searchString" type="text" placeholder="Suchen"  /> 
            <button 
            type="button" 
            class="btn btn-sm mr-1 border" 
            v-for="category in localCategories" 
            :key="category.id" 
            @click="clicked(category)" 
            v-bind:class="{ 'btn-outline': !category.active, 'btn-primary': category.active }">
                {{category.name}}
            </button>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4" v-for="vendor in filterVendors" :key="vendor.id">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-top" style="overflow:hidden; height: 13em;">
                            <img :src="'/uploads/img/' + vendor.photoPath" alt="" class="w-100 h-100" style="object-fit: cover;">
                        </div>
                        <div class="card-body position-relative d-flex flex-column">
                            <h5 class="card-title">{{ vendor.name }}</h5> <span class="position-absolute m-3 align-middle tb-oswald" style="right: 0; top: 0.175rem; line-height: 1.5rem;">{{ vendor.category}}</span>
                            <p class="card-text">{{ vendor.description | truncate(75, '...') }}</p>
                            <a :href="'/' + vendor.link" class="btn btn-primary mt-auto">Mehr</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['vendors', 'categories'],
        data() {
            let localCategories = this.categories;
            localCategories.forEach(element => {
                element.active = false;
            });
            let localVendors = this.vendors;
            localVendors.forEach(vendor => {
                let cat = '';

                localCategories.forEach(elementCat => {
                    if (elementCat.id == vendor.category_id) {
                        cat = elementCat.name;
                    }
                });
                vendor.category = cat;
            });
            return {searchString: '', localCategories, localVendors};
        },
        mounted() {
            console.log('Component mounted.')
            console.log(this.vendors);
        },
        filters: {
            truncate: function (text, length, suffix) {
                if (!text || text === '') return '';
                if (text.length < length) return text;

                return text.substring(0, length) + suffix;
            },
        },
        computed: {
            filterVendors() {
                let filterCategory = false;
                this.localCategories.forEach(e => {
                    if (e.active) { filterCategory = true }
                })
                if (filterCategory) {
                    return this.vendors.filter((vendor) => {
                        let matchesCategory = false;

                        this.localCategories.forEach(category => {
                            if (category.active && category.id === vendor.category_id) {
                                matchesCategory = true;
                            }
                        });

                        return vendor.name.includes(this.searchString) && matchesCategory;
                    });
                } else {
                    return this.vendors.filter((vendor) => vendor.name.includes(this.searchString));
                }
            }
        },
        methods: {
            clicked(category) {
                console.log(this.categories);
                category.active = !category.active;
            }
        },
    }
</script>
