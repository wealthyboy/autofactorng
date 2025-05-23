<template>
  <div ref="container" class="container p-3 mb-5 ">

    <div class="d-flex justify-content-start align-items-center mb-5">
    <!-- Categories Dropdown -->
    <div class="dropdown me-2">
      <button
        class="btn btn-outline-secondary dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        {{ selectedCategory?.name || "Categories" }}
      </button>
      <ul class="dropdown-menu">
        <li v-for="category in categories" :key="category.id">
          <a
            class="dropdown-item"
            href="#"
            @click.prevent="selectCategory(category)"
          >
            {{ category.name }}
          </a>
        </li>
      </ul>
    </div>

    <!-- Filter Tabs -->
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a
          class="nav-link"
          :class="{ active: activeTab === 'desc' }"
          href="#"
          @click.prevent="selectTab('desc')"
        >
          Latest
        </a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link text-black"
          :class="{ active: activeTab === 'asc' }"
          href="#"
          @click.prevent="selectTab('asc')"
        >
        Oldest
        </a>
      </li>
    </ul>
  </div>

    <!-- Header row -->
    <div class="d-flex fw-bold border p-3 ">
      <div class="flex-grow-1">Topic</div>
      <div class="text-end  d-none d-md-flex " style="width: 80px;"></div>
      <div class="text-end  d-none d-md-flex " style="width: 80px;">Replies</div>
      <div class="text-end  d-none d-md-flex " style="width: 80px;"> Views</div>
      <div class="text-end  d-none d-md-flex " style="width: 100px;"> Activity</div>
    </div>

    <!-- Topics -->

      <div v-for="topic in pinnedTopics" :key="topic.id" class="d-flex thread-row border border-bottom p-3">
      <div class="topic-cell">
        <div class="thread-title d-flex">
          <i  class="bi bi-pin-angle-fill text-warning me-1"  title="Pinned"></i>
           <i class="bi bi-lock-fill text-dark" title="Locked"></i>
          <h5 class="mb-1">
            <a :href="`/forum/${topic.id}`" class="text-dark fw-bold text-decoration-none">{{ topic.title }}</a>
          </h5>
        </div>
        <div class="thread-meta">
          <i class="bi bi-folder2-open me-1 "></i> <span class="text-pm-color">{{ topic.category?.name }}</span> 
        </div>
        <div v-html="topic.content?.slice(0, 120) +'...'" class="text-muted small mt-1"></div>



        <div class="mt-1  border-raised mb-2  d-lg-none">
          <div class="d-flex align-items-center mb-2">
            <div class="me-4 text-center">
              <strong class="text-danger">{{ topic.views_count || 0 }}</strong><br />
              <small class="text-muted">views</small>
            </div>

            <div class="me-4 text-center">
              <strong class="text-danger">{{ topic.replies.length || 0 }}</strong><br />
              <small class="text-muted">replies</small>
            </div>

            <!-- Avatars -->
            <div class="d-flex">
              <div
                v-for="(user, index) in topic.latest_users"
                :key="user.id"
                class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                :style="{
                  width: '32px',
                  height: '32px',
                  backgroundColor: getRandomColor(user.id),
                  marginLeft: index !== 0 ? '-12px' : '0',
                  zIndex: topic.latest_users.length - index,
                  border: '2px solid #fff',
                }"
              >
                <span style="font-size: 0.9rem">{{ user.name.charAt(0).toUpperCase() }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

        <div class="d-flex  d-none d-md-flex thread-row justify-content-center meta-cell">
          <div
            v-for="user in topic.latest_users"
            :key="user.id"
            class="avatar bg-primary text-white rounded-circle d-flex mt-1 align-items-center justify-content-center me-1"

            :style="{
                  width: '32px',
                  height: '32px',
                  backgroundColor: getRandomColor(user.id),
                  marginLeft: index !== 0 ? '-12px' : '0',
                  zIndex: topic.latest_users.length - index,
                  border: '2px solid #fff',
            }"
          >
            {{ user.name?.charAt(0) }}
          </div>
        </div>

        <div class="meta-cell d-flex  d-none d-md-flex justify-content-center align-items-center ">
          <a class="text-decoration-none" :href="`/forum/${topic.id}`">
            {{ topic.replies?.length || 0 }}
          </a> 
        </div>
        <div class="meta-cell cursor-pointer d-flex  d-none d-md-flex justify-content-center align-items-center me-2">
          {{ topic.views_count  || 0 }}
         
        </div>
        <div class="meta-cell d-flex  d-none d-md-flex justify-content-center align-items-center me-4">
          {{ topic.date }}
        </div>
      </div>
     <template  v-if="regularTopics.length">
      <div v-for="topic in regularTopics" :key="topic.id" class="d-flex thread-row border border-bottom p-3">
      <div class="topic-cell">
        <div class="thread-title" :class="{ pinned: topic.pinned }">
          <i v-if="topic.pinned" class="bi bi-pin-angle-fill text-warning me-1"></i>
          <h5 class="mb-1">
            <a :href="`/forum/${topic.id}`" class="text-dark fw-bold text-decoration-none">{{ topic.title }}</a>
          </h5>
        </div>
        <div class="thread-meta">
          <i class="bi bi-folder2-open me-1 "></i> <span class="text-pm-color">{{ topic.category?.name }}</span> 
        </div>
        <div v-html="topic.content?.slice(0, 120) +'...'" class="text-muted small mt-1"></div>



        <div class="mt-1  border-raised mb-2  d-lg-none">
          <div class="d-flex align-items-center mb-2">
            <div class="me-4 text-center">
              <strong class="text-danger">{{ topic.views_count || 0 }}</strong><br />
              <small class="text-muted">views</small>
            </div>

            <div class="me-4 text-center">
              <strong class="text-danger">{{ topic.replies.length || 0 }}</strong><br />
              <small class="text-muted">replies</small>
            </div>

            <!-- Avatars -->
            <div class="d-flex">
              <div
                v-for="(user, index) in topic.latest_users"
                :key="user.id"
                class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                :style="{
                  width: '32px',
                  height: '32px',
                  backgroundColor: getRandomColor(user.id),
                  marginLeft: index !== 0 ? '-12px' : '0',
                  zIndex: topic.latest_users.length - index,
                  border: '2px solid #fff',
                }"
              >
                <span style="font-size: 0.9rem">{{ user.name.charAt(0).toUpperCase() }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

        <div class="d-flex  d-none d-md-flex thread-row justify-content-center meta-cell">
          <div
            v-for="user in topic.latest_users"
            :key="user.id"
            class="avatar bg-primary text-white rounded-circle d-flex mt-1 align-items-center justify-content-center me-1"

            :style="{
                  width: '32px',
                  height: '32px',
                  backgroundColor: getRandomColor(user.id),
                  marginLeft: index !== 0 ? '-12px' : '0',
                  zIndex: topic.latest_users.length - index,
                  border: '2px solid #fff',
            }"
          >
            {{ user.name?.charAt(0) }}
          </div>
        </div>

        <div class="meta-cell d-flex  d-none d-md-flex justify-content-center align-items-center ">
          <a class="text-decoration-none" :href="`/forum/${topic.id}`">
            {{ topic.replies?.length || 0 }}
          </a> 
        </div>
        <div class="meta-cell cursor-pointer d-flex  d-none d-md-flex justify-content-center align-items-center me-2">
          {{ topic.views_count  || 0 }}
         
        </div>
        <div class="meta-cell d-flex  d-none d-md-flex justify-content-center align-items-center me-4">
          {{ topic.date }}
        </div>
      </div>

      <div class="text-center mt-3" v-if="loading">
        <div class="spinner-border" role="status"></div>
      </div>
     </template>

     <template v-if="!pinnedTopics.length && !loading">
        <div class="text-center mb-4">
        </div>
     </template>
 

    <!-- Loader -->
 

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, watch } from 'vue'
import axios from 'axios'

