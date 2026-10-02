const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');
const menuToggle = document.getElementById('menu-toggle');

if (sidebar && overlay && menuToggle) {
	const setMenuOpen = (isOpen) => {
		sidebar.classList.toggle('-translate-x-full', !isOpen);
		overlay.classList.toggle('hidden', !isOpen);
		menuToggle.setAttribute('aria-expanded', String(isOpen));
		menuToggle.setAttribute('aria-label', isOpen ? 'Fermer le menu' : 'Ouvrir le menu');
	};

	menuToggle.addEventListener('click', () => {
		setMenuOpen(menuToggle.getAttribute('aria-expanded') !== 'true');
	});
	overlay.addEventListener('click', () => setMenuOpen(false));
	sidebar.querySelectorAll('a').forEach((link) => {
		link.addEventListener('click', () => setMenuOpen(false));
	});
	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape') setMenuOpen(false);
	});
}
