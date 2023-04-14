// Check for inactivity every 1 minute (60000 milliseconds)
console.log('wwww');
// var inactivityTimeout = 5000;
// var checkInactivity = setInterval(function() {
//     // Make an AJAX request to a PHP file that checks the session
//     // and returns the last activity timestamp
//     fetch('http://localhost/wealth_affairs/auth/check_session_activity.php') // Replace with your PHP file that checks session activity
//         .then(response => response.json())
//         .then(data => {
//             var lastActivity = parseInt(data.last_activity);
//             // console.log(lastActivity)
//             var currentTime = new Date().getTime() / 1000; // Convert to seconds
//             // console.log(currentTime)
//             var elapsed = currentTime - lastActivity;
//             console.log(elapsed)
//             // Check if elapsed time is greater than 30 minutes (1800 seconds)
//             if (elapsed > 60) {
//                 // Perform logout operation, e.g. redirect to logout page
//                 window.location.href = 'http://localhost/wealth_affairs/auth/logout.php'; // Replace with your logout page or script
//             }
//         })
//         .catch(error => console.error(error));
// }, inactivityTimeout);

// fetch('http://localhost/wealth_affairs/auth/login.php')
// .then(response => response.json())
// .then(data => {
//     console.log(data)
// })
// .catch(error => console.log("Error message: " + error))

fetch('http://localhost/wealth_affairs/auth/isLoggedIn.php')
.then(response => response.json())
.then(data => {
    console.log(data)
})
.catch(error => console.log("Error message: " + error))



