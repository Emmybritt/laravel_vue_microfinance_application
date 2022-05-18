<template>
    <div>
        <div @click="toggle" @dblclick="changeType" @keydown.right="alerts">
            {{ model.name }}
            <span v-if="isFolder">[{{ isOpen ? '-' : '+' }}]</span>
        </div>
        <ul v-show="isOpen" v-if="isFolder" class="list">
            <TreeComponent
                :key="model"
                class="item ml-5"
                v-for="model in model.children"
                :model="model"
            >
            </TreeComponent>
            <li class="add" @click="addChild">+</li>
        </ul>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";

const props = defineProps({
    model: Object,
});

const isOpen = ref(false);

const isFolder = computed(() => {
    return props.model.children && props.model.children.length;
});

function toggle() {
    isOpen.value = !isOpen.value;
}

function changeType() {
    if (!isFolder.value) {
        props.model.children = []
        addChild()
        isOpen.value = true;
    }
}

function addChild() {
    props.model.children.push({ name: "Add new stuff" });
}

function alerts() {
    alert('clicked')
}
</script>

<style></style>
