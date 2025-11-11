const carouselStates = {};

function initializeProductCarousels() {
  const carousels = document.querySelectorAll(".product-carousel-visible");

  carousels.forEach((section) => {
    const wrapper = section.querySelector(".carousel-wrapper");
    if (!wrapper) return;

    const dynamicId = wrapper.id.replace("-wrapper", "");

    carouselStates[dynamicId] = {
      currentPage: 0,
      itemsPerPage: 6,
      track: null,
      items: null,
      dots: null,
    };

    const track = document.getElementById(dynamicId + "-track");
    const dotsContainer = document.getElementById(dynamicId + "-dots");

    if (track) {
      carouselStates[dynamicId].track = track;
      carouselStates[dynamicId].items = track.querySelectorAll(
        ".product-item-visible"
      );

      generateDots(dynamicId);

      carouselStates[dynamicId].dots = dotsContainer.querySelectorAll(".dot");

      updateCarouselVisibility(dynamicId);
      updateProductDots(dynamicId);
    }
  });
}

function generateDots(id) {
  const state = carouselStates[id];
  const totalPages = Math.ceil(state.items.length / state.itemsPerPage);
  const dotsContainer = document.getElementById(id + "-dots");

  if (!dotsContainer) return;

  dotsContainer.innerHTML = "";

  for (let i = 0; i < totalPages; i++) {
    const dot = document.createElement("span");
    dot.classList.add("dot");
    if (i === 0) {
      dot.classList.add("active");
    }
    dot.onclick = () => goToProductPage(id, i);
    dotsContainer.appendChild(dot);
  }
}

function goToProductPage(id, pageIndex) {
  const state = carouselStates[id];
  state.currentPage = pageIndex;

  const offset = -state.currentPage * 100;
  state.track.style.transform = `translateX(${offset}%)`;

  updateProductDots(id);
}

function updateCarouselVisibility(id) {
  const state = carouselStates[id];
  if (!state || !state.items) return;

  const section = document.querySelector(`[id="${id}-wrapper"]`)?.closest(".product-carousel-visible");
  if (!section) return;

  const arrows = section.querySelectorAll(".carousel-arrow");
  const dotsContainer = document.getElementById(id + "-dots");

  const totalItems = state.items.length;
  const totalPages = Math.ceil(totalItems / state.itemsPerPage);

  if (totalItems <= state.itemsPerPage) {
    arrows.forEach((arrow) => (arrow.style.display = "none"));
    if (dotsContainer) dotsContainer.style.display = "none";
    return;
  }

  if (totalPages > 1) {
    arrows.forEach((arrow) => (arrow.style.display = "flex"));
    if (dotsContainer) dotsContainer.style.display = "block";
  } else {
    arrows.forEach((arrow) => (arrow.style.display = "none"));
    if (dotsContainer) dotsContainer.style.display = "none";
  }
}


function moveProductCarousel(id, direction) {
  const state = carouselStates[id];
  const totalPages = Math.ceil(state.items.length / state.itemsPerPage);

  if (totalPages <= 1) return;

  state.currentPage += direction;

  if (state.currentPage < 0) {
    state.currentPage = totalPages - 1;
  } else if (state.currentPage >= totalPages) {
    state.currentPage = 0;
  }

  const offset = -state.currentPage * 100;
  state.track.style.transform = `translateX(${offset}%)`;

  updateProductDots(id);
}

function updateProductDots(id) {
  const state = carouselStates[id];
  if (!state.dots) return;

  state.dots.forEach((dot, index) => {
    dot.classList.remove("active");
    if (index === state.currentPage) {
      dot.classList.add("active");
    }
  });
}
