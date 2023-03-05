// Prevent javascript code from loading until html code has been completely loaded
document.addEventListener('DOMContentLoaded', () => {
  
  const clients = [
    {
        id: '1112',
        firstname: 'John',
        lastname: 'Stones',
        phoneNumber: '0748596321',
        email: 'john@honf.com',
        country: 'United Kingdom',
    },
    {
        id: '1113',
        firstname: 'Scottish',
        lastname: 'Brat',
        phoneNumber: '0779593452',
        email: 'braty@mail.com',
        country: 'Scotland',
    },
    {
        id: '4112',
        firstname: 'Adebisi',
        lastname: 'Berry',
        phoneNumber: '23478696321',
        email: 'debisi@gmail.com',
        country: 'Nigeria',
    },
]

class Clients extends HTMLElement {
    connectedCallback(){
        this.innerHTML =
            `
                <div class="content">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                        ${clients.map(client => (
                            `<tr>
                                <td>${client.id}</td>
                                <td>${client.firstname}</td>
                                <td>${client.lastname}</td>
                                <td>${client.phoneNumber}</td>
                                <td>${client.email}</td>
                                <td>${client.country}</td>
                                <td><button onclick="alert('${client.country}')">View Profile</button></td>
                            </tr>`
                        ))
                        .join('')
                    }
                        
                    </table>
                </div>
            `
    }
}
customElements.define('client-profile', Clients);







});