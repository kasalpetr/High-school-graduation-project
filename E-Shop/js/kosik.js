document.querySelectorAll(".pocetKosik").forEach((e,i)=>{
    e.addEventListener("input", (evt)=>{
        let novyPocet = +evt.target.value;
        ccstara = document.querySelectorAll(".celkemCena")[i].innerHTML;
        ccnova = novyPocet * (+document.querySelectorAll(".cenazaks")[i].innerHTML);
        document.querySelectorAll(".celkemCena")[i].innerHTML = ccnova;
        document.querySelector(".cenacelkemcelkem").innerHTML = +(document.querySelector(".cenacelkemcelkem").innerHTML) + (ccnova-ccstara);
    });
});