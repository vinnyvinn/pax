<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Additional charge
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <select name="waybill_id" id="waybill_id" class="form-control manual" v-model="additionalCharge.waybill_id">
                        <option value="" selected disabled>select airwaybill</option>
                        <option v-for="waybill in waybills" :value="waybill.id">{{ waybill.waybill_number }}</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <select name="client_id" id="client_id" class="form-control manual" v-model="additionalCharge.client_id">
                        <option value="" selected disabled>select Client</option>
                        <option v-for="client in clients" :value="client.DCLink">{{ `${client.Name} - ${client.Account}` }}</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Charge</th>
                                    <th>Amount($)</th>
                                    <th>Action</th>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td class="form-group">
                                        <select name="" id="" class="form-control input-sm" v-model="charge.charge">
                                            <option v-for="charge in charges" :value="charge">{{ `${charge.code} - ${charge.description}`}}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" v-model="charge.value" name="value" id="value" class="form-control input-sm">
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info" @click.prevent="addCharge"><i class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                                <tr v-for="(additionalCharge, index) in additionalCharge.invoice_data" :key="index">
                                    <td>{{ `${additionalCharge.charge.code} - ${additionalCharge.charge.description}` }}</td>
                                    <td>{{ parseFloat(additionalCharge.value).toFixed(2) }}</td>
                                    <td>
                                        <button type="button" @click.prevent="editCharge(index)" class="btn btn-xs btn-info"><i class="fa fa-edit"></i></button>
                                        <button type="button" @click.prevent="deleteCharge(index)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right">Total:</td>
                                    <td>{{ totalAdditionalCharges.toFixed(2) }}</td>
                                </tr>
                            </tbody>
                            <tfoot v-if="this.id">
                                <tr>
                                    <td colspan="3">
                                        <div class="checkbox">
                                          <label>
                                            <input type="checkbox" v-model="additionalCharge.status" :value="true">
                                                Check to finalize the invoice
                                          </label>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                       <a href="/additional-charges-outbound" class="btn btn-danger">Back</a>
                        <button class="btn btn-primary" @click.prevent="saveAdditionalCharge">Save</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    data() {
        return {
            charges: [],
            additionalCharge: {
                invoice_data:[],
                waybill_id: null,
                client_id: null,
            },
            clients: [],
            waybills: [],
            charge: {},
        };
    },
    props: {
        id: Number
    },
    computed: {
        totalAdditionalCharges() {

            return this.additionalCharge.invoice_data.length ? 
                    this.additionalCharge.invoice_data.map(data => parseFloat(data.value)).reduce((sum, value) => sum+value)
                     : 0;
        }
    },
    created() {
        this.getCharges();
        if(this.id) {
            this.getEditDetails();

            return;
        }
        this.getDetails();
    },
    methods: {
        getCharges() {
            this.$root.isLoading = true;
            axios.get('/other-charges?ajax=1').then(response => {
                this.charges = response.data;
                this.$root.isLoading = false;
            }).catch(() => this.$root.isLoading = false);
        },
        getDetails() {
            this.$root.isLoading = true;
            axios.get('/additional-charges-outbound/create?ajax=1').then(response => {
                this.clients = response.data.clients;
                this.waybills = response.data.waybills;
                setTimeout(() => {
                    $('select.manual').selectpicker({
                      size: 'auto',
                      liveSearch: true,
                      liveSearchPlaceholder: 'Search...',
                  });
                  $('input').on('focus', function () {
                      this.select();
                  });
                }, 200);
                this.$root.isLoading = false;
            }).catch(() => this.$root.isLoading = false);
        },
        getEditDetails() {
            axios.get(`/additional-charges-outbound/${this.id}/edit?ajax=1`).then(response => {
                this.clients = response.data.clients;
                this.waybills = response.data.waybills;
                this.additionalCharge = response.data.invoice;
                this.additionalCharge.status = parseInt(this.additionalCharge.status);
                setTimeout(() => {
                    $('select.manual').selectpicker({
                      size: 'auto',
                      liveSearch: true,
                      liveSearchPlaceholder: 'Search...',
                  });
                  $('input').on('focus', function () {
                      this.select();
                  });
                }, 200);
                this.$root.isLoading = false;
            }).catch(() => this.$root.isLoading = false);
        },
        addCharge() {
            let charge = this.charge;
            this.charge = {};

            this.additionalCharge.invoice_data.unshift(charge);

            return;
        },
        editCharge(index) {
            this.charge = this.additionalCharge.invoice_data[index];
            this.additionalCharge.invoice_data.splice(index, 1);

            return;
        },
        deleteCharge(index) {
            this.additionalCharge.invoice_data.splice(index, 1);

            return;
        },
        saveAdditionalCharge() {
            if(!this.additionalCharge.invoice_data.length || !this.additionalCharge.client_id || !this.additionalCharge.waybill_id) {
                window.toastr.error('All fields are required.');

                return;
            }

            this.$root.isLoading = true;
            const url = this.id ? `/additional-charges-outbound/${this.id}` : `/additional-charges-outbound`;
            if(this.id) {

                axios.put(url, this.additionalCharge).then(response => {
                window.toastr.info(response.data.message);
                this.$root.isLoading = false;
                setTimeout(()=> {
                    window.location.replace('/additional-charges-outbound');
                }, 300);
            }).catch(() => this.$root.isLoading = false);

            } else {

                axios.post(url, this.additionalCharge).then(response => {
                    window.toastr.info(response.data.message);
                    this.$root.isLoading = false;
                    this.additionalCharge = {
                        invoice_data:[],
                        waybill_id: null,
                        client_id: null,
                    };
                
                }).catch(() => this.$root.isLoading = false);

            }
            
        }
    }
}
</script>

