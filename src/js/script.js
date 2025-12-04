
let butadd = document.querySelector("#addCours") ; 
let closmdol = document.querySelector("#clossmodal") ; 
let tablecoour = document.querySelector("#tableuCours")

showPage('dashboard');

function showPage(page) {
    document.querySelectorAll('.page').forEach(p => p.classList.add('hidden'));

    document.getElementById(page).classList.remove('hidden');

    document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('bg-white/20'));
    
}

butadd.addEventListener("click" , () => {
    document.querySelector("#addcoursmodal").classList.remove("hidden") ;
})
closmdol.addEventListener("click" , () => {
    document.querySelector("#addcoursmodal").classList.add("hidden") ;
})

tablecoour.addEventListener("click" , (e) => {
    if(e.target.closest(".modifier")){
        let modifId = e.target.closest("[data-id]").dataset.id ;

        fetch("src/php/modifier.php" ,  {
            method : "POST" ,
            headers : {"Content-Type" : "application/x-www-form-urlencoded"},
            body : "id=" + modifId 
        })
            .then(res => res.json()) 
            .then(repon => createEditModal(repon)  )
            .catch(error => console.log(error)) 
             
    }else if (e.target.closest(".supprumer")){
        let supprumerid = e.target.closest("[data-id]").dataset.id;

        let conf = confirm("Are you sure you want to delete this course?");

        if(conf) {
            deletcours(supprumerid)
            
        }
    }
})




