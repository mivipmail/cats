<template>
    <el-row justify="center">
        <el-card class="" style="width: 60%; min-width: 460px">
            <div class="card-header">
                <span>{{route.params.id ? 'Редактировать породу' : 'Создать породу'}}</span>
            </div>
            <el-form :model="form" label-width="215px" size="small">
                <el-form-item label="Название">
                    <el-input v-model="form.title" />
                    <el-text type="danger">{{ errors?.title?.[0] }}</el-text>
                </el-form-item>
                <el-form-item label="Средн. продолжительность жизни">
                    <el-input v-model="form.average_age" />
                    <el-text type="danger">{{ errors?.average_age?.[0] }}</el-text>
                </el-form-item>
                <el-form-item label="Описание">
                    <el-input v-model="form.description" type="textarea" />
                    <el-text type="danger">{{ errors?.description?.[0] }}</el-text>
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
import { reactive, ref, onMounted } from 'vue'
import { useRoute } from 'vue-router';
import router from '../../router';

export default {
    setup() {
        const store = useStore()
        const route = useRoute()

        const form = reactive({
            title: '',
            average_age: '',
            description: '',
        })
        const errors = ref(null)

        const onSubmit = () => {
            errors.value = null
            if (route.params.id) {
                form.id = route.params.id
                axios.patch(`/api/breeds/${route.params.id}`, form)
                    .then(res => {
                        const id = res.data.id
                        router.push(`/breeds/${id}`)
                    })
                    .catch(err => {
                        errors.value = err.response.data.errors
                    })
            }
            else {
                axios.post('/api/breeds', form)
                    .then(res => {
                        const id = res.data.id
                        router.push(`/breeds/${id}`)
                    })
                    .catch(err => {
                        errors.value = err.response.data.errors
                    })
            }
        }

        const fetchBreed = () => {
            axios.get(`/api/breeds/${route.params.id}`)
                .then(res => {
                    form.title = res.data.title
                    form.average_age = res.data.average_age
                    form.description = res.data.description
                })
                .catch(err => {
                    console.log('err', err.response?.data?.message)
                })
        }

        onMounted(() => {
            if (route.params.id)
                fetchBreed()
        })

        return { 
            form, 
            onSubmit, 
            errors, 
            route, 
            router,
        }
    }
}

</script>

<style scoped></style>