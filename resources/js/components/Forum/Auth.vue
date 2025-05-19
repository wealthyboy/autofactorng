<template>
    <div
      style="z-index: 2000"
      
      class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex justify-content-center align-items-center"
      @click.self="close"
    >
      <div class="w-100 w-md-75 w-lg-50 mx-auto">
        <div v-if="showLogin"  class="card  p-4">
          <login />  
          <div class="text-center mt-3">
            Dont have an account yet? <a @click.prevent="toggleForm" href="#" class="color--primary bold">Create One</a>
          </div>
      </div>
      <div  class="card  p-4" v-else>
        <div class="register">
            <Register />
        </div>
        <div class="text-center mt-3">
            Already  have an account? <a @click.prevent="toggleForm" href="#" class="color--primary bold">Login</a>
          </div>
      </div>
      </div>
      
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, onBeforeUnmount, watch } from 'vue'
  import Login from '../auth/Login.vue'
  import Register from '../auth/Register.vue'

  
  const props = defineProps({
    show: Boolean,
    parentId: [Number, null],
    topicId: Number,
  })
  
  const emit = defineEmits(['close', 'submitted'])
  
  const form = ref({
    content: '',
    image: null,
  })
  const imageUrl = ref(null)
  const loading = ref(false)
  
  const editorRef = ref(null)
  let editorInstance = null

  const showLogin = ref(true)

    function toggleForm() {

        showLogin.value = !showLogin.value
    }
  
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
  
 


  </script>
  