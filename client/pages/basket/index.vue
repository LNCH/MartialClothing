<template>
    <div class="section">
        <div class="container is-fluid">
            <div class="columns is-centered">
                <div class="column is-three-quarters">

                    <div class="notification is-info" v-if="changed">
                        <button class="delete"></button>
                        The quantity of an item in your basket was changed due to stock levels.
                    </div>

                    <h1 class="title is-4">Your cart</h1>

                    <article class="message" v-if="products.length">
                        <BasketOverview />
                    </article>
                    <article v-else>
                        <p>You have no items in your basket</p>
                    </article>

                    <a href="#" class="button is-fullwidth is-info is-medium" :disabled="empty" v-if="products.length">
                        Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BasketOverview from '@/components/basket/BasketOverview'
    import { mapGetters } from 'vuex'

    export default {
        components: {
            BasketOverview
        },
        computed: {
            ...mapGetters({
                empty: 'basket/empty',
                products: 'basket/products',
                changed: 'basket/changed'
            })
        }
    }
</script>
