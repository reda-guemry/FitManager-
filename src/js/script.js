function showPage(page) {
    document.querySelectorAll('.page').forEach(p => p.classList.add('hidden'));

    document.getElementById(page).classList.remove('hidden');

    document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('bg-white/20'));
    event.target.closest('a').classList.add('bg-white/20');
}

showPage('equipement');