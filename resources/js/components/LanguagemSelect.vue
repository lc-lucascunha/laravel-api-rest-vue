<template>
    <nav class="navbar navbar-light bg-gradient">
        <div class="container-fluid">
            <a class="navbar-brand">{{ labels[lang].title }}</a>

            <form class="d-flex">
                <a class="navbar-brand">{{ labels[lang].language }}</a>

                <div v-if="lang == 'en'">
                    <div class="btn btn-secondary" @click="lang = 'pt'">PT</div>
                    <div class="btn btn-success" @click="lang = 'en'">EN</div>
                </div>
                <div v-else>
                    <div class="btn btn-success" @click="lang = 'pt'">PT</div>
                    <div class="btn btn-secondary" @click="lang = 'en'">EN</div>
                </div>
            </form>
        </div>
    </nav>
</template>

<script>
import bus from '../eventBus';
import _ from 'lodash';

export default {
    data() {
        return {
            lang: 'en',
            labels: {
                en: {
                    title: 'CRUD: Categories and Products',
                    language: 'Language',
                },
                pt: {
                    title: 'CRUD: Categorias e Produtos',
                    language: 'Idioma',
                },
            },
        };
    },
    watch: {
        lang: _.debounce(function() {
            this.fetchLang();
        })
    },
    methods: {
        fetchLang() {
            bus.$emit('languagem-select', this.lang);
        },
    },
};
</script>
