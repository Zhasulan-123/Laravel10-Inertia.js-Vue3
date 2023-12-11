<template>
    <div>
        <Header />
        <Modal v-if="showDelete" @close="deleteId(file.id)" @cancellation="showDelete = false" :list="deleteList" />
        <div class="container text-center">
            <div class="row p-3">
                <div class="col mr-2 mt-4">
                    <div class="card bg_width">
                        <img :src="file.original_file_name" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ file.user_entered_name }}</h5>
                            <p class="card-text">{{ file.original_file_name }}</p>
                            <button class="btn btn-light" @click="showDelete = true">
                                <Delete />
                            </button>
                            <Link class="btn btn-light" href="/">
                               <Edit />
                            </Link>
                        </div>
                    </div>
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

const deleteList = {
    title: 'Удалить ?',
    body: 'Вы действительно хотите удалить!'
}

function deleteId(id) {
    router.post('/destroy', {
        _method: 'delete',
        id: id
    });
}
</script>

<style lang="scss" scoped>

</style>
