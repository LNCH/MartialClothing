<template>
    <tr>
        <td width="120">
            <img src="http://via.placeholder.com/60x60" alt="">
        </td>
        <td>
            {{ fullName }}
        </td>
        <td width="160">
            <div class="field">
                <div class="control">
                    <div class="select is-fullwidth">
                        <select v-model="quantity">
                            <option value="0" v-if="product.quantity == 0">0</option>
                            <option
                                v-for="x in product.stock_count"
                                :value="x"
                                :key="x"
                                :selected="x == product.quantity"
                            >
                                {{ x }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </td>
        <td>
            {{ product.total }}
        </td>
        <td>
            <a href="#" @click.prevent="destroyProduct()">Remove</a>
        </td>
    </tr>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {
        props: {
            product: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                quantity: this.product.quantity
            }
        },
        computed: {
            fullName() {
                return this.product.product.name + " - " + this.product.type + " " + this.product.name
            }
        },
        watch: {
            'quantity' (quantity) {
                this.update({
                    id: this.product.id,
                    quantity: quantity
                })
            }
        },
        methods: {
            ...mapActions({
                update: 'basket/update',
                destroy: 'basket/destroy'
            }),
            destroyProduct() {
                if (confirm('Are you sure you want to remove this product?')) {
                    this.destroy(this.product.id)
                }
            }
        }
    }
</script>
