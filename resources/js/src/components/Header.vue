<template>
    <nav class="navbar bg-dark navbar-expand-lg" data-bs-theme="dark">
        <div class="container-fluid">
            <Link class="navbar-brand" href="/">Images</Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <Link class="nav-link" :class="{ 'active': $page.url === '/' }" href="/">Главная</Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" :class="{ 'active': $page.url === '/create' }" href="/create">Создать
                        </Link>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" :class="{ 'active': $page.url === '/search' }" href="/search">Поиск
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
