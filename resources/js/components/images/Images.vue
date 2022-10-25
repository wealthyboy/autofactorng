<template>
    <div>
            <div   class="row">
                <div  class="col-md-12  text-center">
                    <h3 class="title text-center"> Upload Images</h3>
                    <p class="description text">Click on anywhere below to upload image </p>
                </div>
                <div   class="col-md-12 col-sm-6 col-xs-6">
                    <input accept="image/*"  class="upload_input" multiple="true"  @change="getFileData" data-msg="Upload  your image" type="file" id="upload_file_input" name="product_image"  />
                    <div id="j-drop" @click.prevent="activateFile($event)"  class="j-activate j-drop">
                        <div  v-if="!images.length" class="j-activate upload-text"> 
                            <a   class="j-activate " href="#">
                                <img class="j-activate" src="/store/img/upload_icon.png">
                                <b>Click on anywhere to upload image</b> 
                            </a>
                        </div>
                        <div id="j-details"  class="j-details j-activate">
                            <template v-if="images.length">
                                <div v-for="image in images" :key="image"  class="j-complete">
                                    <div class="j-preview">
                                        <img class="img-thumnail" :src="image" />
                                        <!-- <div class="progress-container progress-warning">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                                <span class="progress-value mb-3">60%</span>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div id="remove_image" class="remove_image">
                                            <a  class="remove-image"   @click.prevent="removeImage($event)" href="#">Remove</a> 
                                        </div>
                                        <input type="hidden" class="file_upload_input stored_image_url"  :value="image"  name="images[]">
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        <error-message  :error="error"  />
    </div>
</template>  
<script>

    import ErrorMessage from '../messages/components/Error'
    import { mapActions, mapGetters } from 'vuex'
    export default {
        components:{
           ErrorMessage,
        },
        data() {
            return {
               errors: '',
               loading: false,
               file: '',
               error: null,
               uploading: false,
               grandParent: '',
               showError: false,
               settings:[],
               percentCompleted: 0,
               allowedFileTypes: ['image/jpeg','image/png','image/gif'],
               
            }
        },
        computed:{
            ...mapGetters({
               images: 'images'
            })
        },
     
        methods: {
            activateFile(evt){
                let fileInput = document.getElementById("upload_file_input")
                if ( evt.target.classList.contains('j-activate') ){
                    fileInput.click()
                }
            },
            getFileData(){
                //get the value of file input
                this.uploading =true
                this.file  = document.getElementById("upload_file_input").files[0];
                let uploadLInk = document.querySelector('.upload-text')
                if ( uploadLInk ){
                    uploadLInk.classList.add('d-none')
                } 
                this.uploading =true;
                let target  = document.getElementById("j-details");
                let parent1 = document.createElement('div');
                parent1.setAttribute('class','j-complete j-loading')
                let parent2 = document.createElement('div');
                parent2.setAttribute('class','j-preview loading')
                parent1.appendChild(parent2)
                target.appendChild(parent1)
                //validation here
                if ( !this.allowedFileTypes.includes(this.file.type) ){
                    this.errors = "Your selected  is not alllowed"
                    return
                }
                //there I CHECK if the FILE SIZE is bigger than 8 MB (numbers below are in bytes)
                if ( this.file.size > 8388608 ){
                    this.errors = "Allowed file size exceeded. (Max. 8 MB)"
                    return;
                }           
                let anchor = document.createElement('a');
                anchor.innerText = 'Remove'
                anchor.href = "#"
                anchor.classList.add("remove-image")
                // //set form data
                let form = new FormData();
                form.append('file',this.file)
                //make ajax call
                axios.post('/admin/upload/image?folder=products',form)
                .then((response) =>{
                    this.uploading =false
                    console.log(response.data)
                    var divs = document.querySelectorAll(".j-loading"), i;
                    for (i = 0; i < divs.length; ++i) {
                       divs[i].style.display = "none";
                    }
                    this.$store.commit('setImages',   response.data.path)
                }).catch((err) => {
                    this.errors = "Upload failed"
                    this.uploading =false
                    parent1.remove()
                })
            },
            removeImage: function(evt){
                evt.target.innerText = "Deleting...."
                let grandParent = evt.target.parentNode.parentNode
                //Get id of uploaded image .
                let stored_image_url  = grandParent.querySelector('input.stored_image_url'),stored_image_id
                //check if 
                if (stored_image_url){
                    stored_image_url  = stored_image_url.value;
                }
                console.log(stored_image_url)
                axios.post('/admin/delete/image?folder=products',{
                   image_url:  stored_image_url
                }).then((response) => {
                    //save other images
                    //grandParent.remove()
                    this.removeItemFromArray(this.images,stored_image_url)
                }).catch((eer) =>{})
            },
            removeItemFromArray(arr,value){
                let index  = arr.indexOf(value)
                if(index > -1){
                    arr.splice(index,1)
                }
                return arr;
            }
           
        }
    }
</script>                  