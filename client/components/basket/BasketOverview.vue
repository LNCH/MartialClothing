<template>
    <table class="table is-hoverable is-fullwidth">
        <tbody>
            <BasketOverviewProduct
                v-for="product in products"
                :key="product.id"
                :product="product"
            />
            <tr>
                <td colspan="2"></td>
                <td>
                    <p class="has-text-weight-bold">Subtotal</p>
                </td>
                <td>
                    {{ subtotal }}
                </td>
                <td></td>
            </tr>
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
                products: 'basket/products',
                subtotal: 'basket/subtotal'
            })
        }
    }
</script>
