
// const buttons = document.querySelectorAll(".btn");
// const slides = document.querySelectorAll(".slide");

// buttons.forEach((button) => {
//   button.addEventListener("click", (e) => {
//   const calcNextSLide = e.target.id === "next" ? 1 : -1;
//   const slideActive = document.querySelector(".active");

//   let newIndex = calcNextSLide + [...slides].indexOf(slideActive);

// if(newIndex < 0) newIndex = [...slides].length - 1;
// if(newIndex >= [...slides].length) newIndex = 0;
// slides[newIndex].classList.add("active");
// slideActive.classList.remove("active");
// });
// });

// On récupère tous les boutons avec la classe .btn (précédent et suivant)
const buttons = document.querySelectorAll(".btn");

// On récupère toutes les images ou slides avec la classe .slide
const slides = document.querySelectorAll(".slide");

// Pour chaque bouton (précédent ou suivant)
buttons.forEach((button) => {
  button.addEventListener("click", function(event) {
    // On récupère la slide actuellement active
    const slideActive = document.querySelector(".active");

    // On convertit les slides en tableau et on récupère l’index de la slide active
    const currentIndex = Array.from(slides).indexOf(slideActive);

    let newIndex; // index de la nouvelle slide à activer

    // Si on a cliqué sur "suivant"
    if (event.target.id === "next") {
      newIndex = currentIndex + 1;
      // Si on dépasse la dernière image, on revient à la première
      if (newIndex >= slides.length) {
        newIndex = 0;
      }
    }

    // Si on a cliqué sur "précédent"
    if (event.target.id === "prev") {
      newIndex = currentIndex - 1;
      // Si on est avant la première image, on va à la dernière
      if (newIndex < 0) {
        newIndex = slides.length - 1;
      }
    }

    // On enlève la classe "active" de l'ancienne slide
    slideActive.classList.remove("active");

    // On ajoute la classe "active" à la nouvelle slide
    slides[newIndex].classList.add("active");
  });
});