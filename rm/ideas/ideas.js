// class IdeasTable2 extends HTMLElement {
//     connectedCallback(){
//         this.innerHTML =
//             `
//                 <div id="ideas" class="content" style="display: non;">
//                     <table>
//                         <tr>
//                             <th>Date Created</th>
//                             <th>Instrument Name</th>
//                             <th>Asset Type</th>
//                             <th>Offer</th>
//                             <th>Closing Date</th>
//                             <th>Risk level</th>
//                             <th>Status</th>
//                             <th>Action</th>
//                         </tr>
//                         ${ideas2.map(idea => (
//                             `<tr>
//                                 <td>${idea.dateCreated}</td>
//                                 <td>${idea.instrumentName}</td>
//                                 <td>${idea.assetType}</td>
//                                 <td>${idea.price} ${idea.currency} per ${idea.stock} stocks</td>
//                                 <td>${idea.closingDate}</td>
//                                 <td>${idea.riskLevel}</td>
//                                 <td>${idea.status}</td>
//                                 <td><button onclick={alert('sss')}>View Idea</button></td>
//                             </tr>`
//                         ))
//                         .join('')
//                     }
                        
//                     </table>
//                 </div>
//             `
//     }
// }
// customElements.define('ideas-project', IdeasTable2);