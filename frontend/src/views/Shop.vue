<template>
    <div class="container">
        <h1 class="heading--l">Shop</h1>
        <div class="product__grid grid col-2">

            <div v-for="(product, i) in products" :key="i" class="product__grid-item relative">
                <div class="inner absolute full overflow--hidden stick--top stick--bottom flex vertical">
                    <div class="product__thumbnail full">
                        <img :src="product.node.images[0].originalSrc" class="full cover--center">
                    </div>
                    <span class="absolute stick--bottom f--big" style="color:#fff">{{ product.node.title }}</span>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import axios from "axios";
    export default {
        data: function() {
            return {
                products: []
            }
        },
        mounted() {
            this.getProducts()
        },
        methods: {
            getProducts() {
                axios
                    .get( 'https://www.itsallfluff.com/page-data/products/face-oil-2/page-data.json' )
                    .then( success => this.products = success.data.result.data.allShopifyProduct.edges )
                    .catch( err => console.error(err.response.status) )
            }
        }
    }
</script>

<style scoped>
    .product__grid-item {
        padding-bottom: 100%;
        cursor: pointer;
    }
    
    .product__grid-item .product__thumbnail {
        transition: all .8s ease;
    }

    .product__grid-item:hover .product__thumbnail {
        transform: scale(1.1)
    }
</style>