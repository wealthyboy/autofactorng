<template>
  <div class="mt-3" ref="scrollContainer" @scroll="handleScroll">

    
    <template v-if="!loading">
      <Topic
        :topic="topic"
        @toggle-like="toggleTopicLike"
        @open-reply-modal="showTopicReplyModal"
      />

      <ReplyCard
        v-for="reply in topic.replies"
        :key="reply.id"
        :reply="reply"
        @toggle-like="toggleReplyLike"
        :depth="0"
        @open-reply-modal="showReplyModal"
      />

      <!-- Loading Spinner -->
      <div v-if="loadingMore" class="text-center py-3">
        <div class="spinner-border text-primary" role="status"></div>
       </div>

          <Auth        
            @close="showLogin = false"
            :reload="true" v-if="showLogin" 
          />
       <div v-if="!hasMoreReplies" class="text-center text-muted my-3"></div>
    </template>

    <!-- Reply Modal -->
    <ReplyModal
      v-if="showModal"
      :selected="selected"
      @close="showModal = false"
      @submitted="updateTopic"
    />
  </div>
</template>
  
  <script setup>
  import { ref, onMounted, reactive } from 'vue'
  import axios from 'axios'
  
  import Topic from './Topic.vue'
  import ReplyCard from './ReplyCard.vue'
  import Auth from './Auth.vue'

  import ReplyModal from './ReplyModal.vue'
  import PostSkeleton from "./PostSkeleton"

  
  const topic = ref({})
  const loading = ref(true)
  const showLogin = ref(false)


  
  onMounted(async () => {

    window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
      window.location.reload()
    }
  })

  loading.value = true
  fetchTopic()
   
  })


  async function fetchTopic() {
  try {
    const response = await axios.get(location.href) // Pass topic ID as prop if needed
    topic.value = response.data
  } catch (e) {
    console.error(e)
  } finally {
    const skeleton = document.getElementById('post-skelenton')
    if (skeleton) {
      skeleton.classList.add('d-none')
    }
    loading.value = false
  }
}

  
  function addReply(reply) {
    topic.value.replies.push(reply)
  }

  function updateTopic(res) {
    console.log(res)
    topic.value = res
    showModal.value = false
   // fetchTopic()

  }



  
  async function toggleTopicLike() {

    if (!topic.value.isLoggedIn) {
      showLogin.value = true
      return  
    }    
    await axios.post(`/forum/${topic.value.id}/toggle-like`)
    topic.value.liked_by_user = !topic.value.liked_by_user
    topic.value.likes_count += topic.value.liked_by_user ? 1 : -1
  }
  
  async function toggleReplyLike(reply) {
    await axios.post(`/forum/${reply.id}/reply-like`)
    reply.liked_by_user = !reply.liked_by_user
    reply.likes_count += reply.liked_by_user ? 1 : -1
  }


  const topics = ref([]) // your list of topics
  const showModal = ref(false)
  const selected = reactive({})

  function showReplyModal(reply) {
    
    if (!topic.value.isLoggedIn) {
      showLogin.value = true
      return  
    }
    selected.isReply = true
    selected.reply = reply
    selected.topic_id = reply.topic_id
    selected.reply_id = reply.id
    showModal.value = true
  }


  function showTopicReplyModal(reply) 
  {
    
    if (!topic.value.isLoggedIn) {
      showLogin.value = true
      return  
    }

    selected.isReply = false
    selected.topic = topic
    selected.topic_id = topic.value.id
    selected.reply_id = null
    showModal.value = true
  }


  function showLoginModal(topic) {
    showLogin.value = true
  }


  
  </script>
  