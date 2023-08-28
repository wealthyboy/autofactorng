<template>
    <div v-if="notification" class="header-topbar animated fadeInDown topbar--danger">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="topbar-center d-lg-block">
                    <div class="topbar-component bold">
                        {{ notification }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import { mapGetters } from 'vuex'

export default {
    computed:{
        ...mapGetters({
           notification:'notification'
        })
    } 
}
</script>
<style>
     
</style>