<template>
<div>
    <div v-if="message"  data-notify="container" class="col-xs-11 col-sm-6 alert alert-info alert-with-icon animated fadeInDown" role="alert" data-notify-position="top-center" style="display: inline-block; margin: 15px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; left: 0px; right: 0px;">
        <button @click="removeMessage" type="button" class="close" data-dismiss="alert" aria-label="Close" aria-hidden="true"  data-notify="dismiss" style="position: absolute; right: 10px; top: 50%; margin-top: -9px; z-index: 1033;"> <i class="now-ui-icons ui-1_simple-remove"></i></button>
        <i class="now-ui-icons ui-1_bell-53"></i>
        <span data-notify="title"></span> 
        <span ><strong>{{ message }}</strong></span>
    </div>
</div>
</template>
<script>
    import { mapGetters } from 'vuex'
    import localforage from 'localforage'
    export default {
        props:{
           top:Number
        },
        computed:{
            ...mapGetters({
               message:'messages/message',
            })
        },
        methods:{
            removeMessage(){
               localforage.removeItem('notification')
            }
        }
    }
    
</script>
