document.addEventListener("DOMContentLoaded", function () {
  if (!localStorage.getItem("modalShown")) {
    const modal = document.getElementById("modal");
    if (modal) {
      modal.style.display = "flex";
      localStorage.setItem("modalShown", "true");
    }
  }

  const closeBtn = document.getElementById("modal-close");
  if (closeBtn) {
    closeBtn.addEventListener("click", function () {
      document.getElementById("modal").style.display = "none";
    });
  }

  let slideIndex = 0;
  const slides = document.querySelectorAll(".slide");
  const prevBtn = document.querySelector(".prev");
  const nextBtn = document.querySelector(".next");
  const intervalTime = 30000;

  function showSlide(n) {
    if (slides.length === 0) return;

    if (n >= slides.length) slideIndex = 0;
    if (n < 0) slideIndex = slides.length - 1;

    slides.forEach(slide => {
      slide.style.display = "none";
    });

    slides[slideIndex].style.display = "block";
  }

  function nextSlide() {
    slideIndex++;
    showSlide(slideIndex);
  }

  function prevSlide() {
    slideIndex--;
    showSlide(slideIndex);
  }

  if (prevBtn) {
    prevBtn.addEventListener("click", function () {
      prevSlide();
      resetTimer();
    });
  }
  if (nextBtn) {
    nextBtn.addEventListener("click", function () {
      nextSlide();
      resetTimer();
    });
  }

  let slideTimer = setInterval(nextSlide, intervalTime);

  function resetTimer() {
    clearInterval(slideTimer);
    slideTimer = setInterval(nextSlide, intervalTime);
  }

  showSlide(slideIndex);

  const searchInput = document.querySelector('.search-bar input');
  const courseCards = document.querySelectorAll('.courses-grid .course-card');

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
