<template>

<transition name="fade">

 
            <div
      style="z-index: 2000"
      
      class="position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex justify-content-center align-items-center"
      @click.self="close"
    >
    <div class="container  animate__animated animate__bounceInUp">

    
      <div class="row">
          <div class="col-md-6 col-12  mx-auto">

         
           
      <div class="w-100 w-md-75 w-lg-50 mx-auto position-relative">
        <div  v-if="showLogin"  class="card  p-4">

          <button
    @click="close"
    type="button"
    class="btn-close position-absolute top-0 end-0 m-3"
    aria-label="Close"
  ></button>

          <div class="card-title text-center border-bottom">
              <h2 class="fw-bold">Login</h2>
              <p>Login to perform that operation</p>
            </div>
          <login :reload="true" />  
          <small class="text-center mt-3">
            Dont have an account yet? <a @click.prevent="toggleForm" href="#" class="fw-bold text-black bold">Create One</a>
          </small>
      </div>
      <div  class="card  p-4   position-relative"  v-else>

        <button
    @click="close"
    type="button"
    class="btn-close position-absolute top-0 end-0 m-3"
    aria-label="Close"
  ></button>

        <div class="card-title text-center border-bottom">
              <h2 class="fw-bold">Register</h2>
        </div>
        <div class="register">
            <Register  :reload="true" />
        </div>
        <small class="text-center mt-3">
            Already  have an account? <a @click.prevent="toggleForm" href="#" class="fw-bold text-black bold">Login</a>
          </small>
      </div>
      </div>
      
    </div>
          </div>
      </div>
    </div>

    </transition>
  
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
  
    emit('close')
  }
  
 


  </script>
  