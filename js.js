async function naloziPodatke() {
  const request = new Request(
    "https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&order=market_cap_desc&per_page=100&page=1&sparkline=false"
  );

  const url = request.url;
  const method = request.method;
  const credentials = request.credentials;

  fetch(request)
    .then((response) => response.json())
    .then((dataa) => {
      data_to_get = [
        "market_cap_rank",
        "id",
        "current_price",
        "image" /*,"market_cap"*/,
      ];

      const table = document.getElementById("tabela");
      tr_m = document.createElement("tr");
      for (let i = 0; i < data_to_get.length; i++) {
        let td = tr_m.appendChild(document.createElement("td"));
        td.innerHTML =
          i == 0
            ? "ID"
            : i == 1
            ? "Name"
            : i == 2
            ? "Price (€) "
            : i == 3
            ? "Logo"
            : data_to_get[i].toUpperCase();
      }

      table.appendChild(tr_m);
      let st_kovancev = 15;
      for (let i = 0; i < st_kovancev; i++) {
        /*for (const property in data[i]) {
                console.log(`${property}: ${data[i][property]}`);
                stolpec += data[i][property]
            }*/

        let tr = document.createElement("tr");
        for (const property of data_to_get) {
          if (property == "image") {
            let td = tr.appendChild(document.createElement("td"));
            td.innerHTML = `<a href="https://www.coingecko.com/en/coins/${dataa[i].id}" ><img src="${dataa[i][property]}"></a>  `;
          } else {
            let td = tr.appendChild(document.createElement("td"));

            td.innerHTML =
              typeof dataa[i][property] === "string"
                ? capitalizeFirstLetter(dataa[i][property])
                : dataa[i][property];
          }
        }
        table.appendChild(tr);
      }

      //loader()
    });
  naloziIdje();
}

function capitalizeFirstLetter(string) {
  // vzame string in prvi char nastavi na upper in pristeje ostale znake stringa
  return string.charAt(0).toUpperCase() + string.slice(1);
}

let id_data = [];
async function naloziIdje() {
  console.log(data);
}


function bscry() {
  let amount = document.getElementById("amount").value;
  let var2 = document.getElementById("cryptocurrency").value;
   fetch(
    `https://api.coingecko.com/api/v3/coins/${var2}?tickers=true&market_data=true&community_data=true&developer_data=true&sparkline=true`
  )
    .then((response) => response.json())
    .then((data) => {
      const price_of_coin = data["market_data"]["current_price"]["eur"];
      const value = price_of_coin * amount;
      document.getElementById("prices").innerHTML = value;
    })
    .catch((error) => console.error(error));
}

function cry (nakup_bool){
  const date = new Date()
  
  const id = JSON.parse(localStorage.getItem('object')).id;
  alert(id)
  let obj = {
    name:document.getElementById("cryptocurrency").value,
    amount:document.getElementById("amount").value,
    current_price:document.getElementById("prices").innerHTML/document.getElementById("amount").value,
    time_of_purchase:date,
    nakup:nakup_bool,
    user_id : id

  };
  console.table(obj);
  alert()
  
  
  fetch('https://dsr.feri.um.si/web/saso_krepek/nakup.php', {
  method: 'POST',
  body: JSON.stringify(obj),
  headers: {
    'Content-Type': 'application/json'
  }
})
  .then(response => response.json())
  .then(data => {
    console.log(data);
    // Perform additional tasks here
    // ...
  });
  
 
}







function registracija(){
    const name = document.getElementById("signup-name").value;
  const mail = document.getElementById("signup-email").value;
  let pass1 = document.getElementById("signup-password").value;
  let pass2 = document.getElementById("signup-password-confirm").value;
  if (pass1 === pass2)
  {
    document.getElementById("signup-error").innerHTML = "";
    const telo  ={email: mail,password:pass1,name:name}
   
  ;
fetch('https://dsr.feri.um.si/web/saso_krepek/registration.php', {
method: 'POST',
body:  JSON.stringify(telo),
headers: {
'Content-Type': 'application/json'
}
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error(error))

  }
  else {
    document.getElementById("signup-error").innerHTML = "Passwords do not match! Please try again.";    
  }
}




function prijava(){
  let obj = {
    email:document.getElementById("signin-email").value, 
    password : document.getElementById("signin-password").value
  };
  

  fetch('https://dsr.feri.um.si/web/saso_krepek/prijava.php', {
    method: 'POST',
    body:  JSON.stringify(obj),
    headers: {
    'Content-Type': 'application/json'
    }
    })
    .then(response => response.json())
.then(data => {
    alert("prijava");
    localStorage.setItem('object', JSON.stringify(data));
    
})
.catch(error => console.error(error))


}










