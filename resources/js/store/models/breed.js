import axios from 'axios'

const state = {
    breeds: [],
}

const getters = {
    breeds: state => {
        return state.breeds
    },
}

const mutations = {
    setBreeds(state, breeds) {
        state.breeds = breeds
    },
}

const actions = {
    fetchBreeds({commit, state}) {
        axios.get(`/api/breeds`)
            .then(res => {
                commit('setBreeds', res.data)
            })
            .catch(err => {
                console.log(err.response?.data?.message)
            })
    },

    destroyBreed({dispatch}, id) {
        axios.delete(`/api/breeds/${id}`)
            .then(res => {
                dispatch('fetchBreeds')
                dispatch('fetchCats')
            })
            .catch(err => {
                console.log(err.response?.data?.message)
            })
    }
}

export default {
    state, getters, mutations, actions
}
