        const bannerTrack = document.querySelector('.carousel-track');
        const bannerSlides = Array.from(bannerTrack.children);
        const bannerPrev = document.querySelector('.prev');
        const bannerNext = document.querySelector('.next');

        let bannerCurrentIndex = 1;
        let bannerIsTransitioning = false;

        const firstClone = bannerSlides[0].cloneNode(true);
        const lastClone = bannerSlides[bannerSlides.length - 1].cloneNode(true);

        firstClone.id = "first-clone";
        lastClone.id = "last-clone";

        bannerTrack.appendChild(firstClone);
        bannerTrack.insertBefore(lastClone, bannerSlides[0]);

        const bannerAllSlides = Array.from(bannerTrack.children);

        bannerTrack.style.transform = `translateX(-${bannerCurrentIndex * 100}%)`;

        function updateBannerCarousel() {
        if (bannerIsTransitioning) return;
        bannerIsTransitioning = true;

        bannerTrack.style.transition = "transform 0.5s ease-in-out";
        bannerTrack.style.transform = `translateX(-${bannerCurrentIndex * 100}%)`;
        }

        bannerTrack.addEventListener("transitionend", () => {
        if (bannerAllSlides[bannerCurrentIndex].id === "first-clone") {
            bannerTrack.style.transition = "none";
            bannerCurrentIndex = 1; 
            bannerTrack.style.transform = `translateX(-${bannerCurrentIndex * 100}%)`;
        }
        if (bannerAllSlides[bannerCurrentIndex].id === "last-clone") {
            bannerTrack.style.transition = "none";
            bannerCurrentIndex = bannerAllSlides.length - 2;
            bannerTrack.style.transform = `translateX(-${bannerCurrentIndex * 100}%)`;
        }
        bannerIsTransitioning = false;
        });

        const bannerAutoPlayInterval = 8000;
        setInterval(() => {
        if (!bannerIsTransitioning) {
            bannerCurrentIndex++;
            updateBannerCarousel();
        }
        }, bannerAutoPlayInterval);

        bannerPrev.addEventListener('click', () => {
        if (bannerIsTransitioning) return;
        bannerCurrentIndex--;
        updateBannerCarousel();
        });

        bannerNext.addEventListener('click', () => {
        if (bannerIsTransitioning) return;
        bannerCurrentIndex++;
        updateBannerCarousel();
        });