<template>
    <div>
    <div class="row">
        <div class="col-sm-12">
            <h3>From</h3>
            <div class="form-group">
                <label for="client_id">From Client</label>
                <select name="client_id" v-model="waybill.client_id" id="client_id" class="form-control manual" required>
                        <option v-for="client in clients" :value="client.DCLink" :key="client.DCLink">{{ `${client.Name} ${client.Account}` }}</option>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="shipper_name">Waybill number</label>
                <input type="text" name="waybill_number" id="waybill_number" class="form-control" required v-model="waybill.waybill_number">
            </div>
            <div class="form-group">
                <label for="shipper_name">Shipper's Name</label>
                <input type="text" name="shipper_name" id="shipper_name" class="form-control" required v-model="waybill.shipper_name">
            </div>
            <div class="form-group">
                <label for="shipper_phone">Phone</label>
                <input type="number" name="shipper_phone" id="shipper_phone" class="form-control" v-model="waybill.shipper_phone" required :value="clientDetails.Telephone">
            </div>
            <div class="form-group">
                <label for="shipper_company">Company</label>
                <input type="text" name="shipper_company" id="shipper_company" class="form-control" v-model="waybill.shipper_company">
            </div>
            <div class="form-group">
                <label for="shipper_country">Country</label>
                <input type="text" name="shipper_country" id="shipper_country" class="form-control" required v-model="waybill.shipper_country">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="shipper_address">Address</label>
                <input type="text" name="shipper_address" id="shipper_address" class="form-control"  v-model="waybill.shipper_address" :value="clientDetails.Physical1">
            </div>
            <div class="form-group">
                <label for="shipper_address_alternate">Alternative Address</label>
                <input type="text" name="shipper_address_alternate" id="shipper_address_alternate" class="form-control" v-model="waybill.shipper_address_alternate" :value="clientDetails.Physical2">
            </div>
            <div class="form-group">
                <label for="shipper_city">City</label>
                <select name="shipper_city" id="shipper_city" class="form-control manual">
                    <option  v-for="location in locations" :value="location.id" :key="location.id">{{ location.name }}</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
           <div class="col-sm-12">
               <h3>To</h3>
           </div>
           <div class="col-sm-6">
               <div class="form-group">
                   <label for="con_name">Recipient's Name</label>
                   <input type="text" name="con_name" id="con_name" class="form-control" required>
               </div>
               <div class="form-group">
                   <label for="con_phone">Phone</label>
                   <input type="number" name="con_phone" v-model="waybill.con_phone" id="con_phone" class="form-control" required>
               </div>
               <div class="form-group">
                   <label for="con_company">Company</label>
                   <input type="text" name="con_company" v-model="waybill.con_company" id="con_company" class="form-control">
               </div>
               <div class="form-group">
                   <label for="con_country">Country</label>
                   <input type="text" name="con_country" v-model="waybill.con_country" id="con_country" class="form-control" required>
               </div>
           </div>
           <div class="col-sm-6">
               <div class="form-group">
                   <label for="con_address">Address</label>
                   <input type="text" name="con_address" v-model="waybill.con_address" id="con_address" class="form-control" required>
               </div>
               <div class="form-group">
                   <label for="con_address_alternate">Alternative Address</label>
                   <input type="text" name="con_address_alternate" v-model="waybill.con_address_alternate" id="con_address_alternate" class="form-control">
               </div>
               <div class="form-group">
                   <label for="con_city">City</label>
                   <select name="con_city" id="con_city" class="form-control manual" v-model="waybill.con_city" required>
                       <option  v-for="location in locations" :value="location.id" :key="location.id">{{ location.name }}</option>
                   </select>
               </div>
           </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h3>Shipment Information</h3>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="total_package">Total Packages</label>
                    <input type="number" v-model="waybill.total_package" name="total_package" id="total_package" class="form-control">
                </div>
                <div class="form-group">
                    <label for="shipment_description">Description</label>
                    <textarea name="shipment_description" v-model="waybill.shipment_description" required id="shipment_description" rows="5" class="form-control"></textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="weight">Total Weight (KGs)</label>
                    <input type="number" name="weight" id="weight" v-model="waybill.weight" class="form-control">
                </div>
                <div class="form-group">
                    <label for="shipment_value">Value</label>
                    <input type="text" name="shipment_value" v-model="waybill.shipment_value" id="shipment_value" class="form-control">
                </div>
                <h5><strong>DIM (L/W/H CM)</strong></h5>
                <div class="row">
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="length" placeholder="Length" required>
                    </div>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="width" placeholder="width" required>
                    </div>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="height" placeholder="height" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h3>Packaging</h3>
                <div class="form-group">
                    <label for="packaging">Packaging</label>
                    <select name="packaging" id="packaging" required v-model="waybill.packaging" class="form-control">
                        <option value="1">CUSTOMER PACKAGING</option>
                        <option value="2">FEDEX PAK</option>
                        <option value="3">FEDEX BOX</option>
                        <option value="4">FEDEX TUBE</option>
                        <option value="6">FEDEX LETTER</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="special_handling"><strong>Special Handling</strong></label>
                <select name="special_handling" v-model="waybill.special_handling" id="special_handling" class="form-control">
                    <option value="None">None</option>
                    <option value="HOLD at PAX Location">HOLD at PAX Location</option>
                    <option value="SATURDAY Delivery">SATURDAY Delivery</option>
                </select>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="internal_billing_reference">Internal Billing Reference</label>
                    <input type="number" v-model="waybill.internal_billing_reference" name="internal_billing_reference" id="internal_billing_reference" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <label for="bill_to"><strong>Bill To</strong></label>
                <select name="bill_to" id="bill_to" v-model="waybill.bill_to" class="form-control" required>
                    <option value="C">Consignee</option>
                    <option value="O">Other</option>
                    <option value="S">Shipper</option>
                </select>
            </div>
            <div class="col-sm-6">
                <label for="bill_duty"><strong>Bill Duty</strong></label>
                <select name="bill_duty" id="bill_duty" v-model="waybill.bill_duty" class="form-control">
                    <option value="O">Other</option>
                    <option value="S">Shipper</option>
                    <option value="C">Consignee</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Save">
                    <a href="/domestic" class="btn btn-danger">Back</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            locations: [],
            clients: [],
            waybill: {
                client_id: null,
            },
        }
    },
    props: {
        id: Number
    },
    computed: {
        clientDetails() {
            let clients = this.clients.filter(client => {
                
                if(client.DCLink == this.waybill.client_id) {
                    
                    return client;
                }
            });
            if(!clients.length) return {};

            return clients[0];
        }
    },
    created() {
        this.getData();
        if(this.id) {
            this.getEditDetails();
        }
    },
    methods: {
        getData() {
            this.$root.isLoading = true;
            axios.get('/domestic/create?req=ajax').then(response => {
                this.locations = response.data.locations;
                this.clients = response.data.clients;
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
            }).catch(response  => {
                this.$root.isLoading = false;
            });
        },
        getEditDetails() {
            this.$root.isLoading = true;
            axios.get(`/domestic/${this.id}/edit?ajax=1`).then(response => {
                this.waybill  = response.data.waybill;
                this.$root.isLoading = false;
            }).catch(() => this.$root.isLoading = false);
        }
    }
}
</script>
