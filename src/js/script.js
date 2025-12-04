function showPage(page) {
    document.querySelectorAll('.page').forEach(p => p.classList.add('hidden'));

    document.getElementById(page).classList.remove('hidden');

    document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('bg-white/20'));
    
}

showPage('cours');


let butadd = document.querySelector("#addCours") ; 
let closmdol = document.querySelector("#clossmodal")

butadd.addEventListener("click" , () => {
    document.querySelector("#addcoursmodal").classList.remove("hidden") ;
})
closmdol.addEventListener("click" , () => {
    document.querySelector("#addcoursmodal").classList.add("hidden") ;
})