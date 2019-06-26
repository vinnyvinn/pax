<template>
    <div class="row">
        <div class="form-group col-sm-12">
            <label for="">Waybill Number</label>
            <select name="waybill_id" v-model="pod.waybill_id" id="waybill_id" class="form-control manual">
                 <option value="" selected disabled>Select Waybill</option>
                <option v-for="waybill in waybills" :key="waybill.id" :value="waybill.id">{{ waybill.waybill_number }}</option>
            </select>
        </div>
        <div class="form-group col-sm-4">
            <label for="pod_name">Name</label>
            <input type="text" name="pod_name" id="pod_name" v-model="pod.pod_name" class="form-control">
        </div>
        <div class="form-group col-sm-4">
            <label for="pod_date">POD Date</label>
            <datepicker class="form-control" v-model="pod.pod_date"></datepicker>
        </div>
        <div class="form-group col-sm-4">
            <label for="pod_time">POD Time</label>
            <input type="time" name="pod_time" id="pod_time" v-model="pod.pod_time" class="form-control">
        </div>
        <div class="form-group col-sm-4">
            <label for="">Courier</label>
            <select name="courier_id" id="courier_id" v-model="pod.courier_id" class="form-control manual">
                <option value="" selected disabled>Select Courier</option>
                <option v-for="courier in couriers" :key="courier.id" :value="courier.id">{{ `${courier.name} - ${courier.fedex_id}` }}</option>
            </select>
        </div>
        <div class="col-sm-12">
            <button type="submit" class="btn btn-flat btn-primary pull-right" @click.prevent="savePODProcessing()">Save POD</button>
        </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
export default {
    data() {
        return {
            couriers: [],
            waybills: [],
            pod: {

            }
        };
    },
    components: { Datepicker },
    created() {
        this.getCouriersWaybills();
    },
    methods: {
        getCouriersWaybills() {

            this.$root.isLoading = true;
            axios.get('/freights/pod-scan?ajax=1').then(resp => {

                this.couriers = resp.data.couriers;
                this.waybills = resp.data.waybills;

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

        savePODProcessing() {

            if(this.validate()) return;

            this.$root.isLoading = true;
            axios.post('/freights/pod-scan', this.pod).then(resp => {

                this.pod = {};
                this.$root.isLoading = false;
                window.toastr.info(resp.data.message);
                setTimeout(() => {
                    window.location.reload();
                }, 50);
            }).catch(() => this.$root.isLoading = false);
        },

        validate() {

            let error = false;

            if(!this.pod.waybill_id) {
                error = true;
                window.toastr.error('Waybill is required');
            }

            if(!this.pod.pod_name) {
                error = true;
                window.toastr.error('POD name is required');
            }

            if(!this.pod.pod_date) {
                error = true;
                window.toastr.error('POD date is required');
            }

            if(!this.pod.pod_time) {
                error = true;
                window.toastr.error('POD time is required');
            }

            if(!this.pod.courier_id) {
                error = true;
                window.toastr.error('POD Courier is required');
            }

            return error;
        }
    }
}
</script>

<style>

</style>
