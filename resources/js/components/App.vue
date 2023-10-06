<template>
    <el-container>
        <el-header class="header">
            <el-menu class="el-menu-demo menu" mode="horizontal">
                <el-menu-item>
                    <router-link :to="{ name: 'cat.index' }" style="text-decoration:none">
                        Кошки
                    </router-link>
                </el-menu-item>
                <el-menu-item>
                    <router-link :to="{ name: 'breed.index' }" style="text-decoration:none">
                        Породы
                    </router-link>
                </el-menu-item>
            </el-menu>
        </el-header>
        <el-main>
            <router-view></router-view>
        </el-main>
    </el-container>
</template>

<script>
import { useStore } from 'vuex'
import { ref, onMounted, onBeforeUnmount } from 'vue'


export default {
    setup() {
        const store = useStore()
        const interval = ref(null)

        store.dispatch('fetchCats')
        store.dispatch('fetchBreeds')

        const stopTimer = () => {
            if (interval) {
                window.clearInterval(interval)
            }
        }

        const startTimer = () => {
            stopTimer()
            interval.value = window.setInterval(() => {
                store.dispatch('fetchCats')
                store.dispatch('fetchBreeds')
            }, 30000)
        }

        onMounted(() => {
            startTimer()
        })

        onBeforeUnmount(stopTimer)
    }
}
</script>

<style scoped>
.menu {
    padding: 0 10px;
    border-radius: 4px;

    li {
        color: gray;
        font-weight: bold;
    }
}
</style>