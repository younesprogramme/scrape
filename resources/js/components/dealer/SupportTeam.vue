<template>
    <div class="dealer-card card rounded-3 bg-white pb-3 mb-3">
        <div class="card-body bg-white p-3">
            <div class="other-infos bg-light d-flex p-3 align-items-end">
                <div class="icon px-2"><i class="fas fa-user-tag fa-2x fa-fw text-muted"></i></div>
                <div class="info px-2">
                    <div class="title text-muted small">Panel set up specialist</div>
                    <div class="value lh-sm">
                        {{ dealerSupport.setupSpecialist ? dealerSupport.setupSpecialist.name : '-' }}
                    </div>
                </div>
            </div>
            <div class="other-infos bg-light d-flex p-3 align-items-end">
                <div class="icon px-2"><i class="fas fa-user-tag fa-2x fa-fw text-muted"></i></div>
                <div class="info px-2">
                    <div class="title text-muted small">Marketing advisor</div>
                    <div class="value lh-sm">
                        {{ dealerSupport.marketingAdvisor ? dealerSupport.marketingAdvisor.name : '-' }}
                    </div>
                </div>
            </div>
            <div class="text-end" v-if="can('edit-dealer')">
                <button type="button" class="btn-sm btn btn-outline-secondary" title="Edit" data-bs-toggle="modal" data-bs-target="#change_marketing_responsible">Edit</button>
                <div class="modal" tabindex="-1" id="change_marketing_responsible">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Change marketing advisor or panel setup specialist</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form @submit.prevent="submitDealerSupport" name="form_change_affected_marketing" id="form_change_affected_marketing">
                                    <div class="mb-3 form-group">
                                        <label for="panel_set_up_specialist_id" class="col-form-label">Panel set up specialist:</label>
                                        <select class="form-control" name="panel_set_up_specialist_id" id="panel_set_up_specialist_id" v-model="setupSpecialistId">
                                            <option value="">None</option>
                                            <option v-for="setupSpecialist in setupSpecialists" value="{{ setupSpecialist.id }}">{{ setupSpecialist.name }}</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 form-group">
                                        <label for="marketing_advisor_id" class="col-form-label">Marketing advisor</label>
                                        <select class="form-control" name="marketing_advisor_id" id="marketing_advisor_id" v-model="marketingAdvisorId">
                                            <option value="">None</option>
                                            <option v-for="marketingAdvisor in marketingAdvisors" value="{{ marketingAdvisor.id }}">{{ marketingAdvisor.name }}</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" form="form_change_affected_marketing" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "dealer-support-team",
    data() {
        return {
            marketingAdvisorId: null,
            setupSpecialistId: null,
        };
    },
    props: {
        dealerId: {
            required: true,
        },
        dealerSupport: {
            required: true,
            type: Object,
        },
        marketingAdvisors: {
            required: false,
            type: Array,
            default: [],
        },
        setupSpecialists: {
            required: false,
            type: Array,
            default: [],
        }
    },
    mounted() {
        this.marketingAdvisorId = this.dealerSupport.marketing_advisor_id;
        this.setupSpecialistId = this.dealerSupport.panel_set_up_specialist_id;
    },
    methods: {
        can(role) {
            return true; // TODO: Use global function for access
        },
        submitDealerSupport() {
            console.log('submitDealerSupport');
            // action="dealer_change_support_team', ['dealer' => $dealer->id]"
        }
    }
}
</script>

<style scoped>

</style>
