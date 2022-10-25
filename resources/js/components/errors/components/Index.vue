<template>

<div>

    <navigation />
    <div class="page-header gray">
        <div class="page-header-image"></div>
        <div class="container">
            <div class="row">
                <div class="card  mt-9">
                    <div class="card-body">
                        <div class="col-md-8 mr-auto ml-auto">
                            <p class="title white">Looks like the page you are looking for is not found</p>
                            <h1 class="title white">404</h1>
                            <router-link :to="{name: 'home'}" class="btn btn-primary">Continue</router-link>
                        </div>
                    </div>
                </div>
            </div>    
        </div> 
    </div>
</div>
</template>
<style>

</style>
