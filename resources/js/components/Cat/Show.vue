<template>
    <el-row justify="center">
        <el-card class="box-card">
            <div class="card-header">
                <el-button size="small" @click.prevent="onCancel" style="margin-left:auto">К списку</el-button> 
            </div>
            <img :src="cat?.image" class="image" />
            <div style="padding: 14px">
                <span>Имя: {{ cat?.name }}</span>
                <div class="bottom">
                    <span class="attr">Возраст: {{ cat?.age }}</span>
                    <span class="attr">Порода: {{ cat?.breed.title }}</span>
                </div>
            </div>
            <el-row justify="space-between">
                <router-link :to="{ name: 'cat.edit', params: { id: cat?.id } }" type="button">
                    <el-button size="small" type="primary">
                        Редактировать
                    </el-button>
                </router-link>
                <el-button size="small" type="danger" @click.prevent="onDestroy(cat.id)">Удалить</el-button>
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
        const cat = ref(null)
        const route = useRoute()
        const store = useStore()

        const fetchCat = () => {
            axios.get(`/api/cats/${route.params.id}`)
                .then(res => {
                    cat.value = res.data
                })
                .catch(err => {
                    console.log(err.response?.data?.message)
                    router.push('/404')
                })
        }

        const onDestroy = (id) => {
            store.dispatch('destroyCat', id)
            router.push('/')
        }

        const onCancel = () => {
            router.push('/')
        }

        onMounted(fetchCat)

        return { cat, onDestroy, onCancel }
    }
}
</script>

<style scoped>
.attr {
    font-size: 12px;
    color: #999;
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