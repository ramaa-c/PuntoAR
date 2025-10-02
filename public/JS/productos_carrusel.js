        const carouselStates = {
            'personalizables': { currentPage: 0, itemsPerPage: 6, track: null, items: null, dots: null },
            'magicas': { currentPage: 0, itemsPerPage: 6, track: null, items: null, dots: null }
        };

        function initializeProductCarousels() {
            const persTrack = document.getElementById('personalizables-track');
            if (persTrack) {
                carouselStates['personalizables'].track = persTrack;
                carouselStates['personalizables'].items = persTrack.querySelectorAll('.product-item-visible');
                carouselStates['personalizables'].dots = document.querySelectorAll('#personalizables-dots .dot');
                updateCarouselVisibility('personalizables');
                updateProductDots('personalizables');
            }

            const magicasTrack = document.getElementById('magicas-track');
            if (magicasTrack) {
                carouselStates['magicas'].track = magicasTrack;
                carouselStates['magicas'].items = magicasTrack.querySelectorAll('.product-item-visible');
                carouselStates['magicas'].dots = document.querySelectorAll('#magicas-dots .dot');
                updateCarouselVisibility('magicas');
                updateProductDots('magicas');
            }
        }

        function updateCarouselVisibility(id) {
            const state = carouselStates[id];
            const totalPages = Math.ceil(state.items.length / state.itemsPerPage);
            const wrapper = document.getElementById(id + '-wrapper');
            
            if (wrapper) {
                const arrows = wrapper.querySelectorAll('.carousel-arrow');
                const dotsContainer = document.getElementById(id + '-dots');
                
                if (totalPages <= 1) {
                    arrows.forEach(arrow => arrow.style.display = 'none');
                    if (dotsContainer) dotsContainer.style.display = 'none';
                } else {
                    arrows.forEach(arrow => arrow.style.display = 'flex');
                    if (dotsContainer) dotsContainer.style.display = 'block';
                }
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
                dot.classList.remove('active');
                if (index === state.currentPage) {
                    dot.classList.add('active');
                }
            });
        }