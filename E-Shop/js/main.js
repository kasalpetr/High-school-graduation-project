document.querySelectorAll(".zrusitodkaz").forEach((e)=>{
e.addEventListener("click",(evt)=>{
    evt.preventDefault();

})
});

document.querySelectorAll(".oblibeny_produkt_button").forEach(e=>{
  e.addEventListener("click", () => {

        fetch('php/oblibeny.php?id='+ e.getAttribute("id"))
            .then(response => response.json())
            .then(data => {
                if (!data) {
                    alert("Pro přidaní do oblíbených produktů se přihlaš.");
                    
                }else{
                    if (data == true) {
                        e.style.color = "red";
                    }    else{
                        e.style.color = "#DDE74B";
                    }
                    // console.log(data);
                }
            });
    });
});


document.querySelectorAll(".fa-trash-can").forEach((e)=>{

    e.addEventListener("click",(evt)=>{
        fetch('php/odebratkomentar.php?id='+ e.getAttribute("id"))
        .then(response => response.json())
        .then(data => {
                // console.log(data);
                if (data == "true") {
                    
                    e.parentElement.parentElement.outerHTML = "";
                }
            
        });
    });
});

document.querySelectorAll(".hodnoceni").forEach((e,i)=>{

    e.addEventListener("click",(evt)=>{
        fetch('php/hodnoceni.php?idproduktu='+ document.querySelector("body").getAttribute("id")+"&hodnota="+(i+1))
        .then(response => response.json())
        .then(data => {
                // console.log(data == "true");
                if (data == "true") {
                    document.querySelectorAll(".hodnoceni").forEach((hvezda,index) =>{
                        hvezda.style.color = "black";
                        if (i >= index) {
                            
                            hvezda.style.color = "yellow";
                        }
                    });
                    console.log(e);
                }
            
        });
    });
});


document.querySelectorAll(".produkt_do_kosiku_button").forEach(e=>{
    e.addEventListener("click", () => {
  
          fetch('php/kosik.php?id='+ e.getAttribute("id"))
              .then(response => response.json())
              .then(data => {
                  console.log(data);
              
                  if (data == "false") {
                      alert("Něco se nepovedlo");
                      
                  }else{
                  
                      document.querySelector("#kosik_pocet").innerHTML=(data);
                  }
                  
              });
      });
  });
  document.querySelectorAll(".cross").forEach(e=>{
    e.addEventListener("click", evt=>{
        fetch('php/deleteprodukt.php?id='+ e.getAttribute("id"))
        .then(response => response.json())
        .then(data => {
            console.log(data);
        
            if (data != "delete") {
                alert("Něco se nepovedlo");
            }else{
                window.location = "Main.php";
            }
            
        });
    }); 
  });