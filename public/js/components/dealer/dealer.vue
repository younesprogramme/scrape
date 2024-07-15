<template>
    <div class="container-fluid mt-3">
        <div class="row align-items-start justify-content-center pb-5">
            <div class="col-md-10 col-lg-8 col-xl-6 col-xxl-4 mb-3">
                <dealer-summary
                    v-if="dealer"
                    :dealer="dealer"
                    :dealer-info="dealerInfo"
                    :do-not-call="doNotCall"
                ></dealer-summary>
                <dealer-support-team
                    v-if="!doNotCall"
                    :dealer-id="dealer.id"
                    :dealer-support="dealerSupport"
                    :marketing-advisors="marketingAdvisors"
                    :setup-specialists="setupSpecialists"
                ></dealer-support-team>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import DealerSummary from "./Summary";
import DealerSupportTeam from "./SupportTeam";

export default {
    name: "dealer-details",
    components: {
        DealerSummary,
        DealerSupportTeam
    },
    props: [
        'id'
    ],
    data() {
        return {
            dealer: null,
            dealerInfo: null,
            doNotCall: true,
            dealerSupport: null,
            setupSpecialists: [],
            marketingAdvisors: [],
        }
    },
    watch: {
        id() {
            this.loadDealerInfos();
        }
    },
    mounted() {
        this.loadDealerInfos();
    },
    methods: {
        loadDealerInfos() {
            if (this.id) {
                axios.get('/api/dealers/details/' + this.id)
                    .then(res => {
                        console.log(res.data);
                        if (res.data && res.data.hasOwnProperty('dealer')) {
                            this.dealer = res.data.dealer;
                            this.dealerInfo = res.data.dealerInfo;
                            const doNotCall = res.data.doNotCall;
                            if (!doNotCall) {
                                this.dealerSupport = res.data.dealerSupport;
                                this.marketingAdvisors = res.data.marketingAdvisors;
                                this.setupSpecialists = res.data.setupSpecialists;
                            }
                            this.doNotCall = doNotCall;
                        }
                    })
                    .catch(error => console.log(error))
            }
        },
    }
}
</script>

<style scoped>

</style>
