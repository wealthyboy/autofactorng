<template>

  <select
    class="form-control"
    :class="{'is-invalid': error.$error}"
    v-bind="$attrs"
    id="floatingSelect"
    aria-label=""
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  >

    <slot />
  </select>
  <label for="floatingSelect">{{ $attrs.name }}</label>
  <simple-message
    class="link-danger fs-5"
    v-if="error.$error"
    :message="error.$errors[0].$message"
  />
  <simple-message
    class="link-danger fs-5"
    v-if="Array.isArray(server_errors)"
    :message="server_errors[0]"
  />

</template>
  
  
  <script>
import SimpleMessage from "../message/SimpleMessage";

export default {
  props: ["error", "modelValue", "server_errors", "options"],
  emits: ["update:modelValue"],
  components: {
    SimpleMessage,
  },
};
</script>