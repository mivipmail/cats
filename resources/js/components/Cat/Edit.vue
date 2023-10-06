<template>
    <el-row justify="center">
        <el-card class="box-card" style="width:460px">
            <div class="card-header">
                <span>{{route.params.id ? 'Редактировать кошку' : 'Создать кошку'}}</span>
            </div>
            <el-form :model="form" label-width="120px" size="small">
                <el-form-item label="Имя">
                    <el-input v-model="form.name" />
                    <el-text type="danger">{{ errors?.name?.[0] }}</el-text>
                </el-form-item>
                <el-form-item label="Возраст">
                    <el-input v-model="form.age" />
                    <el-text type="danger">{{ errors?.age?.[0] }}</el-text>
                </el-form-item>
                <el-form-item label="Порода">
                    <el-select v-model="form.breed_id" placeholder="Выберите породу">
                        <el-option v-for="(breed, index) in breeds" :label="breed.title" :value="breed.id" :key="breed.id"
                            :selected="index == 0" />
                    </el-select>
                </el-form-item>

                <el-form-item label="Картинка">
                    <el-row justify="center">
                        <el-col :span="24">
                            <el-button size="small" type="info" @click.prevent="fetchImage">Скачать другую</el-button>
                        </el-col>
                        <el-col :span="24">
                            <img :src="form.image" alt="" style="width:90%">
                        </el-col>
                    </el-row>
                </el-form-item>
                <el-form-item>
                    <el-button size="small" type="primary" @click="onSubmit">{{ route.params.id ? 'Обновить' :
                        'Создать' }}</el-button>
                    <el-button size="small" @click="router.back">Отменить</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </el-row>
</template>

<script>
import { useStore } from 'vuex'
import axios from 'axios';
import { reactive, ref, computed, onMounted } from 'vue'
import { useRoute } from 'vue-router';
import router from '../../router';

export default {
    setup() {
        const store = useStore()
        const route = useRoute()

        const form = reactive({
            name: '',
            age: '',
            breed_id: '',
            image: '',
        })
        const errors = ref(null)

        const onSubmit = () => {
            errors.value = null
            if (route.params.id) {
                form.id = route.params.id
                axios.patch(`/api/cats/${route.params.id}`, form)
                    .then(res => {
                        const id = res.data.id
                        router.push(`/cats/${id}`)
                    })
                    .catch(err => {
                        errors.value = err.response.data.errors
                    })
            }
            else {
                axios.post('/api/cats', form)
                    .then(res => {
                        const id = res.data.id
                        router.push(`/cats/${id}`)
                    })
                    .catch(err => {
                        errors.value = err.response.data.errors
                    })
            }
        }

        const fetchImage = () => {
            axios.get('/api/images')
                .then(res => {
                    form.image = res.data.url
                })
                .catch(err => {
                    console.log('err', err.response?.data?.message)
                })
        }

        const fetchCat = () => {
            axios.get(`/api/cats/${route.params.id}`)
                .then(res => {
                    form.name = res.data.name
                    form.age = res.data.age
                    form.breed_id = res.data.breed.id
                    form.image = res.data.image
                })
                .catch(err => {
                    console.log('err', err.response?.data?.message)
                })
        }

        onMounted(() => {
            if (route.params.id)
                fetchCat()
            else
                fetchImage()
        })

        return { 
            form, 
            onSubmit, 
            fetchImage, 
            errors, 
            route, 
            router,
            breeds: computed(() => store.getters.breeds),
        }
    }
}

</script>

<style scoped></style>