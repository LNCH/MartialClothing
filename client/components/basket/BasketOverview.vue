<template>
    <table class="table is-hoverable is-fullwidth">
        <tbody>
            <BasketOverviewProduct
                v-for="product in products"
                :key="product.id"
                :product="product"
            />
        </tbody>
    </table>
</template>

<script>
    import { mapGetters } from 'vuex'
    import BasketOverviewProduct from '@/components/basket/BasketOverviewProduct'

    export default {
        components: {
            BasketOverviewProduct
        },
        computed: {
            ...mapGetters({
                products: 'basket/products'
            })
        }
    }
</script>
