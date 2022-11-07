<template>

  <div class="form-floating mb-2">

    <select
      class="form-select"
      :class="{'is-invalid': error.$error}"
      v-bind="$attrs"
      id="floatingSelect"
      aria-label=""
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    >
      <option :value="modelValue">Choose one</option>

      <slot />
    </select>
    <label for="floatingSelect">{{ $attrs.name }}</label>
  </div>
  <simple-message
    class="link-danger fs-6"
    v-if="error.$error"
    :message="error.$errors[0].$message"
  />
  <simple-message
    class="link-danger fs-6"
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