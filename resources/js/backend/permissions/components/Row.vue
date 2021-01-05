<template>
  <tr>
    <td class="text-center">{{ permission.title }}</td>
    <td class="text-center">
      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="checkbox"
          :id="permission.id"
          v-model="permission.re"
        />
        <label class="form-check-label" :for="permission.id">Okuma</label>
      </div>
    </td>
    <td class="text-center">
      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="checkbox"
          :id="permission.id"
          v-model="permission.wr"
        />
        <label class="form-check-label" :for="permission.id">Yazma</label>
      </div>
    </td>
    <td class="text-center">
      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="checkbox"
          :id="permission.id"
          v-model="permission.up"
        />
        <label class="form-check-label" :for="permission.id">Düzenleme</label>
      </div>
    </td>
    <td class="text-center">
      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="checkbox"
          :id="permission.id"
          v-model="permission.de"
        />
        <label class="form-check-label" :for="permission.id">Silme</label>
      </div>
    </td>
  </tr>
</template>
<script>
export default {
  props: ["permission"],
  data(){
    return{
      keeper:{
      }
    }
  },
  computed:{
    
  },

};
</script>