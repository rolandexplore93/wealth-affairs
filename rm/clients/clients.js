// Prevent javascript code from loading until html code has been completely loaded
document.addEventListener('DOMContentLoaded', () => {
fetch('http://localhost/wealth_affairs/rm/backend/allClients.php')
.then(response => response.json())
.then(clients => {
    // Define ClientsTable to display all registered clients
    console.log(clients)
    class Clients extends HTMLElement {
        connectedCallback(){
            this.innerHTML =
                `
                    <div class="content">
                        <table>
                            <tr>
                                <th>Client code</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Country</th>
                                <th>Action</th>
                            </tr>
                            ${clients.map(client => (
                                `<tr>
                                    <td>${client.ClientID}</td>
                                    <td>${client.Firstname}</td>
                                    <td>${client.Lastname}</td>
                                    <td>${client.PhoneNo}</td>
                                    <td>${client.Email}</td>
                                    <td>${client.ClientCountry}</td>
                                    <td><button class="idme" data-id="${client.ClientID}">View Profile</button></td>
                                </tr>`
                                )).join('')
                            }
                        </table>
                    </div>
                `;
                
                // const viewClient = this.querySelectorAll('idme')
                // console.log(viewClient)
    
            }
    }
    customElements.define('client-profile', Clients);
})
.catch(error => console.error(error));






// document.getElementById('idme').onclick = function(){
//     console.log("Yipeeee");
//   }




});