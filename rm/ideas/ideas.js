const ideas2 = [
    {
        dateCreated: '12/12/2022',
        instrumentName: 'Amazon.com, Inc',
        assetType: 'Derivatives',
        price: 1,
        currency: 'USD',
        stock: 127.72,
        closingDate: '01/05/2023',
        riskLevel: 4,
        status: 'pending'
    },
    {
        dateCreated: '1/12/2022',
        instrumentName: 'AWS NOX',
        assetType: 'Equities',
        price: 2,
        currency: 'USD',
        stock: 120,
        closingDate: '01/05/2023',
        riskLevel: 5,
        status: 'created'
    },
    {
        dateCreated: '11/12/2022',
        instrumentName: 'Apple',
        assetType: 'Bonds',
        price: 20,
        currency: 'GBP',
        stock: 10,
        closingDate: '21/05/2023',
        riskLevel: 2,
        status: 'created'
    },
]

class IdeasTable2 extends HTMLElement {
    connectedCallback(){
        this.innerHTML =
            `
                <div id="ideas" class="content" style="display: non;">
                    <table>
                        <tr>
                            <th>Date Created</th>
                            <th>Instrument Name</th>
                            <th>Asset Type</th>
                            <th>Offer</th>
                            <th>Closing Date</th>
                            <th>Risk level</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        ${ideas2.map(idea => (
                            `<tr>
                                <td>${idea.dateCreated}</td>
                                <td>${idea.instrumentName}</td>
                                <td>${idea.assetType}</td>
                                <td>${idea.price} ${idea.currency} per ${idea.stock} stocks</td>
                                <td>${idea.closingDate}</td>
                                <td>${idea.riskLevel}</td>
                                <td>${idea.status}</td>
                                <td><button onclick={alert('sss')}>View Idea</button></td>
                            </tr>`
                        ))
                        .join('')
                    }
                        
                    </table>
                </div>
            `
    }
}
customElements.define('ideas-project', IdeasTable2);


// `
//     <div id="ideas" class="tab__content" style="display: non;">
//         <table>
//             <tr>
//                 <th>Date Created</th>
//                 <th>Instrument Name</th>
//                 <th>Asset Type</th>
//                 <th>Offer</th>
//                 <th>Closing Date</th>
//                 <th>Risk level</th>
//                 <th>Status</th>
//                 <th>Action</th>
//             </tr>
//             <tr>
//                 <td>2/2/2023</td>
//                 <td>Amazon.com, Inc</td>
//                 <td>Equities</td>
//                 <td>1 USD per 127.72 stocks</td>
//                 <td>7/9/2023</td>
//                 <td>1</td>
//                 <td>Pending</td>
//                 <td><button>View Idea</button></td>
//             </tr>
//             <tr>
//                 <td>3/2/2023</td>
//                 <td>Intellia Common Stock</td>
//                 <td>Equities</td>
//                 <td>1 USD per 57.53 stocks</td>
//                 <td>9/9/2023</td>
//                 <td>3</td>
//                 <td>Created</td>
//                 <td><button onclick={alert('sss')}>View Idea</button></td>
//             </tr>
            
//         </table>
//     </div>

// `