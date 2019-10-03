export const state = () => ({
    products: [],
    empty: true
})

export const getters = {
    products:  (state) => state.products,
    count: (state) => state.products.length,
    empty: (state) => state.empty
}

export const mutations = {
    SET_PRODUCTS (state, products) {
        state.products = products
    },
    SET_EMPTY (state, empty) {
        state.empty = empty
    }
}

export const actions = {
    async getBasket ({ commit }) {
        let response = await this.$axios.get('basket').then((response) => response.data)
        commit('SET_PRODUCTS', response.data.products)
        commit('SET_EMPTY', response.meta.empty)
        return response
    },
    async update({ dispatch }, payload) { // Could destructure the payload...
        let response = await this.$axios.patch('basket/' + payload.id, { quantity: payload.quantity })
        dispatch('getBasket')
    },
    async destroy ({ dispatch }, productId) {
        let response = await this.$axios.delete('basket/' + productId)
        dispatch('getBasket')
    }
}
