document.addEventListener('DOMContentLoaded', () => {
  const darkMode = document.querySelector('.dark-mode');

  if (darkMode) {
    let isDarkMode = localStorage.getItem('darkMode') === 'true';

    darkMode.addEventListener('click', () => {
      isDarkMode = !isDarkMode;
      localStorage.setItem('darkMode', isDarkMode);
      document.documentElement.classList.toggle('data-dark-mode', isDarkMode);
      darkMode.querySelector('.moon-icon').style.display = isDarkMode ? 'none' : 'block';
      darkMode.querySelector('.sun-icon').style.display = isDarkMode ? 'block' : 'none';
    });
  }
  if (localStorage.getItem('darkMode') === 'true') {
    document.documentElement.classList.add('data-dark-mode');
  }
});