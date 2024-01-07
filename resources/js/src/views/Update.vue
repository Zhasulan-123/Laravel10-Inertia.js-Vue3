<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Header from '../components/Header.vue';
import Modal from '../components/Modal.vue';

const list = defineProps({ file: Object });

const showUpdate = ref(false);

const updateList = {
    title: 'Изменить ?',
    body: 'Вы действительно хотите изменить!'
}

const form = useForm({
  name: null,
  file: null,
  originFile: list.file.original_file_name,
  id: list.file.id,
})

function edit() {
  form.post('/update', {
        _method: 'post',
        name: form.name,
        file: form.file,
        originFile: form.originFile,
        id: form.id,
  });
}
</script>

<template>
    <div>
        <Header />
        <Modal v-if="showUpdate" @close="edit()" @cancellation="showUpdate = false" :list="updateList" />
        <div class="container">
            <div class="row p-3">
                <div class="col mr-2 mt-4">
                    <h2>Изменить</h2>
                    <div class="col-12 mt-2">
                        <label for="validationCustom01" class="form-label">Название файла:</label>
                        <input type="text" class="form-control" id="validationCustom01" :placeholder="list.file.user_entered_name" v-model="form.name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="m-3">
                        <img :src="list.file.path" :alt="list.file.original_file_name" width="100" height="100" />
                    </div>
                    <div class="col-12 mt-2 mb-3">
                        <label for="formFile" class="form-label">Загрузить файл: <span class="text-danger">{{list.file.original_file_name}}</span></label>
                        <input class="form-control" type="file" @input="form.file = $event.target.files[0]" id="formFile">
                    </div>
                    <div v-if="form.progress" class="progress" role="progressbar" aria-label="Success example"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-success" :style="`width: ${form.progress.percentage}%`">
                            {{ form.progress.percentage }}%</div>
                    </div>
                    <div class="col-12 mt-3">
                        <button class="btn btn-danger" @click="showUpdate = true">Изменить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>

</style>
