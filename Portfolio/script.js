const nextBtn = document.getElementById("next");
const prevBtn = document.getElementById("prev");
const firstSlide = document.querySelector(".header-container-inner");
const secondSlide = document.querySelector(".header-container-outer");
const dot1 = document.getElementById("dot1");
const dot2 = document.getElementById("dot2");
const contact = document.querySelector(".contact");
const modal = document.getElementById("modal");
const close = document.getElementById("close");

nextBtn.addEventListener("click", function () {
  firstSlide.classList.add("next");
  secondSlide.classList.add("active");
  dot2.classList.add("dot--fill");
  dot1.classList.remove("dot--fill");
});

prevBtn.addEventListener("click", function () {
  firstSlide.classList.remove("next");
  secondSlide.classList.remove("active");
  dot1.classList.add("dot--fill");
  dot2.classList.remove("dot--fill");
});

contact.addEventListener("click", function () {
  modal.classList.add("show-modal");
});

close.addEventListener("click", () => modal.classList.remove("show-modal"));

window.addEventListener("click", (e) =>
  e.target == modal ? modal.classList.remove("show-modal") : false
);
