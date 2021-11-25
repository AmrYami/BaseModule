initSW();
function initSW() {
    if (!"serviceWorker" in navigator) {
        //service worker isn't supported
        console.log('service worker isn\'t supported');
        return;
    }

    //don't use it here if you use service worker
    //for other stuff.
    if (!"PushManager" in window) {
        //push isn't supported

        console.log('push isn\'t supported');
        return;
    }

    //register the service worker
    registerServiceWorker();

    console.log('serviceWorker installed!');
}

function registerServiceWorker() {
    return navigator.serviceWorker.register('./js/sw.js')
        .then(function(registration) {
            console.log('Service worker successfully registered.');
            initPush()
        })
        .catch(function(err) {
            console.error('Unable to register service worker.', err);
        });
}

function initPush() {

    return new Promise(function(resolve, reject) {
        const permissionResult = Notification.requestPermission(function(result) {
            resolve(result);
        });

        if (permissionResult) {
            permissionResult.then(resolve, reject);
        }
    })
        .then(function(permissionResult) {
            if (permissionResult !== 'granted') {
                throw new Error('We weren\'t granted permission.');
            }
            subscribeUser();
        });
}

function subscribeUser() {
    return navigator.serviceWorker.register('./js/sw.js')
        .then(function(registration) {
            const subscribeOptions = {
                userVisibleOnly: true,
                applicationServerKey: urlBase64ToUint8Array(
                    'BEl62iUYgUivxIkv69yViEuiBIa-Ib9-SkvMeAtA3LFgDzkrxZJjSgSnfckjBJuBkr3qBUYIHBQFLXYp5Nksh8U'
                )
            };

            console.log('subscribeUser subscribeUser subscribeUser ', subscribeOptions);
            return registration.pushManager.subscribe(subscribeOptions);
        })
        .then(function(pushSubscription) {
            // console.log('Received PushSubscription: ', JSON.stringify(pushSubscription));
            storePushSubscription(pushSubscription);
        });
}

function urlBase64ToUint8Array(base64String) {
    var padding = '='.repeat((4 - base64String.length % 4) % 4);
    var base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    var rawData = window.atob(base64);
    var outputArray = new Uint8Array(rawData.length);

    for (var i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

function storePushSubscription(pushSubscription) {
     const token = $('meta[name="csrf-token"]').attr('content');
    console.log('currentToken: ', currentToken);
    console.log('token: ', token);
     console.log('pushSubscription: ', pushSubscription);
    // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') "_token": "{{ csrf_token() }}"
    return fetch('push', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token

        },
        body: JSON.stringify(pushSubscription)
    })
        .then(function(response) {

            if (!response.ok) {
                throw new Error('Bad status code from server.');
            }
            return response.json();
        })
        .then(function(responseData) {
            if (!(responseData.data && responseData.data.success)) {
                throw new Error('Bad response from server.');
            }
        });
}

