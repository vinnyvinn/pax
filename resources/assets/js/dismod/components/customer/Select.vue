<template>
    <div class="row" style="margin-top:30px;">
        <div class="col-md-8 form-group">
            <input type="hidden" name="customer_id" :value="customerId"/>
            <v-select name="customer_id" v-model="customer" :options="customers"></v-select>
        </div>
        <div class="col-md-4">
            <button class="btn btn-sm btn-info" @click.prevent="getCustomers" style="margin-top:30px !important;">
               <i :class="loading ? 'fa fa-cog fa-spin': 'fa fa-exchange'"></i> Refresh 
             </button>
        </div>
    </div>
</template>
<script>
import vSelect from 'vue-select'
export default {
  data () {
    return {
       customers: [],
       customer: {},
       loading: false
    }  
  },
  computed: {
      customerId () {
          return this.customer.id;
      }
  },
  components: { 'v-select': vSelect },
  created () {
      this.getCustomers()
  },
  methods: {
    getCustomers () {
      this.loading = true
      axios.get('/dispatch/customers/?view=allcustomers').then(response => {
          this.loading = false;
        response.data.data.forEach(customer => {
            customer.label = `${customer.contact_name} ${customer.contact_phone}`
        })
        this.customers = response.data.data;
      }).catch(r => {
            this.loading = false;
        })
    }
  }
}
</script>