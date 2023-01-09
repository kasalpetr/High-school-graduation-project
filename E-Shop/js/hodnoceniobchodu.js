document.querySelectorAll(".hodnoceni").forEach((e,i)=>{
    e.addEventListener("click",(evt)=>{
        fetch('php/hodnoceniobchodu.php?hodnota=' + (i+1))
        .then(response => response.json())
        .then(data => {
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