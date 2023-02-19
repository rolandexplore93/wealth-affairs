class Ideas extends HTMLElement {
    connectedCallback(){
        this.innerHTML = `
            <div id="ideas" class="tab__content" style="display: none;">
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
                    <tr>
                        <td>2/2/2023</td>
                        <td>Amazon.com, Inc</td>
                        <td>Equities</td>
                        <td>1 USD per 127.72 stocks</td>
                        <td>7/9/2023</td>
                        <td>1</td>
                        <td>Pending</td>
                        <td><button>View Idea</button></td>
                    </tr>
                    <tr>
                        <td>3/2/2023</td>
                        <td>Intellia Common Stock</td>
                        <td>Equities</td>
                        <td>1 USD per 57.53 stocks</td>
                        <td>9/9/2023</td>
                        <td>3</td>
                        <td>Created</td>
                        <td><button>View Idea</button></td>
                    </tr>
                    
                </table>
            </div>
        
        `
    }
}
customElements.define('ideas')