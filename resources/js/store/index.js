import { createStore } from 'vuex'
import Cat from './models/cat'
import Breed from './models/breed'


// Create a new store instance.
const store = createStore({
    modules: {
        Cat,
        Breed,
    }
})

export default store
