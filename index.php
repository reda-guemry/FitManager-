<?php
    include("src/php/connectbasddoner.php")
?>


<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="src/css/output.css">
    </head>

    <body>

        <main>
            <div class="flex">
            <aside class="w-64 bg-gradient-to-b from-indigo-600 to-purple-700 text-white min-h-screen fixed shadow-2xl">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-8">
                        <i class="fas fa-dumbbell text-3xl"></i>
                        <h1 class="text-2xl font-bold">GymManager</h1>
                    </div>
                    <nav class="space-y-2">
                        <a href="#" onclick="showPage('dashboard')" class="nav-link flex items-center gap-3 p-3 rounded-lg hover:bg-white/20 transition-all">
                            <i class="fas fa-chart-line"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="#" onclick="showPage('cours')" class="nav-link flex items-center gap-3 p-3 rounded-lg hover:bg-white/20 transition-all">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Cours</span>
                        </a>
                        <a href="#" onclick="showPage('equipement')" class="nav-link flex items-center gap-3 p-3 rounded-lg hover:bg-white/20 transition-all">
                            <i class="fas fa-tools"></i>
                            <span>Équipements</span>
                        </a>
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="ml-64 flex-1 p-8">
                <!-- Dashboard Page -->
                <div id="dashboard" class="page">
                    <h2 class="text-4xl font-bold text-gray-800 mb-8 flex items-center gap-3">
                        <i class="fas fa-chart-line text-indigo-600"></i>
                        Tableau de Bord
                    </h2>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white shadow-lg transform hover:scale-105 transition-transform">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-blue-100 text-sm font-medium mb-2">Total Cours</p>
                                    <p id="total-cours" class="text-4xl font-bold">0</p>
                                </div>
                                <i class="fas fa-graduation-cap text-5xl text-blue-300 opacity-50"></i>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white shadow-lg transform hover:scale-105 transition-transform">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-purple-100 text-sm font-medium mb-2">Total Équipements</p>
                                    <p id="total-equipements" class="text-4xl font-bold">0</p>
                                </div>
                                <i class="fas fa-dumbbell text-5xl text-purple-300 opacity-50"></i>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl p-6 text-white shadow-lg transform hover:scale-105 transition-transform">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-pink-100 text-sm font-medium mb-2">Catégories</p>
                                    <p id="total-categories" class="text-4xl font-bold">0</p>
                                </div>
                                <i class="fas fa-tags text-5xl text-pink-300 opacity-50"></i>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white shadow-lg transform hover:scale-105 transition-transform">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-green-100 text-sm font-medium mb-2">Participants Max</p>
                                    <p id="total-participants" class="text-4xl font-bold">0</p>
                                </div>
                                <i class="fas fa-users text-5xl text-green-300 opacity-50"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Charts -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Répartition des Cours</h3>
                            <canvas id="coursChart"></canvas>
                        </div>

                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">État des Équipements</h3>
                            <canvas id="equipementChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Cours Page -->
                <div id="cours" class="page hidden">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-4xl font-bold text-gray-800 flex items-center gap-3">
                            <i class="fas fa-calendar-alt text-indigo-600"></i>
                            Gestion des Cours
                        </h2>
                        <button id="addCours" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg flex items-center gap-2 shadow-lg transform hover:scale-105 transition-all">
                            <i class="fas fa-plus"></i>
                            Nouveau Cours
                        </button>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table id="tableuCours" class="w-full">
                                <thead class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
                                    <tr>
                                        <th class="px-6 py-4 text-left">Nom</th>
                                        <th class="px-6 py-4 text-left">Catégorie</th>
                                        <th class="px-6 py-4 text-left">Heure</th>
                                        <th class="px-6 py-4 text-left">Date</th>
                                        <th class="px-6 py-4 text-left">Durée (min)</th>
                                        <th class="px-6 py-4 text-left">Max Participants</th>
                                        <th class="px-6 py-4 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="cours-table-body" class="divide-y divide-gray-200">
                                    <?php while ($courrentrow = $cours -> fetch_assoc()){   ?> 
                                        <tr>
                                            <td class="px-6 py-4 text-left font-bold"><?= $courrentrow['nom'] ?></td>
                                            <td class="px-6 py-4 text-left font-bold"><?= $courrentrow['categorie'] ?></td>
                                            <td class="px-6 py-4 text-left font-bold"><?= $courrentrow['heure'] ?></td>
                                            <td class="px-6 py-4 text-left font-bold"><?= $courrentrow['date'] ?></td>
                                            <td class="px-6 py-4 text-left font-bold"><?= $courrentrow['duree'] ?></td>
                                            <td class="px-6 py-4 text-left font-bold"><?= $courrentrow['max_participants'] ?></td>
                                            <td class="px-6 py-4 text-left font-bold">
                                                <svg xmlns="http://www.w3.org/2000/svg" data-id="<?= $courrentrow['id'] ?>" class="modifier size-5 cursor-pointer" viewBox="0 0 26 26">
                                                    <path fill="#000000" d="M20.094.25a2.245 2.245 0 0 0-1.625.656l-1 1.031l6.593 6.625l1-1.03a2.319 2.319 0 0 0 0-3.282L21.75.937A2.36 2.36 0 0 0 20.094.25zm-3.75 2.594l-1.563 1.5l6.875 6.875L23.25 9.75l-6.906-6.906zM13.78 5.438L2.97 16.155a.975.975 0 0 0-.5.625L.156 24.625a.975.975 0 0 0 1.219 1.219l7.844-2.313a.975.975 0 0 0 .781-.656l10.656-10.563l-1.468-1.468L8.25 21.813l-4.406 1.28l-.938-.937l1.344-4.593L15.094 6.75L13.78 5.437zm2.375 2.406l-10.968 11l1.593.343l.219 1.47l11-10.97l-1.844-1.843z"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" data-id="<?= $courrentrow['id'] ?>" class="supprumer size-5 cursor-pointer" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19.5 5.5l-.62 10.025c-.158 2.561-.237 3.842-.88 4.763a4 4 0 0 1-1.2 1.128c-.957.584-2.24.584-4.806.584c-2.57 0-3.855 0-4.814-.585a4 4 0 0 1-1.2-1.13c-.642-.922-.72-2.205-.874-4.77L4.5 5.5M3 5.5h18m-4.944 0l-.683-1.408c-.453-.936-.68-1.403-1.071-1.695a2 2 0 0 0-.275-.172C13.594 2 13.074 2 12.035 2c-1.066 0-1.599 0-2.04.234a2 2 0 0 0-.278.18c-.395.303-.616.788-1.058 1.757L8.053 5.5m1.447 11v-6m5 6v-6" color="currentColor"/>
                                                </svg>
                                            </td>
                                            
                                        </tr>
                                    <?php } ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Equipement Page -->
                <div id="equipement" class="page hidden">
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="text-4xl font-bold text-gray-800 flex items-center gap-3">
                            <i class="fas fa-tools text-purple-600"></i>
                            Gestion des Équipements
                        </h2>
                        <button onclick="openModal('equipement')" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg flex items-center gap-2 shadow-lg transform hover:scale-105 transition-all">
                            <i class="fas fa-plus"></i>
                            Nouvel Équipement
                        </button>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gradient-to-r from-purple-600 to-pink-600 text-white">
                                    <tr>
                                        <th class="px-6 py-4 text-left">ID</th>
                                        <th class="px-6 py-4 text-left">Nom</th>
                                        <th class="px-6 py-4 text-left">Type</th>
                                        <th class="px-6 py-4 text-left">Quantité</th>
                                        <th class="px-6 py-4 text-left">État</th>
                                        <th class="px-6 py-4 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="equipement-table-body" class="divide-y divide-gray-200">
                                    <?php while ($courrentequi = $equipement -> fetch_assoc()) { ?>
                                        
                                        <tr>
                                            <th class="px-6 py-4 text-left"><?= $courrentequi["id"] ?></th>
                                            <th class="px-6 py-4 text-left"><?= $courrentequi["nom"] ?></th>
                                            <th class="px-6 py-4 text-left"><?= $courrentequi["type"] ?></th>
                                            <th class="px-6 py-4 text-left"><?= $courrentequi["quuantiter"] ?></th>
                                            <th class="px-6 py-4 text-left"><?= $courrentequi["etat"] ?></th>
                                            <td class="px-6 py-4 text-left font-bold">
                                                <svg xmlns="http://www.w3.org/2000/svg" class=" size-5 cursor-pointer" viewBox="0 0 26 26">
                                                    <path fill="#000000" d="M20.094.25a2.245 2.245 0 0 0-1.625.656l-1 1.031l6.593 6.625l1-1.03a2.319 2.319 0 0 0 0-3.282L21.75.937A2.36 2.36 0 0 0 20.094.25zm-3.75 2.594l-1.563 1.5l6.875 6.875L23.25 9.75l-6.906-6.906zM13.78 5.438L2.97 16.155a.975.975 0 0 0-.5.625L.156 24.625a.975.975 0 0 0 1.219 1.219l7.844-2.313a.975.975 0 0 0 .781-.656l10.656-10.563l-1.468-1.468L8.25 21.813l-4.406 1.28l-.938-.937l1.344-4.593L15.094 6.75L13.78 5.437zm2.375 2.406l-10.968 11l1.593.343l.219 1.47l11-10.97l-1.844-1.843z"/>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" class=" size-5 cursor-pointer" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m19.5 5.5l-.62 10.025c-.158 2.561-.237 3.842-.88 4.763a4 4 0 0 1-1.2 1.128c-.957.584-2.24.584-4.806.584c-2.57 0-3.855 0-4.814-.585a4 4 0 0 1-1.2-1.13c-.642-.922-.72-2.205-.874-4.77L4.5 5.5M3 5.5h18m-4.944 0l-.683-1.408c-.453-.936-.68-1.403-1.071-1.695a2 2 0 0 0-.275-.172C13.594 2 13.074 2 12.035 2c-1.066 0-1.599 0-2.04.234a2 2 0 0 0-.278.18c-.395.303-.616.788-1.058 1.757L8.053 5.5m1.447 11v-6m5 6v-6" color="currentColor"/>
                                                </svg>
                                            </td>
                                        </tr>

                                    <?php } ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>

       <!-- Modal Edit Cours -->
        <div id="addcoursmodal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center z-50">
            <div class="bg-white w-1/2 ax-w-lg rounded-2xl shadow-2xl p-8 relative">

                <!-- Close Button -->
                <button id="clossmodal"  class="absolute top-4 right-4 text-gray-500 hover:text-red-600 text-2xl cursor-pointer">
                    &times;
                </button>

                <h2 class="text-2xl font-bold mb-6 text-indigo-700 flex items-center gap-2">
                    <i class="fas fa-edit"></i> add new cour
                </h2>

                <form id="editCoursForm" method="post" action="src/php/ajouter.php" >

                    <label class="block mb-2 font-semibold text-gray-700">name</label>
                    <input id="edit-nom" name="nom" type="text" class="w-full mb-4 p-3 rounded-lg border focus:ring-2 focus:ring-indigo-600">

                    <label class="block mb-2 font-semibold text-gray-700">Catégorie</label>
                    <input id="edit-categorie" name="categorie" type="text" class="w-full mb-4 p-3 rounded-lg border focus:ring-2 focus:ring-indigo-600">

                    <label class="block mb-2 font-semibold text-gray-700">Heure</label>
                    <input id="edit-heure" name="heure" type="time" class="w-full mb-4 p-3 rounded-lg border focus:ring-2 focus:ring-indigo-600">

                    <label class="block mb-2 font-semibold text-gray-700">Date</label>
                    <select class="w-full p-2 border rounded-lg" name="day" id="day">
                        <option value="" >Select a day</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>

                    <label class="block mb-2 font-semibold text-gray-700">Durée (min)</label>
                    <input id="edit-duree" name="duree" type="number" class="w-full mb-4 p-3 rounded-lg border focus:ring-2 focus:ring-indigo-600">

                    <label class="block mb-2 font-semibold text-gray-700">Max Participants</label>
                    <input id="edit-max" name="number" type="number" class="w-full mb-6 p-3 rounded-lg border focus:ring-2 focus:ring-indigo-600">

                    <button type="submit" name="addcours"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-xl font-semibold transition-all"> Add 
                    </button>

                </form>
            </div>
             
        </main>


    <script src="src/js/script.js"></script>
    </body>

</html>