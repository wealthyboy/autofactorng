<template>
        <div class="subscriber-images-grid">
            <div class="card">
                <div class="card-image">
                    <router-link  class="img-link" :to="{ name: 'show', params: { id: subscriber.id }  }">
                        <img class="img rounded" :src="subscriber.image">
                    </router-link>
                </div>
                <div class="card-body">
                    <h5  class="card-title text-center">
                        <router-link :to="{ name: 'show', params: { id: subscriber.id }  }">
                        {{ subscriber.name }}
                        </router-link>
                        <br/>
                        <small v-if="subscriber.is_online" class="text-success"> Online</small>
                        <small v-if="!subscriber.is_online"  class="text-danger">Offline</small>
                    </h5>
                </div>
            </div>
        </div>
</template>
<script>

    import localforage from 'localforage'

    export default {
        props:{
            subscriber: Object
        },
        methods:{
            setSubscriber(subscriber){
               localforage.setItem('subscriber',subscriber)
            }
        }

    }
</script>
