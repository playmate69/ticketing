<template>
    <div class="container">
        <h1 class="heading--l">Shop</h1>
        <div class="product__grid grid col-2">

            <div v-for="(product, i) in products" :key="i" :style="{ '--delay': i/10 + 's' }" class="product__grid-item relative anim-in-view">
                <div class="inner absolute full overflow--hidden stick--top stick--bottom flex vertical">
                    <div class="product__thumbnail full">
                        <img :src="product.node.images[0].src" class="full cover--center">
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
            this.getProducts();

            window.onscroll = function() {
                [].forEach.call( document.querySelectorAll(".product__grid-item"), (product) => {
                    if ( product.classList.contains("in-view") ) return;

                    if ( (window.scrollY + window.innerHeight ) > product.offsetTop + ( product.offsetHeight/2 ) ) product.classList.add("in-view")

                });
            }

        },
        updated() {
            [].forEach.call( document.querySelectorAll(".product__grid-item"), (product) => {
                if ( (window.scrollY + window.innerHeight ) > product.offsetTop + ( product.offsetHeight/2 ) ) product.classList.add("in-view")
            });
        },
        methods: {
            getProducts() {
                axios
                    .get( this.$store.state.API + '/tickets' )
                    .then( success => this.products = success.data.edges )
                    .catch( err => console.error(err.response.status) )
            }
        }
    }
</script>

<style scoped>
    .product__grid-item {
        padding-bottom: 100%;
        cursor: pointer;
        transition-delay: var(--delay) !important;
    }
    
    .product__grid-item .product__thumbnail {
        transition: all .8s ease;
    }

    .product__grid-item:hover .product__thumbnail {
        transform: scale(1.1)
    }

    .anim-in-view {
        transition: all .4s ease;
    }

    .anim-in-view:not(.in-view) {
        transform: translateY(30%);
        opacity: 0;    
    }

</style>