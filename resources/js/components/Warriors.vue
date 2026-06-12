<template>
    <div class="min-h-screen bg-stone-950 p-8">
        <div class="container mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-black tracking-widest text-amber-400 uppercase" style="font-family: serif;">Gladius</h1>
                <p class="text-stone-400 text-sm tracking-widest mt-1">Swordplay e Jogos de Combate</p>
            </div>

            <div v-if="loading" class="text-center text-stone-400">Carregando...</div>

            <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-10">
                <WarriorCard v-for="warrior in warriors" :key="warrior.id" :warrior="warrior" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import WarriorCard from './WarriorCard.vue';

const warriors = ref([]);
const loading = ref(true);

onMounted(async () => {
    const { data } = await axios.get('/api/warriors');
    warriors.value = data.warriors;
    loading.value = false;
});
</script>
