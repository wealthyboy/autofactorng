<template>
    <div class="card mb-2 ms-0 ms-md-4">
      <div class="card-body">
        <p>{{ reply.content }}</p>
        <div class="d-flex justify-content-between">
          <small class="text-muted">{{ reply.user.name }} – {{ reply.created_at }}</small>
          <button @click="$emit('toggle-like', reply.id)"
                  class="btn btn-sm"
                  :class="{'btn-outline-danger': !reply.liked_by_user, 'btn-danger': reply.liked_by_user}">
            ❤️ {{ reply.likes_count }}
          </button>
        </div>
      </div>
  
      <!-- Render nested replies -->
      <div v-if="reply.replies && reply.replies.length" class="ms-4 mt-2">
        <ReplyCard
          v-for="child in reply.replies"
          :key="child.id"
          :reply="child"
          @toggle-like="$emit('toggle-like', $event)"
        />
      </div>
    </div>
  </template>
  
  <script setup>
  defineProps(['reply'])
  defineEmits(['toggle-like'])
  
  import ReplyCard from './ReplyCard.vue'
  </script>
  