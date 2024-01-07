<template>
    <div>
        <Header />
        <Modal v-if="showDelete" @close="deleteId(file.id)" @cancellation="showDelete = false" :list="deleteList" />
        <Modal v-if="showUpdate" @close="updateId(file.id)" @cancellation="showUpdate = false" :list="updateList" />
        <div class="container text-center">
            <div class="row p-3">
                <div class="col mr-2 mt-4">
                    <table class="table">
                        <thead>
                            <tr class="table-dark">
                                <th scope="col">Фото:</th>
                                <th scope="col">Название:</th>
                                <th scope="col">Размер:</th>
                                <th scope="col">Расширение:</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p>
                                        <img :src="file.path" width="100" height="100" class="card-img-top" alt="">
                                    </p>
                                </td>
                                <td>{{ file.original_file_name }}</td>
                                <td>{{ file.size }} Mb</td>
                                <td>{{ file.extension }}</td>
                                <td>
                                    <button class="btn btn-light" @click="showUpdate = true">
                                        <Edit />
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-light" @click="showDelete = true">
                                        <Delete />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router  } from '@inertiajs/vue3';
import Header from '../components/Header.vue';
import Modal from '../components/Modal.vue';
import Delete from '../icons/Delete.vue';
import Edit from '../icons/Edit.vue';

defineProps({ file: Object });

const showDelete = ref(false);
const showUpdate = ref(false);

const deleteList = {
    title: 'Удалить ?',
    body: 'Вы действительно хотите удалить!'
}

const updateList = {
    title: 'Изменить ?',
    body: 'Вы действительно хотите изменить!'
}

function deleteId(id) {
    router.post('/destroy', {
        _method: 'delete',
        id: id
    });
}

function updateId(id) {
     router.get('/edit/'+ id);
}
</script>

<style lang="scss" scoped>

</style>
