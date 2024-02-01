const tabs = document.querySelectorAll('.tabs .tab');
const tabContents = document.querySelectorAll('.tab-content');

tabs[0].classList.add('active');
tabContents[0].style.display = "block";
tabs.forEach(tab => {
	tab.addEventListener('click', () => {
		const tabName = tab.getAttribute('data-tab');

		tabs.forEach(t => t.classList.remove('active'));
		tab.classList.add('active');

		tabContents.forEach(content => content.style.display = "none");
		document.getElementById(tabName).style.display = "block";
	});
});
