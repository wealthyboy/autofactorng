<template>
   


    <div>
      <div class="d-flex gap-1 mb-1 mb-3 mt-3">
    <!-- Avatar (outside card) -->
    <InitialAvatar :name="reply.user.name" :size="48" class="avatar-shadow" />

    <!-- Post Content Card -->
    <div class="card w-100 border rounded-4 px-3 py-2">
      <div class="card-body p-0">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
            <div>
              <h5 class="card-title mb-1">{{ reply.user.name }}</h5>
              <p class="text-muted mb-0">
              </p>
            </div>
          <small class="text-muted d-none d-lg-inline text-black">{{ reply.date }}</small>
        </div>

        <!-- Content -->
        <p class="mt-2 py-3 mb-2">{{ reply.content }}</p>

        <!-- Footer: icons and reply -->
        <div class="d-flex align-items-center justify-content-between text-muted mt-3">
          <div class="d-flex gap-3 align-items-center ">
            <small class="text-muted d-md-none">{{ reply.date }}</small>
          </div>
          <div class="d-flex align-items-center gap-3">
            <button @click="$emit('toggle-like')" class="btn btn-sm p-1" :class="reply.liked_by_user ? 'btn-success' : 'btn-outline-success'">
              <i class="bi bi-hand-thumbs-up"></i> {{ reply.likes_count }}
            </button>
            <button
                class="btn btn-sm btn-link text-decoration-none p-0"
                @click="$emit('open-reply-modal', reply)"
              >
                <i class="bi bi-reply me-1"></i> Reply
              </button>
          </div>
        </div>
      </div>

      <div v-if="reply.children && reply.children.length" class="ms-4 mt-3">
        <ReplyCard
          v-for="child in reply.children"
          :key="child.id"
          :reply="child"
          @toggle-like="$emit('toggle-like', $event)"
        />
      </div>
    </div>
    </div>
    
  </div>

 
    
  </template>
  
  <script setup>
  import InitialAvatar from './InitialAvatar.vue'
  defineProps(['reply'])
  defineEmits(['toggle-like'])
  
  import ReplyCard from './ReplyCard.vue'
  </script>
  