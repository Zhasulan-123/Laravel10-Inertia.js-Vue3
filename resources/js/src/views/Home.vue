<template>
    <div>
        <Header />
        <h3 class="text-danger mt-2 mb-2">Списки кол-во: {{ files.data.length }}</h3>
        <div class="container text-center">
            <div class="row p-3 mb-4">
                <div class="col mr-2 mt-4" v-for="file in files.data" :key="file.id">
                    <div class="card bg_width">
                        <img :src="file.path" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">Название:{{ file.user_entered_name }}</h5>
                            <p class="card-text">Файл: {{ file.original_file_name }}</p>
                            <p class="card-text">Размер: {{ file.size }}-байт</p>
                            <p class="card-text">Расширение: {{ file.extension }}</p>
                            <div>
                                <a :href="file.path" download>Скачать</a>
                            </div>
                            <Link :href="`/show/${file.id}`">Просмотреть</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Header from '../components/Header.vue';

defineProps({ files: Object});

</script>

<style lang="scss" scoped>
/* Add your component styles here */
.bg_width{
   width: 18rem;
}
</style>
