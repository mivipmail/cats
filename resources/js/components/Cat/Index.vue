<template>
    <el-card>
        <div class="card-header">
            <span>Список кошек</span>
            <router-link :to="{ name: 'cat.create' }" type="button">
                <el-button size="small" type="success">
                    Создать
                </el-button>
            </router-link>
        </div>
        <el-table :data="cats" stripe style="width: 100%">
            <el-table-column label="">
                <template #default="scope">
                    <router-link :to="{ name: 'cat.show', params: { id: cats?.[scope.$index].id } }">
                        <el-avatar shape="square" :size="100" :src="scope.row.image" />
                    </router-link>
                </template>
            </el-table-column>
            <el-table-column prop="name" label="Имя">
                <template #default="scope">
                    <router-link :to="{ name: 'cat.show', params: { id: cats[scope.$index].id } }">
                        {{ scope.row.name }}
                    </router-link>
                </template>
            </el-table-column>
            <el-table-column prop="age" label="Возраст">
                <template #default="scope">
                    <span :style="isOldCat(scope.row) ? 'color:red' : ''">
                        {{ isOldCat(scope.row)
                            ? `${scope.row.age} (средн. ${scope.row.breed.average_age})`
                            : scope.row.age
                        }}
                    </span>
                </template>
            </el-table-column>
            <el-table-column prop="breed.title" label="Порода">
                <template #default="scope">
                    <router-link :to="{ name: 'breed.show', params: { id: cats[scope.$index].breed.id } }">
                        {{ scope.row.breed.title }}
                    </router-link>
                </template>
            </el-table-column>
            <el-table-column label="">
                <template #default="scope">
                    <router-link :to="{ name: 'cat.edit', params: { id: cats[scope.$index].id } }" type="button">
                        <el-button size="small">
                            Редактировать
                        </el-button>
                    </router-link>
                    <el-button size="small" type="danger" @click="onDestroy(cats?.[scope.$index].id)">Удалить</el-button>
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
            store.dispatch('destroyCat', id)
        }

        const isOldCat = (cat) => Math.abs(cat.age - cat.breed.average_age) < 4

        return {
            cats: computed(() => store.getters.cats),
            isOldCat,
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