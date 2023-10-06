<template>
    <el-row justify="center">
        <el-card class="box-card">
            <div class="card-header">
                <el-button size="small" @click.prevent="onCancel" style="margin-left:auto">К списку</el-button> 
            </div>
            <div style="padding: 14px">
                <table class="table" style="width: 100%">
                    <tbody>
                        <tr>
                            <td class="border-0">Название</td>
                            <td class="border-0 attr">{{ breed?.title }}</td>
                        </tr>
                        <tr>
                            <td class="border-0">Средняя продолжительность жизни</td>
                            <td class="border-0 attr">{{ breed?.average_age }}</td>
                        </tr>
                        <tr>
                            <td class="border-0">Описание</td>
                            <td class="border-0 attr">{{ breed?.description }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <el-row justify="space-between">
                <router-link :to="{ name: 'breed.edit', params: { id: breed?.id } }" type="button">
                    <el-button size="small">
                        Редактировать
                    </el-button>
                </router-link>
                <el-button size="small" type="danger" @click.prevent="onDestroy(breed.id)">Удалить</el-button>
            </el-row>
        </el-card>
    </el-row>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router';
import router from '../../router';
import { useStore } from 'vuex'

export default {
    setup() {
        const breed = ref(null)
        const route = useRoute()
        const store = useStore()

        const fetchBreed = () => {
            axios.get(`/api/breeds/${route.params.id}`)
                .then(res => {
                    breed.value = res.data
                })
                .catch(err => {
                    console.log(err.response?.data?.message)
                    router.push('/404')
                })
        }

        const onDestroy = (id) => {
            store.dispatch('destroyBreed', id)
            router.push('/breeds')
        }

        const onCancel = () => {
            router.push('/breeds')
        }

        onMounted(fetchBreed)

        return { breed, onDestroy, onCancel }
    }
}
</script>

<style scoped>
.attr {
    font-size: 14px;
    color: gray;
}

.bottom {
    margin-top: 13px;
    line-height: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.image {
    width: 100%;
    min-width: 360px;
    display: block;
}
</style>