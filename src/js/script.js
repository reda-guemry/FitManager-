
let butadd = document.querySelector("#addCours") ; 
let closmdol = document.querySelector("#clossmodal") ; 
let tablecoour = document.querySelector("#tableuCours")

showPage('cours');

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
        let supprumerid = e.target.closest("[data-id]").dataset.id ;
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
                    <input type="hidden" id="edit-id" value="${data.id}">

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

    

}
