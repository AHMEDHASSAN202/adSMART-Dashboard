window.axios = require('axios');

window.axiosInstanceWithoutCommonHeaders = axios.create();

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');
