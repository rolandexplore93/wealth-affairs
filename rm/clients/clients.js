// This prevents javascript codes from loading until html codes have loaded completely
document.addEventListener("DOMContentLoaded", () => {
  // Make an HTTP request to php backend API using JavaScript fetch to get the data of all clients who registered on the platform.
  // The raw data received is converted to a usable format by parsing it to a JavaScript object using json()
  fetch("http://localhost/wealth_affairs/rm/backend/allClients.php")
    .then((response) => response.json())
    .then((clients) => {
      console.log(clients); // log the data to the console in frontend
      // Define ClientsTable to display all registered clients using a custom HTMLElement class
        class Clients extends HTMLElement {
            connectedCallback() {
                // If there is no client registered, a feedback of 'string' data type is returned. 
                // If there is client, an object containing array of client is returned
                if (typeof clients == 'string'){
                    this.innerHTML = `
                    <div class="content">
                        NO CLIENT REGISTERED YET
                    </div>
                    `
                } else {
                    // map() is a javascript function used to iterate over each client inside the client array of clients
                    this.innerHTML = `
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
                                        ${clients
                                        .map(
                                            (client) =>
                                            `<tr>
                                                <td>${client.ClientID}</td>
                                                <td>${client.Firstname}</td>
                                                <td>${client.Lastname}</td>
                                                <td>${client.PhoneNo}</td>
                                                <td>${client.Email}</td>
                                                <td>${client.ClientCountry}</td>
                                                <td><button class="view-client" data-id="${client.ClientID}">View Profile</button></td>
                                            </tr>`
                                        )
                                        .join("")  // join('') is used to join the array of HTML elements as a single string with no separator, effectively concatenating the elements together. 
                                    }
                                    </table>
                                </div>
                            `;

                    // Create a modal using the DOM to show the profile details of each client when they are clicked
                    const modal = document.createElement("div");
                    modal.className = "modal";
                    modal.innerHTML = `
                            <div class="modal-content product-details">
                                <span class="close">&times;</span>
                                <div class="client-modal-content"></div>
                            </div>
                            `;

                    document.body.appendChild(modal);
                    const modalContent = modal.querySelector(".client-modal-content");
                    const closeModal = modal.querySelector(".close");
                    closeModal.onclick = function () {
                        modal.style.display = "none";
                    };

                    const viewClientProfile = this.querySelectorAll(".view-client");
                    console.log(viewClientProfile);
                    viewClientProfile.forEach((eachClient) => {
                        // forEach() iterates over each client details
                        eachClient.onclick = function () {
                            // Each client displayed on the browser has an id which is stored in the dataset on the browser DOM. 
                            // On clicking a specific client, the id is retrieved through dataset and stored in the variable clientId.
                        const clientId = eachClient.dataset.id;
                        console.log(clientId); // Logs the target client id
                        const targetClient = clients.find(
                            // This checks the list of all clients fetched from the database and find if the the selected clientID matches
                            // any of the ClientID received from the database.
                            (client) => client.ClientID == clientId
                            );
                            // If it matches, display the client details in a modal
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

                        modal.style.display = "block";
                        };
                    });
                }

            }
        }
      customElements.define("client-profile", Clients);
    })
    .catch((error) => console.error(error)); // Handles any error
});
