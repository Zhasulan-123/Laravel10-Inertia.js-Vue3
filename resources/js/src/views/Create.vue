<template>
    <div>
        <Header />
        <Modal v-if="showCreate" @close="store()" @cancellation="showCreate = false" :list="createList" />
        <div class="container">
            <div class="row p-3">
                <div class="col mr-2 mt-4">
                    <h2>Создать</h2>
                    <div class="col-12 mt-2">
                        <label for="validationCustom01" class="form-label">Название файла:</label>
                        <input type="text" class="form-control" id="validationCustom01" v-model="form.name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-12 mt-2 mb-3">
                        <label for="formFile" class="form-label">Загрузить файл</label>
                        <input class="form-control" type="file" @input="form.file = $event.target.files[0]"
                            id="formFile">
                    </div>
                    <div v-if="form.progress" class="progress" role="progressbar" aria-label="Success example"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-success" :style="`width: ${form.progress.percentage}%`">
                            {{ form.progress.percentage }}%</div>
                    </div>
                    <div class="col-12 mt-3">
                        <button class="btn btn-primary" @click="showCreate = true">Создать</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Header from '../components/Header.vue';
import Modal from '../components/Modal.vue';

const showCreate = ref(false);

const createList = {
    title: 'Создать ?',
    body: 'Вы действительно хотите создать!'
}

const form = useForm({
  name: null,
  file: null,
})

function store() {
  form.post('/store', {
        _method: 'post',
        name: form.name,
        file: form.file
  });
}
</script>
