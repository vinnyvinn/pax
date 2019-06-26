<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ isEdit ? 'Update' : 'New' }} Freight Invoice</div>

                    <div class="panel-body">
                        <form :action="'/waybill/freight' + (isEdit ? '/' + id : '')" method="post" role="form">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#waybill_details" aria-controls="waybill_details" role="tab" data-toggle="tab">Waybill details</a></li>
                            <li role="presentation"><a href="#consignee" aria-controls="consignee" role="tab" data-toggle="tab">Consignee</a></li>
                            <li role="presentation"><a href="#shipper" aria-controls="shipper" role="tab" data-toggle="tab">Shipper</a></li>
                            <li role="presentation"><a href="#billing" aria-controls="billing" role="tab" data-toggle="tab">Billing</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="waybill_details">
                                <input type="hidden" name="_token" :value="$root.csrf">
                                <input v-if="isEdit" type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="waybill_id" :value="isEdit ?  response.waybill.id : freight.waybill_id" />
                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label for="waybill_id">Waybill</label>
                                        <h4 v-if="isEdit">{{ response.waybill.waybill_number }} (Duty {{ response.waybill.bill_duty }}, Bill To {{ response.waybill.bill_to }})</h4>
                                        <select v-else required v-model="freight.waybill_id" class="form-control manual" name="waybill_id" id="waybill_id">
                                            <option :value="null" disabled>Select Waybill</option>
                                            <option v-for="waybill in waybills" :value="waybill.id">
                                                {{ waybill.waybill_number }} (Duty {{ waybill.bill_duty }}, Bill To {{ waybill.bill_to }})
                                            </option>
                                        </select>
                                    </div><hr>
                                </div>
                                <div class="row" v-if="waybill.waybill_number">
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Waybill Number</strong></label>
                                        <p>{{ waybill.waybill_number }}</p>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>CRN Number</strong></label>
                                        <p>{{ waybill.crn_number }}&nbsp;</p>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Shipped Date</strong></label>
                                        <input class="form-control" type="date" name="waybill[shipped_date]" v-model="waybill.shipped_date"/>
                                    </div>
                                    <div class="form-group col-sm-4"><label for=""><strong>Weight</strong></label>
                                    <input class="form-control" type="text" name="waybill[weight]" v-model="waybill.weight"/></div>
                                    <div class="form-group col-sm-4"><label for=""><strong>Package</strong></label>
                                        <select name="waybill[package_type]" v-model="waybill.package_type" id="" class="form-control">
                                            <option v-for="package in packages" :value="package.code">{{ package.name }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Origin</strong></label>
                                        <input class="form-control" type="text" name="waybill[origin]" v-model="waybill.origin"/>
                                    </div>
                                    <div class="form-group col-sm-4"><label for="">
                                        <h5><strong>Destination</strong></h5></label>
                                        <input class="form-control" type="text" name="waybill[destination]" v-model="waybill.destination"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Export City</strong></label>
                                        <input class="form-control" type="text" name="waybill[export_city]" v-model="waybill.export_city"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Value</strong></label>
                                     <div class="input-group">
                                       <input type="text" v-model="waybill.currency" name="waybill[currency]" class="form-control" placeholder="currency">
                                       <span class="input-group-btn">
                                           <input type="text" v-model="waybill.value" name="waybill[value]" style="width:100px !important;" class="form-control text-right" placeholder="value">
                                       </span>
                                     </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Bill To</strong></label>
                                        <select class="form-control"  name="waybill[bill_to]" v-model="waybill.bill_to">
                                            <option value="S">Sender</option>
                                            <option value="R">Recipient</option>
                                            <option value="O">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Bill Duty</strong></label>
                                        <select class="form-control" name="waybill[bill_duty]" v-model="waybill.bill_duty">
                                            <option value="S">Sender</option>
                                            <option value="R">Recipient</option>
                                            <option value="O">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Total</strong></label>
                                        <input class="form-control" type="text" name="waybill[total]" v-model="waybill.total"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="description"><strong>Description</strong></label>
                                        <input class="form-control" type="text" name="waybill[description]" v-model="waybill.description"/>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4>DIMS</h4>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Length</th>
                                                    <th>Width</th>
                                                    <th>Height</th>
                                                    <th></th>
                                                    <th>Action</th>
                                                </tr>
                                                <tr>
                                                    <td><input style="width:90px;" type="number" v-model="dim.length" min="0" class="form-control input-sm text-right"></td>
                                                    <td><input style="width:90px;" type="number" v-model="dim.width" min="0" class="form-control input-sm text-right"></td>
                                                    <td><input style="width:90px;" type="number" v-model="dim.height" min="0" class="form-control input-sm text-right"></td>
                                                    <td colspan="2"><button type="button" class="btn btn-sm btn-primary" @click.prevent="addDim()"><i class="fa fa-plus"></i></button></td>
                                                </tr>
                                                <tr v-for="(d, index) in waybill.dims" :key="index">
                                                    <td>{{ d.length }}</td>
                                                    <td>{{ d.width }}</td>
                                                    <td>{{ d.height }}</td>
                                                    <td>{{ d.weight }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-info" @click.prevent="editDim(index)"><i class="fa fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-danger" @click.prevent="deleteDim(index)"><i class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><hr>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="consignee">
                                <div class="row" v-if="waybill.waybill_number">
                                    <div class="col-md-12"><h4 class="text-left">Consignee</h4></div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Name</strong></label>
                                        <input class="form-control" name="waybill[con_name]" type="text" v-model="waybill.con_name"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Company</strong></label>
                                        <input class="form-control"  name="waybill[con_company]" type="text" v-model="waybill.con_company"/>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Phone</strong></label>
                                        <input class="form-control" name="waybill[con_phone]" type="text" v-model="waybill.con_phone"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                    <label for=""><strong>Address</strong></label>
                                    <input class="form-control" name="waybill[con_address]" type="text" v-model="waybill.con_address"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Alternate Address</strong></label>
                                        <input class="form-control" name="waybill[con_address_alternate]" type="text" v-model="waybill.con_address_alternate"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>City</strong></label>
                                        <input class="form-control" name="waybill[con_city]" type="text" v-model="waybill.con_city"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>State</strong></label>
                                        <input class="form-control" name="waybill[con_state]" type="text" v-model="waybill.con_state"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Country</strong></label>
                                        <select required v-model="waybill.con_country" class="form-control countries" name="waybill[con_country]" id="con_country">
                                            <option :value="null" disabled>Select country</option>
                                            <option v-for="country in countries" :value="country.id">
                                                {{ country.name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Postal</strong></label>
                                        <input class="form-control" name="waybill[con_postal]" type="text" v-model="waybill.con_postal"/>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="shipper">
                                <div class="row" v-if="waybill.waybill_number">
                                    <div class="col-md-12"><h4 class="text-left">Shipper</h4></div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Name</strong></label>
                                        <input class="form-control" type="text" name="waybill[shipper_name]" v-model="waybill.shipper_name"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Company</strong></label>
                                        <input class="form-control" type="text" name="waybill[shipper_company]" v-model="waybill.shipper_company"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Phone</strong></label>
                                        <input class="form-control" type="text" name="waybill[shipper_phone]" v-model="waybill.shipper_phone"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Address</strong></label>
                                        <input class="form-control" type="text" name="waybill[shipper_address]" v-model="waybill.shipper_address"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>Alternate Address</strong></label>
                                        <input class="form-control" type="text" name="waybill[shipper_address_alternate]" v-model="waybill.shipper_address_alternate"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>City</strong></label>
                                        <input class="form-control" type="text" name="waybill[shipper_city]" v-model="waybill.shipper_city"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for=""><strong>State</strong></label>
                                        <input class="form-control" type="text" name="waybill[shipper_state]" v-model="waybill.shipper_state"/>
                                    </div>
                                    <div class="form-group col-sm-4">
                                      <label for=""><strong>Country</strong></label>
                                      <select required v-model="waybill.shipper_country" class="form-control countries" name="waybill[shipper_country]" id="con_country">
                                          <option :value="null" disabled>Select country</option>
                                          <option v-for="country in countries" :value="country.id">
                                              {{ country.name }}
                                          </option>
                                      </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                      <label for=""><strong>Postal</strong></label>
                                      <input class="form-control" type="text" name="waybill[shipper_postal]" v-model="waybill.shipper_postal"/>
                                    </div>
                                </div><hr> 
                            </div>
                            <div role="tabpanel" class="tab-pane" id="billing">
                                <div class="row">
                                    <div class="col-sm-12"><h4 class="text-left">Billing (Exchange Rate- {{ this.settings['Exchange Rate'] ? this.settings['Exchange Rate'].current_value : '' }}) </h4></div>
                                    <div class="col-sm-6">
                                      <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><label for="client_id">Client</label></td>
                                                    <td>
                                                        <h6 v-if="isEdit">{{ response.client.Account }} - {{ response.client.Name }}</h6>
                                                        <select v-else required v-model="freight.client_id" class="form-control manual" name="client_id" id="client_id">
                                                            <option :value="null" disabled>Select Client</option>
                                                            <option v-if="client.DCLink" v-for="client in clients" :key="client.id" :value="client.DCLink">{{ client.Name }}({{ client.Account }})</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="courier_id">Courier</label></td>
                                                    <td>
                                                        <select v-model="waybill.courier_id" name="waybill[courier_id]" id="courier_id" class="form-control manual">
                                                            <option value="" selected disabled>Select courier</option>
                                                            <option v-for="courier in couriers" :value="courier.id" :key="courier.id">{{ courier.name }}</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr v-if="waybill.bill_to == 'R'">
                                                    <td><label for="fedex_client_account">FEDEX Client A/c</label></td>
                                                    <td><input type="text" v-model="waybill.fedex_client_account" name="waybill[fedex_client_account]" id="fedex_client_account" class="form-control"></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="FEDEX ID">Client FedexId</label></td>
                                                    <td>{{ isEdit ? response.client.FedexId : clientDetails.FedexId }}</td>
                                                </tr>
                                                <tr>
                                                    <td><label for="declared_value">Declared Value</label></td>
                                                    <td>
                                                        <input v-model="freight.declared_value" type="text" required class="form-control" name="declared_value" id="declared_value">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="transport">Transport</label></td>
                                                    <td>
                                                        <input v-model="freight.transport" type="text" required class="form-control" name="transport" id="transport">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="discount">Discount</label></td>
                                                    <td>
                                                        <input readonly v-model="freight.discount" type="text" required class="form-control" name="discount" id="discount">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><label for="insurance_rate">Insurance Rate</label></td>
                                                    <td><input readonly v-model="freight.insurance_rate" type="text" required class="form-control" name="insurance_rate" id="insurance_rate"></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="fuel_levy">Fuel Levy Rate</label></td>
                                                    <td><input readonly v-model="freight.fuel_levy" type="text" required class="form-control" name="fuel_levy" id="fuel_levy"></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="vat_rate">VAT Rate</label></td>
                                                    <td>
                                                        <input readonly v-model="freight.vat_rate" type="text" required class="form-control" name="vat_rate" id="vat_rate">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <label for="o_charge">Other Charges</label>
                                                        <div class="input-group">
                                                            <select name="o_charge" id="o_charge" class="form-control" v-model="otherCharge.key">
                                                                <option v-for="charge in oCharges" :value="charge.id">{{ `${charge.code} - ${charge.description}` }}</option>
                                                            </select>
                                                           <span class="input-group-btn">
                                                               <input type="number" v-model="otherCharge.value" style="width:200px !important;" class="form-control text-right" placeholder="Value">
                                                           </span>
                                                           <span class="input-group-btn">
                                                                <button class="btn btn-md btn-primary" @click.prevent="addOtherCharges">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                           </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                    <td><h5 class="pull-left">Discount</h5></td>
                                                    <td><h5 class="pull-right text-right"><strong>{{ totalDiscount.toLocaleString('en-GB') }}</strong></h5></td>
                                                </tr>
                                                <tr>
                                                    <td><h5 class="pull-left">Fuel Levy</h5></td>
                                                    <td><h5 class="pull-right text-right"><strong>{{ fuelLevy.toLocaleString('en-GB') }}</strong></h5></td>
                                                </tr>
                                                <tr>
                                                    <td><h5 class="pull-left">Insurance</h5></td>
                                                    <td><h5 class="pull-right text-right"><strong>{{ insurance.toLocaleString('en-GB') }}</strong></h5></td>
                                                </tr>
                                                <tr>
                                                    <td><h5 class="pull-left">VAT</h5></td>
                                                    <td><h5 class="pull-right text-right"><strong>{{ vat.toLocaleString('en-GB') }}</strong></h5></td>
                                                </tr>
                                                <template v-if="freight.outbound_other_charges.length" v-for="(other_charge, index) of this.freight.outbound_other_charges">
                                                <tr>
                                                    <td><h5 class="text-left">{{ getChargeName(other_charge.key) }}</h5></td>
                                                    <td>
                                                        <h5 class="text-right">
                                                            <strong>
                                                                {{ parseFloat(other_charge.value).toLocaleString('en-GB') }}
                                                            </strong>
                                                            <span style="margin-left:8px;">
                                                                <a href="#" @click.prevent="editOtherCharges(index)"><i style="font-size:15px;" class="fa fa-edit"></i></a>
                                                                <a href="#" @click.prevent="deleteOtherCharges(index)"><i style="font-size:15px;" class="fa fa-trash"></i></a> 
                                                            </span>
                                                        </h5>
                                                    </td>
                                                </tr>
                                                </template>
                                                <tr>
                                                    <td><h4 class="pull-left">Invoice Total</h4></td>
                                                    <td class="text-right"><strong>{{ invoiceTotal.toLocaleString('en-GB') }}</strong></td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>

                                    <input type="hidden" name="finalize" v-model="finalize">
                                    <input type="hidden" name="route" :value="route">
                                    <input type="hidden" name="outbound_other_charges" :value="JSON.stringify(freight.outbound_other_charges)">
                                    <input type="hidden" name="waybill[dims]" :value="JSON.stringify(waybill.dims)">
                                <div class="col-sm-12">
                                    <div class="form-group pull-right">
                                        <button v-if="canProcessInvoice" class="btn btn-primary" type="submit">Process</button>
                                        <button v-else disabled="disabled" class="btn btn-primary">Invalid Account</button>
                                        <button v-if="isEdit && canf" class="btn btn-success" type="submit" @click="finalize = true">Finalize Invoice</button>
                                        <a href="/waybill/freight" class="btn btn-danger">Back</a>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import vSelect from 'vue-select';

    export default {
        props: {
            id: {
                type: Number,
                default: null
            },
            canf: {
                type: Boolean,
                default: false
            },
            route: {
                type: String,
                default: null
            },
        },
        data() {
            return {
                finalize: false,
                isEdit: false,
                zones: [],
                rates: [],
                response: {
                    client: { Account: '', Name: '' },
                    waybill: { waybill_number: '', bill_duty: '', bill_to: '' }
                },
                waybills: [],
                clients: [],
                settings: {
                    'Current VAT Rate': {
                        current_value: 16
                    },
                    'Current Insurance Rate': {
                        current_value: 1.5
                    },
                    'Current Currency': {
                        current_value: ''
                    },
                    'Current Levy Rate': {
                        current_value: 7.5
                    }
                },
                countries: [],
                freight: {
                    waybill_id: null,
                    client_id: null,
                    declared_value: 0,
                    transport: 0,
                    fuel_levy: 0,
                    discount: 0,
                    vat_rate: 16,
                    insurance_rate: 0,
                    outbound_other_charges: []
                },
                otherCharge: {},
                oCharges: [],
                packages: [
                    { code: 1 , name: 'CUSTOMER PAK', billing_code: 11 },
                    { code: 2 , name: 'FEDEX PAK', billing_code: 12 },
                    { code: 3 , name: 'FEDEX BOX', billing_code: 11 },
                    { code: 4 , name: 'FEDEX TUBE', billing_code: 11 },
                    { code: 6 , name: 'FEDEX LETTER', billing_code: 16 },
                    { code: 15 , name: 'FEDEX 10K', billing_code: 11 },
                    { code: 18 , name: 'FEDEX 40K BOX', billing_code: 18 },
                    { code: 19 , name: 'FEDEX 60K BOX', billing_code: 19 },
                    { code: 25 , name: 'FEDEX 25K', billing_code: 25 },
                    { code: 51 , name: 'Documents', billing_code: 1 },
                    { code: 52 , name: 'Non Documents', billing_code: 2 },
                    { code: 'DP' , name: 'DIPLO Bag', billing_code: 11 },
                    { code: 'IMP01' , name: 'Docs', billing_code: 1 },
                    { code: 'IMP02' , name: 'Non Docs', billing_code: 2 },
                    { code: 'PAX' , name: 'PAX PACKAGE', billing_code: 'PAX' },
                    { code: 'PAX-HIGH' , name: 'High Value Shipment', billing_code: 'PAX-HIGH' },
                    { code: 'PAX-LOW' , name: 'Low Value Shipment', billing_code: 'PAX-LOW' },
                ],
                gdrRates: {},
                salesRateCard: {},
                discountRates: [],
                fedexAccount: null,
                dim: {},
                couriers: []
            }
        },

        created() {
            this.getOtherCharges();
            this.getGDRRates();
            this.getSalesRateCard();
            this.getDiscountRates();
            if (this.id) {
                this.isEdit = true;
                
                const getEditDetails = new Promise((resolve, reject) => {
                    resolve(this.getEditDetails());
                });
                getEditDetails.then(() => {
                    this.getCountries();
                });

                return;
            }
            let getDetails = new Promise((resolve, reject) => {
                resolve(this.getDetails());
            });
            getDetails.then(() => {
                this.getCountries();
                
            });
        },
        components: {
            'v-select': vSelect
        },
        watch: {
            'waybill.bill_to' () {
                if(this.waybill.bill_to == 'R') {
                    this.setTransportGDRRate();
                }
                if(this.waybill.bill_to == 'S' || this.waybill.bill_to == 'O') {
                    this.setTransport();
                }
            },
            'waybill.weight' () {
                if(this.waybill.bill_to == 'R') {
                    this.setTransportGDRRate();
                }
                if(this.waybill.bill_to == 'S' || this.waybill.bill_to == 'O') {
                    this.setTransport();
                }
            },
            'waybill.package_type' () {
                if(this.waybill.bill_to == 'R') {
                    this.setTransportGDRRate();
                }
                if(this.waybill.bill_to == 'S' || this.waybill.bill_to == 'O') {
                    this.setTransport();
                }
            },
            'waybill.con_country' () {
                if(this.waybill.bill_to == 'R') {
                    this.setTransport();
                }
                if(this.waybill.bill_to == 'S' || this.waybill.bill_to == 'O') {
                    this.setTransport();
                }
            },
            dimWeight () {
                if(this.waybill.bill_to == 'R') {
                    this.setTransport();
                }
                if(this.waybill.bill_to == 'S' || this.waybill.bill_to == 'O') {
                    this.setTransport();
                }
            }
        },
        computed: {
            waybill() {
                if (this.response.waybill.con_name) {
                    return this.response.waybill;
                }

                if (! this.freight.waybill_id) return {};
                const waybill = this.waybills[this.freight.waybill_id] ? this.waybills[this.freight.waybill_id] : {};
                setTimeout(() => {
                    if(waybill.bill_to == 'R') {
                        this.setTransportGDRRate()
                    } 
                    if(this.waybill.bill_to == 'S' || this.waybill.bill_to == 'O') {
                        this.setTransport();
                    }
                    
                    $('select.countries').selectpicker({
                        size: 'auto',
                        liveSearch: true,
                        liveSearchPlaceholder: 'Search...',
                    });

                    $('input').on('focus', function () {
                        this.select();
                    });
                  $('select.manual').selectpicker({
                      size: 'auto',
                      liveSearch: true,
                      liveSearchPlaceholder: 'Search...',
                  });
                  $('input').on('focus', function () {
                      this.select();
                  });
                } , 500);

                return waybill;
            },
            totalDiscount() {
                let discount = isNaN(parseFloat(this.freight.discount)) ? 0 : parseFloat(this.freight.discount);
                let freight = isNaN(parseFloat(this.freight.transport)) ? 0 : parseFloat(this.freight.transport);

                discount = discount == 0 ? 0 : freight * (discount/100);

                return discount;
            },
            fuelLevy() {
                let rate = parseFloat(this.freight.fuel_levy);
                let freight = parseFloat(this.freight.transport);

                if (isNaN(freight) || isNaN(rate)) {
                    return 0;
                }

                return  this.waybill.bill_to == 'R' ? 0 : (rate * (freight - this.totalDiscount))/100;
            },
            insurance() {
                let conversion = parseFloat(this.freight.insurance_rate);
                let freight = parseFloat(this.freight.declared_value);

                if (isNaN(conversion) || isNaN(freight)) {
                    return 0;
                }

                return this.waybill.bill_to == 'R' ? 0 : freight * (conversion / 100);
            },
            vat() {
                let vatRate = isNaN(parseFloat(this.freight.vat_rate)) ? 0 : parseFloat(this.freight.vat_rate);
                let freight = isNaN(parseFloat(this.freight.transport)) ? 0 : parseFloat(this.freight.transport);

                return  this.waybill.bill_to == 'R' ? 0 : (vatRate/100) * ((freight - this.totalDiscount) + this.fuelLevy + this.insurance);
            },
            invoiceTotal() {
                let freight = (isNaN(parseFloat(this.freight.transport)) ? 0 : parseFloat(this.freight.transport));

                return this.insurance + this.vat + (freight - this.totalDiscount) + this.fuelLevy + this.otherCharges;
            },
            otherCharges() {
                let conversion = parseFloat(this.freight.insurance_rate);
                let freight = parseFloat(this.freight.declared_value);

                if (isNaN(conversion) || isNaN(freight)) {
                    return 0;
                }

                if(!this.freight.outbound_other_charges || !this.freight.outbound_other_charges.length) return 0;

               return this.freight.outbound_other_charges.map(charge => {
                        return parseFloat(charge.value)
                    }).reduce((sum, charge) => {
                        return sum+charge
                    });  
            },
            dimWeight() {
                if(!this.waybill.dims || !this.waybill.dims.length) return 0;

                return this.waybill.dims.map(dim => {
                    return parseFloat(dim.weight);
                }).reduce((accWeight, weight) => {
                    return accWeight + weight;
                });
            },
            canProcessInvoice() {
                if((this.waybill.bill_to == 'R' && this.freight.client_id == this.fedexAccount) || this.isEdit) {
                    return true;
                }
                else if((this.waybill.bill_to == 'R' && this.freight.client_id != this.fedexAccount) || this.isEdit) {
                    return false;
                }
                else if((this.waybill.bill_to != 'R' && this.freight.client_id == this.fedexAccount) || this.isEdit) {
                    return false;
                }
                else {
                    return true;
                }
            },
            clientDetails() {
                if(!this.freight.client_id) return {};

                return this.clients.filter(client => client.DCLink == this.freight.client_id)[0];
            },
            salesRates() {
                if(!this.discountRates.length || !this.freight.client_id) return this.salesRateCard;

                const rates = this.discountRates.filter(rate => rate.client_id == this.freight.client_id);

                return rates.length ? rates[0] : this.salesRateCard;
            }
        },
        mounted() {
            $('#con_country').change(function(event) {
                this.waybill.con_country = event.target.value;
            });
        },
        methods: {
            getChargeName(id) {
                return this.oCharges.filter(charge => charge.id == id)[0].code;
            },
            formatDate(date) {
                if (! date) return '';

                return (new Date(date)).toDateString();
            },
            addDim() {
                if(!this.dim.length) { toastr.error('length is required'); return; }
                if(!this.dim.width) { toastr.error('width is required'); return; }
                if(!this.dim.height) { toastr.error('width is required'); return; }
                this.dim.weight = (this.dim.length * this.dim.width * this.dim.height)/ 5000;

                this.waybill.dims.push(this.dim);
                this.dim = {};
                return;
            },
            editDim(index) {
                this.dim = this.waybill.dims[index];
                this.waybill.dims.splice(index);

                return;
            },
            deleteDim(index) {
                this.waybill.dims.splice(index);

                return;
            },
            getPackage(type) {
                switch (type) {
                    default:
                    case 1:
                    case 3:
                    case 4:
                    case 5:
                        return 'FEDEX OTHER';
                    case 2:
                        return 'FEDEX PAK';
                    case 6:
                        return 'FEDEX ENVELOPE';
                }
            },
            getRawPackage(type) {
                switch (type) {
                    default:
                        return 'OTHER';
                    case 1:
                        return 'OTHER';
                    case 3:
                        return 'OTHER';
                    case 4:
                        return 'OTHER';
                    case 5:
                        return 'OTHER';
                    case 2:
                        return 'PAK';
                    case 6:
                        return 'ENV';
                }
            },

            setTransport() {
                let country = this.waybill.con_country;

                if (! country) {
                    this.freight.transport = 0;
                    return;
                }

                let zone = this.zones.filter(item => item.code == country);

                if (! zone.length) {
                    this.freight.transport = 0;
                    return;
                }
                let key = zone[0].zone.toLowerCase();
                let packaging = this.getRawPackage(this.waybill.package_type);

                let weight = this.dimWeight > parseFloat(this.waybill.weight) ? this.dimWeight : parseFloat(this.waybill.weight);

                if (this.waybill.weight.toLowerCase().indexOf('l') !== -1) {
                    weight = weight / 2.2046226218;
                }

                if (weight < 0.25) {
                    if (packaging == 'ENV') {
                        weight = 0.25;
                    } else {
                        weight = 0.5;
                    }
                }

                if (weight > 0.25) weight = Math.round(weight*2)/2;

                const salesRates = this.salesRates.rates ? this.salesRates.rates : [];
                let rate = salesRates.filter(item => item.package_type == packaging && item.weight >= weight);
                if (! rate.length) {
                    this.freight.transport = 0;
                    return;
                }

                rate = rate[0];

                this.freight.transport = parseFloat(rate[key]).toFixed(2);
            },
            getBillingCode(code) {
                return this.packages.filter(p => p.code == code)[0];
            },
            getZone(country) {
               return (this.zones.filter(zone => country == zone.code)[0].zone).toLowerCase();
            },
            getWaybillWeight(weight) {
                return weight.replace(/[^\d.-]/g, '');
            },
            setCustomerSalesRate() {
                const weight = parseFloat(this.getWaybillWeight(this.waybill.weight));
                const waybillWeight = (this.dimWeight > weight) ? this.dimWeight : weight;
                const salesRates = this.salesRateCard.rates ? this.salesRateCard.rates : [];
               const rates =  salesRates.filter(rate => this.getBillingCode(this.waybill.package_type).billing_code == rate.package_code
                 && ((waybillWeight > parseFloat(rate.start_weight)) && (waybillWeight <= parseFloat(rate.end_weight))));

               if(rates.length) {
                   const last = rates.length - 1;

                   this.freight.transport = (parseFloat(rates[last][this.getZone(this.waybill.con_country)])).toFixed(2);
               } else {

                   this.freight.transport = 0;
               }
            },
            setTransportGDRRate() {
                let country = this.waybill.con_country;

                if (! country) {
                    this.freight.transport = 0;
                    return;
                }

                let zone = this.zones.filter(item => item.code == country);

                if (! zone.length) {
                    this.freight.transport = 0;
                    return;
                }
                let key = zone[0].zone.toLowerCase();
                let packaging = this.getRawPackage(this.waybill.package_type);

                let weight = this.dimWeight > parseFloat(this.waybill.weight) ? this.dimWeight : parseFloat(this.waybill.weight);

                if (this.waybill.weight.toLowerCase().indexOf('l') !== -1) {
                    weight = weight / 2.2046226218;
                }

                if (weight < 0.25) {
                    if (packaging == 'ENV') {
                        weight = 0.25;
                    } else {
                        weight = 0.5;
                    }
                }
                // if (weight > 0.25) weight = weight - parseInt(weight) < 0.5 ? parseInt(weight) + 0.5 : parseInt(weight) + 0.5;

                if (weight > 0.25) weight = Math.round(weight*2)/2;
                if (weight > 71) weight = 71;

                const gdrRates = this.gdrRates.rates ? this.gdrRates.rates : [];
                let rate = gdrRates.filter(item => item.package_type == packaging && item.weight >= weight);

                if (! rate.length) {
                    this.freight.transport = 0;
                    return;
                }

                rate = rate[0];

                this.freight.transport = parseFloat(rate[key]).toFixed(2);
            },
            getGDRRates() {
                this.$root.isLoading = true;
                axios.get('/active-gdr').then(response => {
                    this.gdrRates = response.data;
                    this.$root.isLoading = false;
                }).catch(res => {
                    this.$root.isLoading = false;
                });
            },
            getSalesRateCard() {
                this.$root.isLoading = true;
                axios.get('/active-sales-rate-card').then(response => {
                    this.salesRateCard = response.data;
                    this.$root.isLoading = false;
                }).catch(() => this.$root.isLoading = false);
            },
            getDiscountRates(){
                //discount-rate-card
                axios.get('/discount-rate-card?ajax=1').then(response => {
                    this.discountRates = response.data;
                    this.$root.isLoading = false;
                }).catch(()=> this.$root.isLoading = false);
            },
            getDetails() {
                this.$root.isLoading = true;
                axios.get('/waybill/freight/create?fill=t').then((response) => {
                    this.waybills = response.data.waybills;
                    this.clients = response.data.clients;
                    this.settings = response.data.settings;
                    this.rates = response.data.rates;
                    this.fedexAccount = response.data.fedex_account;
                    this.zones = response.data.zones;
                    this.freight.insurance_rate = this.settings['Current Insurance Rate']['current_value'];
                    this.freight.vat_rate = this.settings['Current VAT Rate']['current_value'];
                    this.freight.fuel_levy = this.settings['Current Levy Rate']['current_value'];
                    this.couriers = response.data.couriers;
                    this.settings.forEach(setting => {
                        if(setting.key == 'Discount') {
                            this.freight.discount = setting.value
                        }
                    });
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
                this.$root.isLoading = true;
                axios.get('/freight/' + this.id +'/edit?fill=t').then((response) => {
                    this.settings = response.data.settings;
                    this.response = response.data.invoice;
                    this.freight = response.data.invoice.proforma_data;
                    this.fedexAccount = response.data.fedex_account;
                    
                    this.zones = response.data.zones;
                    this.rates = response.data.rates;
                    this.couriers = response.data.couriers;
                    this.freight.outbound_other_charges = this.response.outbound_other_charges;
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
            getCountries() {
                this.$root.isLoading = true;
                axios.get('/countries').then(response => {
                    let countries = [];
                    const rawCountries = response.data;

                    for (var index in rawCountries) {
                        countries.push({name:rawCountries[index], id: index})
                    }
                    this.countries = countries;
                    setTimeout(() => {
                        $('select.countries').selectpicker({
                            size: 'auto',
                            liveSearch: true,
                            liveSearchPlaceholder: 'Search...',
                        });

                        $('input').on('focus', function () {
                            this.select();
                        });
                    }, 200);
                    this.$root.isLoading = false;
                });
            },
            getOtherCharges() {
                this.$root.isLoading = true;
                axios.get('/other-charges?ajax=1').then(response => {
                    this.oCharges = response.data;
                    this.$root.isLoading = true;
                });
            },
            addOtherCharges() {
                if(!this.otherCharge.key && !this.otherCharge.value) return
                if(parseFloat(this.otherCharge.value) <= 0) {
                    toastr.error('invalid charge value')
                }
                this.otherCharge.value = parseFloat(this.otherCharge.value);
                const otherCharge = this.otherCharge;
                this.freight.outbound_other_charges.unshift(otherCharge);
                this.otherCharge = {};

                return;
            },
            editOtherCharges(index) {
                let oCharge = this.freight.outbound_other_charges[index];
                this.otherCharge.key = oCharge.key;
                this.otherCharge.value = oCharge.value;

                this.freight.outbound_other_charges.splice(index, 1);

                return;
            },
            deleteOtherCharges(index) {
                this.freight.outbound_other_charges.splice(index, 1);

                return;
            },
        },
    }
</script>
