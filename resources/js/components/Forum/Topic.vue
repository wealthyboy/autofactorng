<template>
  <div class="d-flex gap-1 mb-1">
    <!-- Avatar (outside card) -->
    <InitialAvatar :name="topic.user.name" :size="48" class="avatar-shadow" />

    <!-- Post Content Card -->
    <div class="card w-100 border rounded-4 px-3 py-2">
      <div class="card-body p-0">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
            <div>
              <h5 class="card-title mb-1">{{ topic.title }}</h5>
              <p class="text-muted mb-0">
                <i class="bi bi-folder2-open me-1"></i>{{ topic.category.name }}
              </p>
            </div>
          <small class="text-muted d-none d-lg-inline text-black">{{ topic.date }}</small>
        </div>

        <!-- Content -->
        <p class="mt-2 mb-2">{{ topic.content }}</p>

        <!-- Footer: icons and reply -->
        <div class="d-flex align-items-center justify-content-between text-muted mt-3">
          <div class="d-flex gap-3 align-items-center ">
            <small class="text-muted d-md-none">{{ topic.date }}</small>
          </div>
          <div class="d-flex align-items-center gap-3">
            <button @click="$emit('toggle-like')" class="btn btn-sm p-1" :class="topic.liked_by_user ? 'btn-success' : 'btn-outline-success'">
              <i class="bi bi-hand-thumbs-up"></i> {{ topic.likes_count }}
            </button>
            <button
                class="btn btn-sm btn-link text-decoration-none p-0"
                @click="$emit('open-reply-modal', topic)"
              >
                <i class="bi bi-reply me-1"></i> Reply
              </button>
          </div>
        </div>
      </div>
    </div>
  </div>

     <div class="mt-1 mx-5">
        <div class="d-flex align-items-center mb-2">
          <div class="me-4 text-center">
            <strong class="text-danger">{{ topic.views_count }}</strong><br />
            <small class="text-muted">views</small>
          </div>
          <div class="me-4 text-center">
            <strong class="text-danger">{{ topic.likes_count }}  45</strong><br />
            <small class="text-muted">likes</small>
          </div>
          <div class="me-4 text-center">
            <strong class="text-danger">{{ topic.users.length }}</strong><br />
            <small class="text-muted">users</small>
          </div>

          <!-- Avatars -->
          <div class="d-flex ">
            <div
              v-for="(user, index) in topic.users"
              :key="user.id"
              class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
              :style="{
                width: '36px',
                height: '36px',
                backgroundColor: getRandomColor(user.id),
                marginLeft: index !== 0 ? '-12px' : '0',
                zIndex: topic.users.length - index,
                border: '2px solid #fff',
              }"
            >

            {{ topic.users.length - index }}
              <span style="font-size: 0.9rem">{{ user.name.charAt(0).toUpperCase() }}</span>
            </div>
          </div>
        </div>
        </div>

      
</template>

<script setup>
import InitialAvatar from './InitialAvatar.vue'
defineProps(['topic'])
defineEmits(['toggle-like','open-reply-modal'])

// Utility: pick a color per user ID for avatar backgrounds
function getRandomColor(seed) {
  const colors = ['#a0d911', '#fadb14', '#13c2c2', '#eb2f96', '#722ed1', '#1890ff'];
  return colors[parseInt(seed) % colors.length];
}
</script>
<style scoped>

.card .avatar {
  font-size: 1.2rem;
  font-weight: bold;
}

.avatar-shadow {
  flex-shrink: 0;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  overflow: hidden;
  background-color: #6c757d;
  color: white;
  font-weight: bold;
  font-size: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
