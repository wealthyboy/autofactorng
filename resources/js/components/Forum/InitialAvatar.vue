<!-- components/InitialAvatar.vue -->
<template>
    <div
      class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold text-uppercase"
      :style="avatarStyle"
    >
      {{ initial }}
    </div>
  </template>
  
  <script setup>
  import { computed } from 'vue'
  
  const props = defineProps({
    name: String,
    size: {
      type: Number,
      default: 48
    }
  })
  
  const initial = computed(() => props.name?.charAt(0).toUpperCase() || '?')
  
  function stringToColor(str) {
    let hash = 0
    for (let i = 0; i < str.length; i++) {
      hash = str.charCodeAt(i) + ((hash << 5) - hash)
    }
    return `hsl(${hash % 360}, 70%, 50%)`
  }
  
  const avatarStyle = computed(() => ({
    width: `${props.size}px`,
    height: `${props.size}px`,
    fontSize: 18 + 'px',
    backgroundColor: stringToColor(props.name || 'A'),
  }))
  </script>
  
  <style scoped>
  div {
    user-select: none;
  }
  </style>
  