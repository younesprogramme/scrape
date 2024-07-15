<template>
    <div class="dealer-card card rounded-3 bg-white mb-3">
        <div class="card-body pb-4">
            <a class="ms-auto btn btn-outline-secondary btn-sm" title="history" href="#"><i class="fas fa-history"></i> History</a>
            <div class="logo text-center mt-3 mb-2">
                <img src="/img/cars.jpg" class="img-thumbnail rounded-circle" alt="">
            </div>
            <h5 class="card-title text-center">{{ dealerInfo.name }}</h5>
            <h6 class="card-subtitle text-muted text-center mb-0">{{ dealerInfo.contact_name }}</h6>
            <div class="small text-muted text-center">
                <button v-if="can('edit-dealer')" type="button" class="btn btn-light btn-sm" id="btn_change_main_account_password" title="Change password" data-bs-toggle="modal" data-bs-target="#change_password_modal"><i class="fas fa-key"></i></button>
                <span>{{ dealer.login }}</span>
                <a :href="'https://www.v12software.com/signup3/login?id_user=' + encodeURIComponent(dealer.login)" class="btn btn-dark btn-sm" target="_blank" title="Login into account"><i class="far fa-share-square"></i></a>
            </div>
            <div class="d-flex flex-column flex-md-row flex-md-wrap text-center text-md-start mt-4">
                <div class="col-sm-6 col-xl-4 offset-xl-1 g-0 ps-2 pb-3">
                    <div class="text-muted"><i class="fas fa-star-half-alt"></i> Status</div>
                    <div class="value fw-bold" :class="dealer.status === 'active' ? 'text-highlight' : 'text-danger'">{{ dealer.status }}</div>
                </div>
                <div class="col-sm-6 col-xl-4 offset-xl-2 g-0 pb-3">
                    <div class="text-muted"><i class="far fa-handshake"></i> Register date</div>
                    <div class="value" v-if="dealer.register_date">{{ formatDate(dealer.register_date) }}</div>
                </div>
                <div class="col-sm-6 col-xl-4 g-0 ps-2 offset-xl-1">
                    <div class="text-muted"><i class="far fa-clock"></i> Last Login</div>
                    <div class="value" v-if="dealer.login_date">{{ formatDate(dealer.login_date) }}</div>
                </div>
                <div class="col-sm-6 col-xl-4 g-0 offset-xl-2">
                    <div class="text-muted"><i class="fas fa-phone-alt"></i> Phone</div>
                    <div class="value">
                        <div>{{ dealerInfo.phone }}</div>
                        <div>{{ dealerInfo.phone2 }}</div>
                        <div>{{ dealerInfo.cel_phone }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="other-infos bg-light border-top d-flex p-3 align-items-end" v-if="!doNotCall && (dealer.v12_sales_person || dealer.referral_source)">
            <div class="icon px-2"><i class="fas fa-user-tag fa-2x fa-fw text-muted"></i></div>
            <div class="info px-2">
                <div class="title text-muted small">Plan: {{ dealer.referral_source }}</div>
                <div class="value lh-sm">
                    Sales: {{ dealer.v12_sales_person ? dealer.v12_sales_person.code : ''}}
                </div>
            </div>
        </div>
        <div class="other-infos bg-light border-top d-flex p-3 align-items-end" v-if="!doNotCall && dealer.reseller_referralcode">
            <div class="icon px-2"><i class="far fa-building fa-2x fa-fw text-muted"></i></div>
            <div class="info px-2">
                <div class="title text-muted small">Reseller</div>
                <div class="value lh-sm">{{ dealer.reseller_referralcode }}</div>
                <div class="value lh-sm" v-if="dealer.sub_reseller_referralcode">{{ dealer.sub_reseller_referralcode}}</div>
            </div>
        </div>
        <div class="other-infos bg-light border-top d-flex p-3 align-items-end" v-if="!doNotCall">
            <div class="icon px-2"><i class="fas fa-map-signs fa-fw fa-2x"></i></div>
            <div class="info px-2">
                <div class="title text-muted small">Address</div>
                <div class="value lh-sm">
                    {{ dealerInfo.address }} <br>
                    {{ dealerInfo.city }} {{ dealerInfo.state_code }} {{ dealerInfo.zip }}
                </div>
            </div>
        </div>
        <div class="other-infos bg-danger border-top d-flex p-3 align-items-end" v-if="doNotCall">
            <div class="icon px-2 text-white"><i class="fas fa-exclamation-triangle fa-2x fa-fw"></i></div>
            <div class="info px-2 text-white flex-grow-1 d-flex justify-content-between align-items-center">
                <div class="fw-light fs-3">Do not call</div>
                <a v-if="can('view-do-not-call')" href="" class="link-info">Details</a>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "dealer-summary",
    props: {
        dealerInfo: {
            required: true,
            type: Object
        },
        dealer: {
            required: true,
            type: Object
        },
        doNotCall: {
            required: true,
            type: Boolean,
        },
    },
    methods: {
        can(role) {
            return true; // TODO: Use global function for access
        },
        formatDate(myDate) {
            if (myDate && myDate !== '0000-00-00 00:00:00') {
                const dateObject = new Date(myDate);
                return dateObject.toDateString();
            }
            return null;
        }
    }
}
</script>

<style scoped>

</style>
