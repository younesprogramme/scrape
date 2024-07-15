<template>
    <div class="container">
        <div class="">
            <div class="col-lg-6 col-xl-5 mx-auto">
                <div id="form_request_code" class="pb-5 px-3 mx-auto form-search">
                    <div class="text-center"><img src="/img/logo-v12-big.png" alt="" class="mx-auto search-logo"></div>
                    <p class="text-danger" v-if="searchError"><i class="fas fa-warning"></i> {{ searchError }}</p>

                    <div class="input-group input-group-rounded-pill">
                        <input type="text" name="search" required class="form-control" aria-label="Dealer ID" v-model="queryString" placeholder="Id, login, email, name, website, city, contact name">
                        <button class="btn btn-outline-secondary" type="submit" @click="search()"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card rounded-3 mb-5" v-if="results">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact Name</th>
                        <th>City</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="dealer in results">
                        <td>
                            <router-link :to="{name: 'dealer_show', params: {id: dealer.id}}">{{ dealer.id }}</router-link>
                        </td>
                        <td>
                            <router-link :to="{name: 'dealer_show', params: {id: dealer.id}}">{{ dealer.dealer_info ? dealer.dealer_info.name : '' }}</router-link>
                        </td>
                        <td>{{ dealer.dealer_info ? dealer.dealer_info.contact_name : '' }}</td>
                        <td>{{ dealer.dealer_info ? dealer.dealer_info.city : '' }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "dealer-search",
    data() {
        return {
            searchError: null,
            queryString: null,
            results: null,
            totalResults: 0,
        }
    },
    mounted() {
        if(this.$route.query.hasOwnProperty('q')) {
            this.queryString = this.$route.query.q;
            this.getResults();
        }
    },
    methods: {
        search() {
            this.$router.push({name: 'dealer_search', query: {q: this.queryString}});
            this.getResults();
        },
        getResults() {
            this.results = null;
            axios.post('/api/dealers/search', {'search': this.queryString})
                .then(res => {
                    if (res.data) {
                        this.results = res.data.data;

                        if (1 === res.data.total) {
                            this.$router.push({'name': 'dealer_show', 'params': {'dealer': res.data.data[0].id}})
                        } else {
                            this.totalResults = res.data.total;
                        }
                    }
                })
                .catch(error => console.log(error))
        }
    }
}
</script>

<style scoped>

</style>
