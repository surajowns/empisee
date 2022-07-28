/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
  apiKey: "AIzaSyAFPw42BvAv6GFmc_cFT8XlpQuaxFAbXeU",
  authDomain: "emp-push-notification.firebaseapp.com",
  projectId: "emp-push-notification",
  storageBucket: "emp-push-notification.appspot.com",
  messagingSenderId: "1016907371044",
  appId: "1:1016907371044:web:770a6b0a49b77b3547beb1"
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
  console.log(
    "[firebase-messaging-sw.js] Received background message ",
    payload,
  );
  /* Customize notification here */
  const notificationTitle = "Background Message Title";
  const notificationOptions = {
    body: "Background Message body.",
    icon: "{{url('public/assets/img/logo.png')}}",
  };

  return self.registration.showNotification(
    notificationTitle,
    notificationOptions,
  );
});