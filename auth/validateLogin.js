// This makes a GET request to the isLoggedIn.php endpoint to retrieve user information
// when they login into the application
fetch('http://localhost/wealth_affairs/auth/isLoggedIn.php')
.then(response => response.json())
.then(data => {
    console.log(data)
    let userRole = document.getElementById('title-role').innerHTML = (data.Role == 'RM' && `Relationship Manager` || data.Role == 'FA' && 'Funds Administrator');
    let name = document.getElementById('name').innerHTML = (data.Role == 'RM' && `${data.Firstname} ${data.Lastname}` || data.Role == 'FA' && `${data.Firstname} ${data.Lastname}`);
    let email = document.getElementById('email').innerHTML = (data.Role == 'RM' && `${data.Email}` || data.Role == 'FA' && `${data.Email}`);
    let phoneno = document.getElementById('phoneno').innerHTML = (data.Role == 'RM' && `${data.PhoneNo}` || data.Role == 'FA' && `${data.PhoneNo}`);

})
.catch(error => console.log("Error message: " + error))



