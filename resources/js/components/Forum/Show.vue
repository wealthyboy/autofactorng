<template>
  <div class="container my-4" ref="scrollContainer" @scroll="handleScroll" style="overflow-y: auto; max-height: 80vh">
    <template v-if="!loading">
      <Topic
        :topic="topic"
        @toggle-like="toggleTopicLike"
        @open-reply-modal="showReplyModal"
      />

      <ReplyCard
        v-for="reply in topic.replies"
        :key="reply.id"
        :reply="reply"
        @toggle-like="toggleReplyLike"
        @open-reply-modal="showReplyModal"
      />

      <!-- Loading Spinner -->
      <div v-if="loadingMore" class="text-center py-3">
        <div class="spinner-border text-primary" role="status"></div>
      </div>

      <Auth />

      <div v-if="!hasMoreReplies" class="text-center text-muted my-3">
        No more replies.
      </div>
    </template>

    <!-- Reply Modal -->
    <ReplyModal
      v-if="showModal"
      :topic="selectedTopic"
      @close="showModal = false"
    />
  </div>
</template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import axios from 'axios'
  
  import Topic from './Topic.vue'
  import ReplyCard from './ReplyCard.vue'
  import Auth from './Auth.vue'

  import ReplyModal from './ReplyModal.vue'
  import PostSkeleton from "./PostSkeleton"

  
  const topic = ref({})
  const loading = ref(true)

  
  onMounted(async () => {

    try {
      const response = await axios.get(location.href) // Pass topic ID as prop if needed
        topic.value = response.data
      } catch (e) {
      console.error(e)
    } finally {
      const skeleton = document.getElementById('post-skelenton');
      if (skeleton) {
        skeleton.classList.add('d-none');
      }
      loading.value = false
    }
   
  })
  
  function addReply(reply) {
    topic.value.replies.push(reply)
  }
  
  async function toggleTopicLike() {
    await axios.post(`/api/topics/${topic.value.id}/toggle-like`)
    topic.value.liked_by_user = !topic.value.liked_by_user
    topic.value.likes_count += topic.value.liked_by_user ? 1 : -1
  }
  
  async function toggleReplyLike(replyId) {
    const reply = topic.value.replies.find(r => r.id === replyId)
    await axios.post(`/api/replies/${replyId}/toggle-like`)
    reply.liked_by_user = !reply.liked_by_user
    reply.likes_count += reply.liked_by_user ? 1 : -1
  }


  const topics = ref([]) // your list of topics
  const showModal = ref(false)
  const selectedTopic = ref(null)

  function showReplyModal(topic) {
    console.log(true)
    selectedTopic.value = topic
    showModal.value = true
  }
  </script>
  