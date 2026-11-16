import { compressReceiptImage } from './image-compressor';

document.querySelectorAll('[data-receipt-form]').forEach((form) => {
    const receiptInput = form.querySelector('[data-receipt-input]');
    const compressionStatus = form.querySelector('[data-receipt-compression-status]');
    let compressionPromise = null;
    let resubmittingAfterCompression = false;

    if (!receiptInput || !compressionStatus) {
        return;
    }

    receiptInput.addEventListener('change', () => {
        const [selectedFile] = receiptInput.files ?? [];

        if (!selectedFile) {
            compressionStatus.classList.add('hidden');

            return;
        }

        compressionStatus.classList.remove('hidden');
        compressionStatus.textContent = 'Memeriksa ukuran foto notaâ€¦';

        compressionPromise = compressReceiptImage(selectedFile)
            .then((compressedFile) => {
                if (compressedFile !== selectedFile) {
                    const transfer = new DataTransfer();
                    transfer.items.add(compressedFile);
                    receiptInput.files = transfer.files;
                    compressionStatus.textContent = 'Ukuran foto nota sudah diperkecil.';

                    return;
                }

                compressionStatus.textContent = 'Foto nota siap diunggah.';
            })
            .catch(() => {
                compressionStatus.textContent = 'Foto tidak dapat diproses. Pilih berkas JPG, PNG, atau WebP hingga 2 MB.';
            })
            .finally(() => {
                compressionPromise = null;
            });
    });

    form.addEventListener('submit', async (event) => {
        if (compressionPromise === null) {
            resubmittingAfterCompression = false;

            return;
        }

        event.preventDefault();

        if (resubmittingAfterCompression) {
            return;
        }

        resubmittingAfterCompression = true;
        await compressionPromise;
        form.requestSubmit(event.submitter);
    });
});

