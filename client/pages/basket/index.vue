<template>
    <div class="section">
        <div class="container is-fluid">
            <div class="columns is-centered">
                <div class="column is-three-quarters">
                    <h1 class="title is-4">Your cart</h1>

                    <article class="message">
                        <BasketOverview />
                    </article>

                    <a href="#" class="button is-fullwidth is-info is-medium">
                        Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BasketOverview from '@/components/basket/BasketOverview'

    export default {
        components: {
            BasketOverview
        }
    }
</script>
