<template>
    <el-card>
        <div class="card-header">
            <span>Список пород</span>
            <router-link :to="{ name: 'breed.create' }" type="button">
                <el-button size="small" type="success">
                    Создать
                </el-button>
            </router-link>
        </div>
        <el-table :data="breeds" stripe style="width: 100%">
            <el-table-column prop="title" label="Название">
                <template #default="scope">
                    <router-link :to="{ name: 'breed.show', params: { id: breeds?.[scope.$index].id } }">
                        {{ scope.row.title }}
                    </router-link>
                </template>
            </el-table-column>
            <el-table-column prop="average_age" label="Средняя продолжительность жизни" />
            <!-- <el-table-column prop="description" label="Описание" /> -->
            <el-table-column label="">
                <template #default="scope">
                    <router-link :to="{ name: 'breed.edit', params: { id: breeds?.[scope.$index].id } }" type="button">
                        <el-button size="small">
                            Редактировать
                        </el-button>
                    </router-link>
                    <el-button size="small" type="danger" @click="onDestroy(breeds?.[scope.$index].id)">Удалить</el-button>
                </template>
            </el-table-column>
        </el-table>
    </el-card>
</template>

<script>
import { computed } from 'vue'
import { useStore } from 'vuex'

export default {
    setup() {
        const store = useStore()

        const onDestroy = (id) => {
            store.dispatch('destroyBreed', id)
        }

        return {
            breeds: computed(() => store.getters.breeds),
            onDestroy,
        }
    }
}
</script>

<style scoped>
.el-avatar {
    max-width: 100%;
}
</style>