document.querySelectorAll('[data-feature-carousel]').forEach((carousel) => {
    const viewport = carousel.querySelector('[data-carousel-viewport]');
    const track = carousel.querySelector('.feature-carousel-track');
    const originalSlides = Array.from(carousel.querySelectorAll('[data-carousel-slide]'));
    const previousButton = carousel.querySelector('[data-carousel-previous]');
    const nextButton = carousel.querySelector('[data-carousel-next]');
    const toggleButton = carousel.querySelector('[data-carousel-toggle]');
    const slideCount = originalSlides.length;

    if (!viewport || !track || slideCount !== 4 || !previousButton || !nextButton || !toggleButton) {
        console.error('The Munyopir feature carousel markup is incomplete.');

        return;
    }

    const cloneSlides = () => originalSlides.map((slide) => {
        const clone = slide.cloneNode(true);

        clone.setAttribute('aria-hidden', 'true');

        return clone;
    });

    track.prepend(...cloneSlides());
    track.append(...cloneSlides());

    const slides = Array.from(track.querySelectorAll('[data-carousel-slide]'));
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let activeIndex = slideCount;
    let intervalId = null;
    let scrollTimeoutId = null;
    let isPaused = prefersReducedMotion;
    let isHovered = false;
    let hasFocus = false;
    let isTouching = false;

    const updateCarouselState = () => {
        slides.forEach((slide, slideIndex) => {
            const relativeIndex = (slideIndex - activeIndex + slides.length) % slides.length;
            let position = 'far';

            if (relativeIndex === 0) {
                position = 'active';
            } else if (relativeIndex === 1) {
                position = 'next';
            } else if (relativeIndex === slides.length - 1) {
                position = 'previous';
            }

            slide.dataset.carouselPosition = position;
        });
    };

    const setActiveIndex = (index) => {
        activeIndex = (index + slides.length) % slides.length;
        updateCarouselState();
    };

    const scrollToSlide = (index, behavior = (prefersReducedMotion ? 'auto' : 'smooth')) => {
        setActiveIndex(index);

        const viewportRect = viewport.getBoundingClientRect();
        const slideRect = slides[activeIndex].getBoundingClientRect();
        const viewportCenter = viewportRect.left + viewport.clientWidth / 2;
        const slideCenter = slideRect.left + slideRect.width / 2;

        viewport.scrollTo({
            left: viewport.scrollLeft + slideCenter - viewportCenter,
            behavior,
        });
    };

    const centerSlideWithoutAnimation = (index) => {
        const viewportRect = viewport.getBoundingClientRect();
        const slideRect = slides[index].getBoundingClientRect();
        const viewportCenter = viewportRect.left + viewport.clientWidth / 2;
        const slideCenter = slideRect.left + slideRect.width / 2;

        viewport.scrollTo({
            left: viewport.scrollLeft + slideCenter - viewportCenter,
            behavior: 'auto',
        });
    };

    const stop = () => {
        if (intervalId !== null) {
            window.clearInterval(intervalId);
            intervalId = null;
        }
    };

    const start = () => {
        if (isPaused || isHovered || hasFocus || isTouching || document.hidden || intervalId !== null) {
            return;
        }

        intervalId = window.setInterval(() => {
            scrollToSlide(activeIndex + 1);
        }, 5000);
    };

    previousButton.addEventListener('click', () => {
        scrollToSlide(activeIndex - 1);
    });
    nextButton.addEventListener('click', () => {
        scrollToSlide(activeIndex + 1);
    });

    toggleButton.setAttribute('aria-pressed', String(isPaused));
    toggleButton.textContent = isPaused ? 'Putar otomatis' : 'Jeda otomatis';
    toggleButton.addEventListener('click', () => {
        isPaused = !isPaused;
        toggleButton.setAttribute('aria-pressed', String(isPaused));
        toggleButton.textContent = isPaused ? 'Putar otomatis' : 'Jeda otomatis';

        if (isPaused) {
            stop();
        } else {
            start();
        }
    });

    viewport.addEventListener('scroll', () => {
        window.clearTimeout(scrollTimeoutId);
        scrollTimeoutId = window.setTimeout(() => {
            const viewportRect = viewport.getBoundingClientRect();
            const viewportCenter = viewportRect.left + viewport.clientWidth / 2;
            let closestIndex = 0;
            let closestDistance = Number.POSITIVE_INFINITY;

            slides.forEach((slide, index) => {
                const slideRect = slide.getBoundingClientRect();
                const slideCenter = slideRect.left + slideRect.width / 2;
                const distance = Math.abs(slideCenter - viewportCenter);

                if (distance < closestDistance) {
                    closestIndex = index;
                    closestDistance = distance;
                }
            });

            if (closestIndex < slideCount || closestIndex >= slideCount * 2) {
                const centralIndex = slideCount + (closestIndex % slideCount);

                carousel.classList.add('is-repositioning');
                setActiveIndex(centralIndex);
                centerSlideWithoutAnimation(centralIndex);

                window.requestAnimationFrame(() => {
                    window.requestAnimationFrame(() => {
                        carousel.classList.remove('is-repositioning');
                    });
                });

                return;
            }

            setActiveIndex(closestIndex);
        }, 100);
    });

    carousel.addEventListener('mouseenter', () => {
        isHovered = true;
        stop();
    });
    carousel.addEventListener('mouseleave', () => {
        isHovered = false;
        start();
    });
    carousel.addEventListener('focusin', () => {
        hasFocus = true;
        stop();
    });
    carousel.addEventListener('focusout', (event) => {
        if (!carousel.contains(event.relatedTarget)) {
            hasFocus = false;
            start();
        }
    });
    viewport.addEventListener('touchstart', () => {
        isTouching = true;
        stop();
    }, { passive: true });
    viewport.addEventListener('touchend', () => {
        isTouching = false;
        start();
    }, { passive: true });
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            stop();
        } else {
            start();
        }
    });

    updateCarouselState();
    scrollToSlide(slideCount, 'auto');
    start();
});
