export const state = () => ({
    products: []
})

export const getters = {
    products:  (state) => state.products,
    count: (state) => state.products.length
}

export const mutations = {
    SET_PRODUCTS (state, products) {
        state.products = products
    }
}

export const actions = {
    async getBasket ({ commit }) {
        let response = await this.$axios.get('basket').then((response) => response.data)
        commit('SET_PRODUCTS', response.data.products)
        return response
    },
    async destroy ({ dispatch }, productId) {
        let response = await this.$axios.delete('basket/' + productId)
        dispatch('getBasket')
    }
}
