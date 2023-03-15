// fetch('/Supporting-data-for-investment-idea-setup.csv')
//   .then(response => response.text())
//   .then(data => {
//     console.log(data);
//     const countries = data.split('\n');
//     // Remove the last empty row if necessary
//     if (countries[countries.length - 1] === '') {
//       countries.pop();
//     }
//     // Add the country names to the <select> element
//     const select = document.getElementById('country');
//     for (const country of countries) {
//       const option = document.createElement('option');
//       option.value = country;
//       option.textContent = country;
//       // select.appendChild(option);/
//     }
// });

// let productData;
// fetch('http://localhost/wealth-affairs/backend/product.php')
//   .then(response => response.json())
//   .then(data => {
//     // do something with the data
//   })
//   .catch(error => console.error(error));

