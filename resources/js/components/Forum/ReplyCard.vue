<template>
  <div>
    <div class="d-flex gap-1 mb-3 mt-3">
      <!-- Avatar -->
      <InitialAvatar :name="reply.user.name" :size="48" class="avatar-shadow mt-3" />

      <!-- Post Content Card -->
      <div class="card w-100 border rounded-4 px-3 py-2">
        <div class="card-body p-0">
          <!-- Header -->
          <div class="d-flex justify-content-between align-items-center border-bottom py-3">
            <div>
              <h5 class="card-title mb-1">{{ reply.user.name }}</h5>
            </div>
            <small class="text-muted d-none d-lg-inline text-black">{{ reply.created_at }}</small>
          </div>

          <!-- Content -->
          <p class="mt-2 py-3 mb-2">
            {{ showFullContent }}
            <span v-if="!showFullContent" v-html="truncatedContent"></span>
            <span v-else v-html="reply.content"></span>
            <template v-if="isTruncated">
              <button class="btn btn-link btn-sm p-0 ps-1" @click="showFullContent = !showFullContent">
                {{ showFullContent ? 'Read less' : 'Read more' }}
              </button>
            </template>
          </p>

          <!-- Footer: Actions -->
          <div class="d-flex align-items-center justify-content-between text-muted mt-3">
            <small class="d-md-none">{{ reply.created_at }}</small>
            <div class="d-flex align-items-center justify-content-between gap-3 w-100">
            
              <!-- Replies Toggle Button -->
              <button v-if="hasChildren" class="btn btn-sm btn-link text-decoration-none p-0" @click="toggleReplies">
                <i class="bi" :class="showReplies ? 'bi-chevron-up' : 'bi-chevron-down'"></i>
                {{ reply.children.length }} {{ reply.children.length === 1 ? 'Reply' : 'Replies' }}

              </button>


               <!-- Reply Button -->
              

              <div class="ms-auto">
                <button                 
                   @click="$emit('open-reply-modal', reply)"
                   class="btn btn-sm btn-link text-decoration-none d-flex p-0">
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
const props = defineProps(['reply'])
defineEmits(['toggle-like', 'open-reply-modal'])

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
