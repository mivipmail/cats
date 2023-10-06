import axios from 'axios'

const state = {
    cats: [],
}

const getters = {
    cats: state => {
        return state.cats
    },
}

const mutations = {
    setCats(state, cats) {
        state.cats = cats
    },
}

const actions = {
    fetchCats({commit, state}) {
        axios.get(`/api/cats`)
            .then(res => {
                commit('setCats', res.data)
            })
            .catch(err => {
                console.log(err.response?.data?.message)
            })
    },

    destroyCat({dispatch}, id) {
        axios.delete(`/api/cats/${id}`)
            .then(res => {
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
