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
                                    <td><button class="view-client" data-id="${client.ClientID}">View Profile</button></td>
                                </tr>`
                                )).join('')
                            }
                        </table>
                    </div>
                `;

                // Create a modal to show the profile details of each client when they are clicked
                const modal = document.createElement('div');
                modal.className = "modal";
                modal.innerHTML = `
                <div class="modal-content product-details">
                    <span class="close">&times;</span>
                    <div class="client-modal-content"></div>
                </div>
                `;

                document.body.appendChild(modal);
                const modalContent = modal.querySelector('.client-modal-content');
                const closeModal = modal.querySelector('.close');
                closeModal.onclick = function(){
                  modal.style.display = 'none';
                };

                const viewClientProfile = this.querySelectorAll('.view-client');
                console.log(viewClientProfile);
                viewClientProfile.forEach(eachClient => {
                    eachClient.onclick = function(){
                        const clientId = eachClient.dataset.id;
                        console.log(clientId);
                        const targetClient = clients.find(client => client.ClientID == clientId);
                        console.log(targetClient);

                        modalContent.innerHTML = `
                            <div>
                                <h3>Welcome to ${targetClient.Firstname} ${targetClient.Lastname} profile</h3>
                                <p>Email: ${targetClient.Email}</p>
                                <p>Phone Number: ${targetClient.PhoneNo}</p>
                                <p>Address: ${targetClient.Address}, ${targetClient.PostCode}</p>
                                <p>Country: ${targetClient.ClientCountry}</p>
                                <hr>
                                <h2>Investment Preferences</h2>
                                <p>Risk level: ${targetClient.RiskLevel}</p>
                                <button>Recommend an investment</button>
                            </div>
                        `;

                        modal.style.display = 'block';




                    }
                })


                
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