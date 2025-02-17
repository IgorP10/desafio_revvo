document.addEventListener("DOMContentLoaded", function () {
  // Verifica se o modal já foi exibido
  if (!localStorage.getItem("modalShown")) {
    const modal = document.getElementById("modal");
    if (modal) {
      modal.style.display = "flex";
      localStorage.setItem("modalShown", "true");
    }
  }

  // Fecha o modal ao clicar no "X"
  const closeBtn = document.getElementById("modal-close");
  if (closeBtn) {
    closeBtn.addEventListener("click", function () {
      document.getElementById("modal").style.display = "none";
    });
  }

  // ===== SLIDESHOW - Ajuste: declarar as variáveis =====
  let slideIndex = 0; // Índice do slide atual
  const slides = document.querySelectorAll(".slide"); // Seleciona todos os slides
  const prevBtn = document.querySelector(".prev");    // Botão "anterior"
  const nextBtn = document.querySelector(".next");    // Botão "próximo"
  const intervalTime = 30000; // 30 segundos

  // Função para mostrar um slide específico
  function showSlide(n) {
    if (slides.length === 0) return; // Se não houver slides, sair

    // Ajustar slideIndex se passar do limite
    if (n >= slides.length) slideIndex = 0;
    if (n < 0) slideIndex = slides.length - 1;

    // Esconde todos os slides
    slides.forEach(slide => {
      slide.style.display = "none";
    });

    // Exibe o slide atual
    slides[slideIndex].style.display = "block";
  }

  // Próximo slide
  function nextSlide() {
    slideIndex++;
    showSlide(slideIndex);
  }

  // Slide anterior
  function prevSlide() {
    slideIndex--;
    showSlide(slideIndex);
  }

  // Se existirem botões de navegação, adiciona eventos
  if (prevBtn) {
    prevBtn.addEventListener("click", function () {
      prevSlide();
      resetTimer(); // opcional: reinicia o timer
    });
  }
  if (nextBtn) {
    nextBtn.addEventListener("click", function () {
      nextSlide();
      resetTimer();
    });
  }

  // Intervalo para trocar de slide automaticamente
  let slideTimer = setInterval(nextSlide, intervalTime);

  // Se quiser que clicar na seta reinicie o timer
  function resetTimer() {
    clearInterval(slideTimer);
    slideTimer = setInterval(nextSlide, intervalTime);
  }

  // Inicializa o primeiro slide
  showSlide(slideIndex);

  // ===== FILTRO DE CURSOS =====
  const searchInput = document.querySelector('.search-bar input');
  const courseCards = document.querySelectorAll('.courses-grid .course-card');

  // Filtrar em tempo real enquanto digita
  searchInput.addEventListener('input', function () {
    const searchTerm = searchInput.value.toLowerCase().trim();

    courseCards.forEach(card => {
      const title = card.querySelector('h3')?.textContent.toLowerCase() || '';
      const desc = card.querySelector('p')?.textContent.toLowerCase() || '';

      if (title.includes(searchTerm) || desc.includes(searchTerm)) {
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });
  });
});
