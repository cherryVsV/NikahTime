window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

/*import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '8c2f928398e40045974c',
    cluster: 'ap1',
    wsHost:  window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
    scheme: 'http',
    auth: {
        headers: {
            Authorization: 'Bearer ' + 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiOTZiOWJlNDFiNjRhMThmZTUzNmVmNDZhNWZlZDhjN2RmYzA2YTViN2E3YjllYjAyYTU3ODMxOGI5ZmFkNjZjZDlmNjkxNGFmMzY1NDEwNGUiLCJpYXQiOjE2MzUxNzMzNjYuMTg0NzIxLCJuYmYiOjE2MzUxNzMzNjYuMTg0NzI4LCJleHAiOjE2MzUyNTk3NjUuMjIxMDk3LCJzdWIiOiI5Iiwic2NvcGVzIjpbXX0.y1wfZvYRLkhKlth3_p-Q-G1y8ChwDbdXzCTe5RDNt2rqK_TzzdOwJ3WVgj8UchcnkeGQQ78sXuL3Y-ZaWLdJQN-6VsEmuxSXwI80j7HjFOMDH1F3jF_w1gOgdva0b_BSas8mLcq2Xwy6-zHluvDIyoCZZ73d-Fbm4jMTEwwj_kzD3NwRxgZbPr4r6kxEf3sQKj_gtpws63EvCZkuy9Z6kz7VQj8zaQRq8oADVFRngTkqWxz56PSDAb8jVWRgtnMs8dK7CmeGrqQhDIru_eP4dyDxRPtGpTEljEfXb10Mg66QZa19nw9UoWcWXPUcCUgxPYFMEpPrZ3WkzpoGu_Cslnjz4EK4vflK9WWPf9liISb01ep4VXBWUjNJTf1Rn9vZP2XO-Hp77fRxhr456PQrIwStu7XK40oomFKE1CIQasJpFxpFyOCFTr1REcO0xJObWhMqf2yokUguSokkfawsenr-fh6EuGkOiEg_stqhvnx_5pFT5tgw0WtvDK2i9itSxBApQ8TujqiSda_J1e_XuRRVmQxNzZ40iWX6QTQ5ymi3KR2TycZy8zIn3KcELh8EVMuSw5vUcDZk5x5RVdI_LlR676j21_OZQlUwG1rTecE9FVCuKbpuzyINaQ5xt-lOhdgZzAwxFxsTOWdFrlDVL3_IaWTkZ23gvEs47CmwbG4'
        }
    }
});*/


import Echo from "laravel-echo"
window.io = require('socket.io-client');
    window.Echo = new Echo({
        broadcaster: 'socket.io',
        host: window.location.hostname + ':6002',
        auth: {
            headers: {
                Authorization: 'Bearer ' + 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiNzkxZGM5ZTc3Mjc4Nzc1MmFkODg4MDRlN2UxMzI2NDQ1MDJiMzk4NDZlNTY0MGRhODkxNzA1NTc5NDZhZjIwMWRiNjVhNWUyYjUzYzE3ZTciLCJpYXQiOjE2MzU1MDA2MDIuNjgyMTc2LCJuYmYiOjE2MzU1MDA2MDIuNjgyMTgzLCJleHAiOjE2MzU1ODcwMDAuNTQ4ODMsInN1YiI6IjE3Iiwic2NvcGVzIjpbXX0.Bj1XoPyp3j-_wNmBd_C9YgvwhWi821oyshQwnHdiOnPaOgCFLMPfJkrh7V6L2SD-1ZprdWW68ONmG1YudgzsaCtn38IW_tFZTU1P4okYSTLXCCgYnm6l68VypwPF42KGY5CpnigMacrkWVRDvuTmUA1u1T-bclWma1A5Ip8qtn1cvO0P13xyYyRnT47gyAocOX0J1_dyPnP3RKdFvnEzIjqRHr2BtbkpP7P39oLiJQnNnyibIY7NJviVTbYhR6Bd1zsiO45EgG6f4Qb-ya65s2A8z2npuMcLiDrZnzNHgC9Yt-AOIv9YXvs0SDWcRO1CfhwtmoHMNL0Wjh2CoR3VvaVpwOgeWTy-thKMpgl9DablsWOgCmWzJoIP4BfeVn3AduqH9VY-bedg-25j41wjSSNmXl1M0kxxofpi1knfy1lfOos-NXzDhirpheNAD8Zqm3fH3tybg97M5H5qpNXUj8ocBjvmrVFPl5px9hzjVL2-6XSy-LA8IE1lhn83j5jm5EJD-YdK3ra3115sukD8Qz0S02LPugaRlXh7rJ4-GLeL_QEjRA3yVaxbfirRU2Yq7KxYm2bhin2SPT892T2V93SKjPw7UDXLj0swm2qTuSsCtsG_woMLDG4I_OJ6wdADjPJH1JSXmLqBOGM-hU2MnVaC9NX5OkLKM-OtazZohAQ'
            }
        }
    });

