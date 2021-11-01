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


/*import Echo from "laravel-echo"
window.io = require('socket.io-client');
    window.Echo = new Echo({
        broadcaster: 'socket.io',
        host: window.location.hostname + ':6002',
        auth: {
            headers: {
                Authorization: 'Bearer ' + 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiNjMyMDQ5ZDIxZWRkODQ1NDUwNWU2Y2U1YWNjMzkzMjliYjhkMDhhMzBkY2JjYTFhNTIxMjlmNGY1NDM0NTY1YmFiY2QwMzIzODJlYzJkYjIiLCJpYXQiOjE2MzU3NTg0NDIuNTU3NzQyLCJuYmYiOjE2MzU3NTg0NDIuNTU3NzUxLCJleHAiOjE2MzU4NDQ4NDAuNjQ5ODk3LCJzdWIiOiIxNyIsInNjb3BlcyI6W119.nMIcGW2Gdv14MPEndpH85B1xozEs-eGsfz8jp7HX8wglslh0MarJB_mn1X2vBdry6hhWE9mggy-rLqmAKz67deeOzsGCqnrvt7OQQ_80nllCkkTD4l6bR9q3ADyE_aCszYtIRUbSkuOf4je_XDZhknvBvUkhVNU_yNBEs34rvRKhGSXStn_dScc3i6nWLFSX17o45zHe_AZwGA8xkEvdO4Rfx9gMJjLgJP-Hg07sKScPfwU461Zo7Duq_y4IXJmGIdmYV1lKjssyVuPoplZisrSXE4Fnq-tY7gKZVmuH-Be_zIIgAwlFaBGg_RwXFXk746DD6SmVWaghGYXKne20VSrFBq8k2Z5VVcuAuN4O8rH-UOdjXbt_ZVIA1MR9340T-XrUpyPVZDz85ZyLMfjXBfyPzQLcJysAEkkTNLrxc2NHxb1AGsLWYHo47x2FBCMjxx-NN9MUSf4SIZTH_hdGKtWcIo5GKIUGKL0_1BvmNWDm6eIUQt2UsLLhNTbjvZgPs_sqNazM-AUnAhiUlb4y6uMvZY9Io3UxKS2PDeIz7femnL8xTCA7ninfMKgbff2RhNAKWBbN7sb9CUgW4DbzCTUgV3-CLbDNdmji1l_5cMaA-9z76xdWQFfiNxqkK3A0ZSeulgUYdpwN2yJyzono52tSPVzeWhm_MXWF9Z4ZqeA'
            }
        }
    });*/

