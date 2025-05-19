<template>
    <div
      style="z-index: 2000"
      
      class=" w-100 h-100  d-flex justify-content-center align-items-center mb-5"
      @click.self="close"
    >
      <div class="card  p-4">
        <h5 class="text-left mb-3">Add A Post</h5>
  
        <form @submit.prevent="submitReply">

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input
                id="title"
                type="text"
                class="form-control"
                v-model="form.title"
                placeholder="Enter a title "
                />
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select
                    id="category"
                    class="form-select"
                    v-model="form.forum_category_id"
                >
                    <option disabled value="">Select a category</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.name }}
                    </option>
                </select>
            </div>
          <div ref="editorRef" class="mb-3"></div>
          <div class="mb-3">
              <label for="content" class="form-label">Content</label>
              <textarea id="editor" ref="editorRef" name="content" class="form-control" rows="" placeholder="Write your post here..."></textarea>
          </div>

    
          <div class="mb-3">
            <input type="file" class="form-control" @change="previewImage" accept="image/*" />
            <div v-if="imageUrl" class="mt-2 position-relative">
              <img v-if="imageUrl" :src="imageUrl" alt="Preview" class="img-thumbnail mt-2" style="max-width: 150px; height: auto;" />
              <button type="button" class="btn-close position-absolute top-0 " @click="removeImage"></button>
            </div>
          </div>
  
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary w-50" :disabled="loading">
              {{ loading ? 'Submitting...' : 'Submit' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, onBeforeUnmount, watch } from 'vue'
  
  const props = defineProps({
    show: Boolean,
    parentId: [Number, null],
    topicId: Number,
    categories: Array
  })
  
  const emit = defineEmits(['close', 'submitted'])
  
  const form = ref({
    content: '',
    image: null,
    title: "",
    forum_category_id: ""
  })
  const imageUrl = ref(null)
  const loading = ref(false)
  
  const editorRef = ref(null)
  let editorInstance = null

  onMounted(async () => {
    const formSkelenton = document.getElementById('form-skelenton');
    if (formSkelenton){
        formSkelenton.classList.add('d-none')
    }
    const editorInstance = await ClassicEditor.create(editorRef.value)
      editorInstance.model.document.on('change:data', () => {
        form.value.content = editorInstance.getData()
      })

  })
  
  watch(
    () => props.show,
    async (visible) => {
      if (visible && !editorInstance) {
        editorInstance = await ClassicEditor.create(editorRef.value, {
          removePlugins: ['ImageUpload', 'MediaEmbed'],
        })
        editorInstance.model.document.on('change:data', () => {
          form.value.content = editorInstance.getData()
        })
      }
    }
  )

  
  
  function previewImage(e) {
    const file = e.target.files[0]
    if (file && file.size <= 20 * 1024 * 1024) {
      form.value.image = file
      imageUrl.value = URL.createObjectURL(file)

     
    } else {
      alert('Image must be less than 20MB')
    }
  }
  
  function removeImage() {
    if (imageUrl.value) URL.revokeObjectURL(imageUrl.value)
    form.value.image = null
    imageUrl.value = null
  }
  
  function close() {
    form.value.content = ''
    form.value.image = null
    if (imageUrl.value) URL.revokeObjectURL(imageUrl.value)
    imageUrl.value = null
  
    if (editorInstance) editorInstance.setData('')
  
    emit('close')
  }
  
  async function submitReply() {
    if (loading.value) return
    loading.value = true
  
    const data = new FormData()
    data.append('content', form.value.content)
    data.append('title', form.value.title)
    data.append('forum_category_id', form.value.forum_category_id)




    if (props.parentId) data.append('parent_id', props.parentId)
    if (form.value.image) data.append('image', form.value.image)
  
    try {
        if (!confirm('Are you sure you want to submit this post?')) return;
        await axios.post('/topic', data)

      close()

      location.href = '/forum'
    } catch (err) {
      console.error(err)
      alert('Failed to submit reply')
    } finally {
      loading.value = false
    }
  }
  
  onBeforeUnmount(() => {
    if (editorInstance) {
      editorInstance.destroy()
      editorInstance = null
    }
  })
  </script>
  