const props = defineProps({
  categories: Array
})

const regularTopics = ref([])
const pinnedTopics = ref([])

const page = ref(1)
const loading = ref(false)
const hasMore = ref(true)
const selectedCategory = ref(null)
const activeTab = ref('desc')
const isLoading = ref(false)

const fetchTopics = async (reset = false) => {
  if (loading.value || !hasMore.value) return

  loading.value = true
  if (reset) {
    regularTopics.value = []
    page.value = 1
    hasMore.value = true
  }

  try {

    const params = {
      page: page.value,
      category: selectedCategory.value?.name || null,
      sort: activeTab.value
    }

    const res = await axios.get(`/forum`, { params })
    const fetched = res.data.topics.data
    pinnedTopics.value = res.data.pinnedTopics

    if (fetched.length === 0) {
      hasMore.value = false
    } else {
      regularTopics.value.push(...fetched)
      page.value++
    }

    
  } catch (err) {
    console.error('Failed to fetch topics:', err)
  } finally {
    loading.value = false
  }
}

const selectCategory = (category) => {
  selectedCategory.value = category
  fetchTopics(true)
}

const selectTab = (tab) => {
  activeTab.value = tab
  fetchTopics(true)
}

function getRandomColor(seed) {
  const colors = ['#a0d911', '#fadb14', '#13c2c2', '#eb2f96', '#722ed1', '#1890ff']
  return colors[parseInt(seed) % colors.length]
}

// Infinite Scroll
const handleScroll = () => {
  const scrollY = window.scrollY + window.innerHeight
  const threshold = document.documentElement.scrollHeight - 100
  if (scrollY >= threshold) {
    fetchTopics()
  }
}

const showTopicInfo = ref(false)

function isMobileLandscape() {
  return (
    window.innerWidth <= 991 &&
    window.matchMedia('(orientation: landscape)').matches
  )
}

function handleOrientation() {
  showTopicInfo.value = isMobileLandscape()
}



  function toggleTopicInfoVisibility() {
    const el = document.getElementById("topicInfo");
    if (isMobileLandscape()) {
      el.classList.remove("d-none");
    } else {
      el.classList.add("d-none");
    }
  }

onMounted(() => {
  window.addEventListener('pageshow', (event) => {
    if (event.persisted) {
      window.location.reload()
    }
  })
  fetchTopics()
  window.addEventListener('scroll', handleScroll)

  handleOrientation()
  window.addEventListener('resize', handleOrientation)
  window.addEventListener('orientationchange', handleOrientation)
})

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll)
  window.removeEventListener('resize', handleOrientation)
  window.removeEventListener('orientationchange', handleOrientation)
})
</script>


<style scoped>
.nav-tabs .nav-link.active {
  font-weight: bold;
  border-bottom: 3px solid #dc3545;
}

@media (min-width: 320px) and (max-width: 991.98px) and (orientation: landscape) {
  .mobile-landscape-only {
    display: block !important;
  }
}

.mobile-landscape-only {
  display: none !important;
}

</style>

