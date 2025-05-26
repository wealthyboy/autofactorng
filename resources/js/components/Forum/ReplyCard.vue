<template>
  <div>
    <div class="d-flex gap-1 mb-3 mt-3">
      <!-- Avatar -->
      <InitialAvatar :name="reply.user.name" :size="40" class="avatar-shadow mt-3" />

      <!-- Post Content Card -->
      <div class="card w-100 border rounded-4 px-3 py-2">
        <div class="card-body p-0">
          <!-- Header -->
          <div class="d-flex justify-content-between align-items-center border-bottom py-3">
            <div>
              <h5 class="card-title mb-1 fw-bold">{{ reply.user.name }}</h5>
            </div>
            <small class="text-muted  text-black">{{ reply.date }}</small>
          </div>

          <!-- Content -->
         
          <p class="mt-2 py-3 mb-2">
            <span v-if="!showFullContent" v-html="truncatedContent"></span>
            <span v-else v-html="reply.content"></span>
            <template v-if="isTruncated">
              <button class="btn btn-link btn-sm p-0 ps-1" @click="showFullContent = !showFullContent">
                {{ showFullContent ? 'Read less' : 'Read more' }}
              </button>
            </template>
          </p>
          <div class="mb-3 text-left  m-2">
            <img
              v-if="reply.image"
              :src="reply.image"
              class="img-fluid rounded shadow-sm reply-image"
              alt="reply image"
            />
          </div>

          <!-- Footer: Actions -->
          <div class="">
            <div class="d-flex justify-content-end align-items-center gap-3 me-4">

             
            
              <!-- Replies Toggle Button -->
              <button v-if="hasChildren" class="btn btn-sm btn-link text-decoration-none p-0 " @click="toggleReplies">
                <i class="bi" :class="showReplies ? 'bi-chevron-up' : 'bi-chevron-down'"></i>
                {{ reply.children.length }} {{ reply.children.length === 1 ? 'Reply' : 'Replies' }}

              </button>


               <!-- Reply Button -->


               
              

              <div class="ms-auto d-flex" v-if="depth !== 1">

                <button
                @click="$emit('toggle-like', reply)"

                class="btn btn-sm btn-link text-decoration-none p-0 text-danger like-button me-4"
                :class="{ 'liked': isLiked }"
              > 
              {{ reply.likes_count  }}

                <i class="bi bi-hand-thumbs-up "></i> 
                
                Like
              </button>
                <button                 
                   @click="$emit('open-reply-modal', reply)"
                   class="btn btn-sm btn-link text-decoration-none d-flex p-0 text-pm-color ">
                  <i class="bi bi-reply me-1"></i> Reply
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Collapsible Replies -->
        <div v-if="showReplies" class="ms-4 mt-3">
          <ReplyCard
            v-for="child in reply.children"
            :key="child.id"
            :reply="child"
            :depth="depth + 1"
            @toggle-like="$emit('toggle-like', $event)"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import InitialAvatar from './InitialAvatar.vue'
import ReplyCard from './ReplyCard.vue'

// Correct way to access props in <script setup>
const props = defineProps({
  reply: Object,
  depth: {
    type: Number,
    default: 0,
  },
})

const isLiked = ref(false)



const emit = defineEmits(['toggle-like', 'open-reply-modal'])

// Accessing the prop correctly
const reply = props.reply

const showReplies = ref(false)

const toggleReplies = () => {
  showReplies.value = !showReplies.value
}


// ✅ Safely check for children replies
const hasChildren = computed(() => {
  return reply?.children && reply.children.length > 0
})

const maxLength = 300 // You can adjust this threshold

const showFullContent = ref(false)

const isTruncated = computed(() => reply.content.length > maxLength)

const truncatedContent = computed(() => {
  if (isTruncated.value) {
    return reply.content.slice(0, maxLength) + '...'
  }
  return reply.content
})
</script>
<style scoped>


.like-button.liked {
  animation: zoom-out 0.3s ease-in-out;
}

@keyframes zoom-out {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.4);
  }
  100% {
    transform: scale(1);
  }
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
