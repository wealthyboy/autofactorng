<template>
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex mb-2">
                <div class="skeleton-avatar me-3"></div>
                <div class="flex-grow-1">
                <div class="skeleton-line w-25 mb-1"></div>
                <div class="skeleton-line w-50"></div>
                </div>
            </div>
            <div class="skeleton-line w-100 mb-2"></div>
            <div class="skeleton-line w-100 mb-2"></div>
            <div class="skeleton-line w-75"></div>
        </div>
    </div>
</template>

<style scoped>
.skeleton-avatar {
  width: 40px;
  height: 40px;
  background-color: #dee2e6;
  border-radius: 50%;
  animation: pulse 1.5s infinite;
}

.skeleton-line {
  height: 12px;
  background-color: #dee2e6;
  border-radius: 4px;
  animation: pulse 1.5s infinite;
}

@keyframes pulse {
  0% { opacity: 1 }
  50% { opacity: 0.5 }
  100% { opacity: 1 }
}
</style>
  