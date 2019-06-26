<template>
<div>
    <div class="row">
        <div class="form-group col-md-6">
            <label class="control-label">Contact name</label>
            <input type="text" name="contact_name" v-model="customer.contact_name" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label class="control-label">Contact Phone</label>
                <input type="number" name="contact_phone" v-model="customer.contact_phone" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label class="control-label">Company name</label>
                <input type="text" name="company_name" v-model="customer.company_name" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label class="control-label">Bill Account</label>
            <input type="text" name="bill_account" v-model="customer.bill_account" class="form-control">

        </div>
        <div class="form-group col-md-4">
            <label class="control-label">Bill Company</label>
             <select class="form-control" v-model="customer.bill_company" name="bill_company">
                <option selected :value="2">FEDEX</option>
                <option :value="1">PAX</option>
              </select>
        </div>
        <div class="form-group col-md-6">
            <label class="control-label">Address</label>
            <textarea v-model="customer.address" placeholder="address" class="form-control"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-sm btn-primary pull-right" @click.prevent="saveCustomer">
            <i :class="!loading ? 'fa fa-save' : 'fa fa-cog fa-spin'"></i> Save Customer
            </button>
        </div>
    </div>
</div>
</template>
<script>
    export default {
    data() {
      return {
        customer: {
          bill_company: 2,
        },
        loading: false
      }
    },
    methods: {
        saveCustomer() {
            if(this.validator()) return
            this.loading = true
            axios.post('/dispatch/customers', this.customer)
              .then(response => {
                toastr.info(response.data.message)
                this.loading = false
                this.customer = {
                    bill_company: 2
                }
              }).catch(response => {
                  this.loading = false
              })
        }, 
        validator() {
            let error = false
            if(!this.customer.contact_name) {
              error = true
              toastr.error('customer name is required')
            }
            if(!this.customer.contact_phone) {
              error = true
              toastr.error('Contact phone is required')
            }
            if(!this.customer.company_name) {
              error = true
              toastr.error('Company name is required')
            }
            if(!this.customer.bill_account) {
              error = true
              toastr.error('Bill account is required')
            }
            if(!this.customer.bill_company) {
              error = true
              toastr.error('Bill company is required')
            }
            return error;
        }
    }
  }
</script>