<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Clearing Agent - Update
                    </div>
                    <div class="panel-body">

                        <form class="form-inline">
                            <div class="form-group">
                                <label for="flight_date">Flight Date</label>
                                <select @change="updateManifests" v-model="flight_date" name="flight_date" id="flight_date" class="form-control">
                                    <option v-for="(date, index) in dates" :key="index" :value="date.flight_date">{{ date.formatted_date }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="manifest_id">Flight</label>
                                <select @change="updateWaybills" v-model="manifest_id" name="manifest_id" id="manifest_id" class="form-control">
                                    <option v-for="(manifest, index) in manifests" :key="index" :value="manifest.id">{{ manifest.flight_number }}</option>
                                </select>
                            </div>
                        </form>

                        <hr>

                        <form action="/clearing-agents" method="post" role="form">
                            <input type="hidden" name="_token" :value="$root.csrf">

                            <div class="table-responsive">
                                <table class="table nowrap plain-table">
                                    <thead>
                                    <tr>
                                        <th>PAX Clearance?</th>
                                        <th>Waybill #</th>
                                        <th>CRN #</th>
                                        <th>Status</th>
                                        <th>Shipped Date</th>
                                        <th class="text-right">Weight</th>
                                        <th class="text-right">Value</th>


                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Export City</th>
                                        <th>Con. Name</th>
                                        <th>Con. Company</th>


                                        <th>Con. Phone</th>
                                        <th>Con. Country</th>
                                        <th>Con. State</th>
                                        <th>Con. City</th>
                                        <th>Con. Address</th>


                                        <th>Con. Address 2</th>
                                        <th>Con. Postal</th>
                                        <th>Shipper Name</th>
                                        <th>Shipper Company</th>
                                        <th>Shipper Phone</th>


                                        <th>Shipper Country</th>
                                        <th>Shipper State</th>
                                        <th>Shipper City</th>
                                        <th>Shipper Address</th>
                                        <th>Shipper Address 2</th>


                                        <th>Shipper Postal</th>
                                        <th>Bill To</th>
                                        <th>Bill Duty</th>
                                        <th>Total</th>
                                        <th>Description</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(waybill, index) in waybills" :key="index">
                                        <td>
                                            <div class="checkbox icheck-primary">
                                                <input checked type="checkbox" :name="getCheckName(waybill)" :id="'check_' + waybill.id" />
                                                <input type="hidden" name="waybills[]" :value="waybill.id">
                                                <label :for="'check_' + waybill.id">Yes</label>
                                            </div>
                                        </td>
                                        <td><strong>{{ waybill.waybill_number }}</strong></td>
                                        <td><strong>{{ waybill.crn_number }}</strong></td>
                                        <td><strong>{{ waybill.status }}</strong></td>
                                        <td><strong>{{ dateFormat(waybill.shipped_date) }}</strong></td>
                                        <td class="text-right"><strong>{{ waybill.weight }}</strong></td>
                                        <td class="text-right"><strong>{{ waybill.currency }} {{ waybill.value }}</strong></td>


                                        <td>{{ waybill.origin }}</td>
                                        <td>{{ waybill.destination }}</td>
                                        <td>{{ waybill.export_city }}</td>
                                        <td>{{ waybill.con_name }}</td>
                                        <td>{{ waybill.con_company }}</td>


                                        <td>{{ waybill.con_phone }}</td>
                                        <td>{{ waybill.con_country }}</td>
                                        <td>{{ waybill.con_state }}</td>
                                        <td>{{ waybill.con_city }}</td>
                                        <td>{{ waybill.con_address }}</td>


                                        <td>{{ waybill.con_address_alternate }}</td>
                                        <td>{{ waybill.con_postal }}</td>
                                        <td>{{ waybill.shipper_name }}</td>
                                        <td>{{ waybill.shipper_company }}</td>
                                        <td>{{ waybill.shipper_phone }}</td>


                                        <td>{{ waybill.shipper_country }}</td>
                                        <td>{{ waybill.shipper_state }}</td>
                                        <td>{{ waybill.shipper_city }}</td>
                                        <td>{{ waybill.shipper_address }}</td>
                                        <td>{{ waybill.shipper_address_alternate }}</td>


                                        <td>{{ waybill.shipper_postal }}</td>
                                        <td>{{ waybill.bill_to }}</td>
                                        <td>{{ waybill.bill_duty }}</td>
                                        <td>{{ waybill.total }}</td>
                                        <td>{{ waybill.description }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <br>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success" :disabled="waybills.length < 1">Update Clearing Agent</button>
                            </div>
                        </form>

                        
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
                dates: [],
                manifests: [],
                waybills: [],
                flight_date: null,
                manifest_id: null,
            };
        },

        created() {
            this.getDates();
        },

        methods: {

            getCheckName(waybill) {
                return "checked[check_" + waybill.id +"]";
            },

            dateFormat(date) {
                return window._date2(date);
            },

            getDates() {
                this.$root.isLoading = true;
                axios.get('/manifest?dates=true').then(response => {
                    this.dates = response.data.dates;
                    this.$root.isLoading = false;
                }).catch(() => this.$root.isLoading = false);
            },

            updateManifests() {
                this.$root.isLoading = true;
                axios.get('/manifest?manifests=true&flight_date=' + this.flight_date).then(response => {
                    this.manifests = response.data.manifests;
                    this.$root.isLoading = false;
                }).catch(() => this.$root.isLoading = false);
            },

            updateWaybills() {
                this.$root.isLoading = true;
                axios.get('/manifest?released=true&manifest_id=' + this.manifest_id).then(response => {
                    this.waybills = response.data.waybills;
                    this.$root.isLoading = false;
                }).catch(() => this.$root.isLoading = false);
            },

            refreshPage() {
              setTimeout(() => {
                  window.location.reload();
              }, 100);
            },
        }
    }
</script>