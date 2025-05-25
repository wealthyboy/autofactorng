<template>
  <div class="d-flex gap-1 mb-1">
    <!-- Avatar (outside card) -->
    <InitialAvatar :name="topic.user.name" :size="40" class="avatar-shadow mt-3" />

    <!-- Post Content Card -->
    <div class="card w-100 border rounded-4 px-3 py-2">
      <div class="card-body p-0">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
            <div>
              <h5 class="card-title mb-1 fw-bold">{{topic.isAdmin ? 'Admin' : topic.user.name }}</h5>
              <p class="text-muted mb-0">
                <i class="bi bi-folder2-open me-1"></i>{{ topic.category.name }}
              </p>
            </div>
          <small class="text-muted d-none d-lg-inline text-black">{{ topic.date }}</small>
        </div>

        <!-- Content -->
        <div class="mb-3 text-center m-2">
            <img
              v-if="topic.image"
              :src="topic.image"
              class="img-fluid rounded shadow-sm reply-image"
              alt="topic image"
            />
          </div>
        <p class="mt-2 py-3 mb-2">
            <span v-if="!showFullContent" v-html="truncatedContent"></span>
            <span v-else v-html="topic.content"></span>
            <template v-if="isTruncated">
              <button class="btn btn-link btn-sm p-0 ps-1" @click="showFullContent = !showFullContent">
                {{ showFullContent ? 'Read less' : 'Read more' }}
              </button>
            </template>
          </p>

        <!-- Footer: icons and reply -->
        <div class="d-flex align-items-center justify-content-between text-muted mt-3">
          <div class="d-flex gap-3 align-items-center ">
            <small class="text-muted d-md-none">{{ topic.date }}</small>
          </div>
          <div class="d-flex align-items-center gap-3">
           
            <button
                class="btn btn-sm btn-link text-decoration-none p-0 text-pm-color "
                @click="$emit('open-reply-modal', topic)"
              >
                <i class="bi bi-reply me-1"></i> Reply
              </button>
          </div>
        </div>
      </div>
    </div>
  </div>

     <div class="mt-1 mx-5  border-raised mb-2">
        <div class="d-flex align-items-center mb-2">
          <div class="me-4 text-center">
            <strong class="text-danger">{{ topic.views_count || 0 }}</strong><br />
            <small class="text-muted">views</small>
          </div>
        

        
          <div class="me-4 text-center">
            <strong class="text-danger">{{ topic.replies.length }}</strong><br />
            <small class="text-muted">replies</small>
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
import { ref, computed } from 'vue'

import InitialAvatar from './InitialAvatar.vue'
const props = defineProps(['topic'])
defineEmits(['toggle-like','open-reply-modal'])

const topic = props.topic

function getRandomColor(seed) {
  const colors = ['#a0d911', '#fadb14', '#13c2c2', '#eb2f96', '#722ed1', '#1890ff'];
  return colors[parseInt(seed) % colors.length];
}


const maxLength = 300;

const showFullContent = ref(false)

const isTruncated = computed(() => topic.content.length > maxLength)

const truncatedContent = computed(() => {
  if (isTruncated.value) {
    return topic.content.slice(0, maxLength) + '...'
  }
  return topic.content
})

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

.reply-image {
  max-width: 100%;
  height: auto;
  max-height: 400px; /* Prevent overly tall images */
  object-fit: cover; /* Crop to maintain uniform look */
  border: 1px solid #dee2e6; /* Light border */
}

.reply-image:hover {
  transform: scale(1.02);
  transition: transform 0.2s ease-in-out;
}
</style>