// Function to create edit modal dynamically
function createEditModal(data) {
    // Remove existing edit modal if any
    const existingModal = document.querySelector("#editcoursmodal");
    if (existingModal) {
        existingModal.remove();
    }

    // Create modal HTML
    const modalHTML = `
        <div id="editcoursmodal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
            <div class="bg-white w-1/2 max-w-lg rounded-2xl shadow-2xl p-8 relative">
                
                <!-- Close Button -->
                <button id="closeEditModal" class="absolute top-4 right-4 text-gray-500 hover:text-red-600 text-2xl cursor-pointer">
                    &times;
                </button>

                <h2 class="text-2xl font-bold mb-6 text-indigo-700 flex items-center gap-2">
                    <i class="fas fa-edit"></i> Modifier le cours
                </h2>

                <form id="editCoursForm">
                    <input type="hidden" id="edit-id" name="id" value="${data.id}">

                    <label class="block mb-2 font-semibold text-gray-700">Nom</label>
                    <input id="edit-nom" name="nom" type="text" value="${data.nom}" 
                           class="w-full mb-4 p-3 rounded-lg border focus:ring-2 focus:ring-indigo-600">

                    <label class="block mb-2 font-semibold text-gray-700">Catégorie</label>
                    <input id="edit-categorie" name="categorie" type="text" value="${data.categorie}" 
                           class="w-full mb-4 p-3 rounded-lg border focus:ring-2 focus:ring-indigo-600">

                    <label class="block mb-2 font-semibold text-gray-700">Heure</label>
                    <input id="edit-heure" name="heure" type="time" value="${data.heure}" 
                           class="w-full mb-4 p-3 rounded-lg border focus:ring-2 focus:ring-indigo-600">

                    <label class="block mb-2 font-semibold text-gray-700">Date</label>
                    <select class="w-full mb-4 p-3 border rounded-lg focus:ring-2 focus:ring-indigo-600" name="day" id="edit-day">
                        <option value="">Select a day</option>
                        <option value="Monday" ${data.day === 'Monday' ? 'selected' : ''}>Monday</option>
                        <option value="Tuesday" ${data.day === 'Tuesday' ? 'selected' : ''}>Tuesday</option>
                        <option value="Wednesday" ${data.day === 'Wednesday' ? 'selected' : ''}>Wednesday</option>
                        <option value="Thursday" ${data.day === 'Thursday' ? 'selected' : ''}>Thursday</option>
                        <option value="Friday" ${data.day === 'Friday' ? 'selected' : ''}>Friday</option>
                        <option value="Saturday" ${data.day === 'Saturday' ? 'selected' : ''}>Saturday</option>
                        <option value="Sunday" ${data.day === 'Sunday' ? 'selected' : ''}>Sunday</option>
                    </select>

                    <label class="block mb-2 font-semibold text-gray-700">Durée (min)</label>
                    <input id="edit-duree" name="duree" type="number" value="${data.duree}" 
                           class="w-full mb-4 p-3 rounded-lg border focus:ring-2 focus:ring-indigo-600">

                    <label class="block mb-2 font-semibold text-gray-700">Max Participants</label>
                    <input id="edit-max" name="number" type="number" value="${data.max_participants || data.number}" 
                           class="w-full mb-6 p-3 rounded-lg border focus:ring-2 focus:ring-indigo-600">

                    <div class="flex gap-4">
                        <button type="submit" 
                                class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold transition-all">
                            Enregistrer
                        </button>
                        <button type="button" id="cancelEdit" 
                                class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 py-3 rounded-xl font-semibold transition-all">
                            Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    `;

    // Insert modal into body
    document.body.insertAdjacentHTML('beforeend', modalHTML);

    // Add event listeners for the new modal
    const editModal = document.querySelector("#editcoursmodal");
    const closeBtn = document.querySelector("#closeEditModal");
    const cancelBtn = document.querySelector("#cancelEdit");
    const editForm = document.querySelector("#editCoursForm");

    // Close modal function
    const closeModal = () => {
        editModal.remove();
    };

    closeBtn.addEventListener("click", closeModal);
    cancelBtn.addEventListener("click", closeModal);

    editForm.addEventListener("submit" , (e) => {

        e.preventDefault() ; 

        const formData = new FormData(editForm);


        const datamodifier = Object.fromEntries(formData);

        fetch("src/php/modifieronbasddoner.php" , {
            method : "POST",
            headers : {"Content-Type" : "application/json"},
            body : JSON.stringify({ newdata : datamodifier })
        }) 
            .then(res => res.json())
            .then(newdata => {
                console.log(newdata) ;
                let row = document.querySelector(`[data-id='${newdata.id}']`)
                if(row) {
                    row.innerHTML = ``
                    row.innerHTML = `
                        <td class="px-6 py-4 text-left font-bold"> ${newdata.nom} </td>
                        <td class="px-6 py-4 text-left font-bold"> ${newdata.categorie} </td>
                        <td class="px-6 py-4 text-left font-bold"> ${newdata.heure} </td>
                        <td class="px-6 py-4 text-left font-bold"> ${newdata.date} </td>
                        <td class="px-6 py-4 text-left font-bold"> ${newdata.duree} </td>
                        <td class="px-6 py-4 text-left font-bold"> ${newdata.max_participants} </td>
                        <td class="px-6 py-4 text-left font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" data-id="${newdata.id}" class="modifier size-5 cursor-pointer" viewBox="0 0 26 26">
                                <path fill="#000000" d="M20.094.25a2.245 2.245 0 0 0-1.625.656l-1 1.031l6.593 6.625l1-1.03a2.319 2.319 0 0 0 0-3.282L21.75.937A2.36 2.36 0 0 0 20.094.25zm-3.75 2.594l-1.563 1.5l6.875 6.875L23.25 9.75l-6.906-6.906zM13.78 5.438L2.97 16.155a.975.975 0 0 0-.5.625L.156 24.625a.975.975 0 0 0 1.219 1.219l7.844-2.313a.975.975 0 0 0 .781-.656l10.656-10.563l-1.468-1.468L8.25 21.813l-4.406 1.28l-.938-.937l1.344-4.593L15.094 6.75L13.78 5.437zm2.375 2.406l-10.968 11l1.593.343l.219 1.47l11-10.97l-1.844-1.843z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" data-id="<?= $courrentrow['id'] ?>" class="supprumer size-5 cursor-pointer" viewBox="0 0 24 24">
                                <path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19.5 5.5l-.62 10.025c-.158 2.561-.237 3.842-.88 4.763a4 4 0 0 1-1.2 1.128c-.957.584-2.24.584-4.806.584c-2.57 0-3.855 0-4.814-.585a4 4 0 0 1-1.2-1.13c-.642-.922-.72-2.205-.874-4.77L4.5 5.5M3 5.5h18m-4.944 0l-.683-1.408c-.453-.936-.68-1.403-1.071-1.695a2 2 0 0 0-.275-.172C13.594 2 13.074 2 12.035 2c-1.066 0-1.599 0-2.04.234a2 2 0 0 0-.278.18c-.395.303-.616.788-1.058 1.757L8.053 5.5m1.447 11v-6m5 6v-6" color="currentColor"/>
                            </svg>
                        </td>               
                    `
                }
                closeModal() ;
                
            })
            .catch(error => console.error(error))
    })

}


function deletcours(id) {
    fetch("src/php/deelete.php" , {
        method : "POST" , 
        headers : {"Content-Type" : "application/x-www-form-urlencoded"} ,
        body : "id=" + id
    })
        .then(rep => rep.text())
        .then(data => {
            console.log(data)
            document.querySelector(`[data-id='${id}']`).remove() ; 
        })
        .catch(error => console.error(error))
}