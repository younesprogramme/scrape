/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

const axios = require('axios');
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Accept'] = 'application/json';

// Get token
const token = localStorage.getItem('token');
if (token) {
    axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
}
else{
    axios.get('/vue/token') // TODO: Login with vue to get this token easily
        .then(res => {
            if (res.data && res.data.hasOwnProperty('token')) {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + res.data.token;
                localStorage.setItem('token', res.data.token);
            }
        });
}

