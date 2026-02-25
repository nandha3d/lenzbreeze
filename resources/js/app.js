import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    // ===== Scroll-triggered fade-in animations =====
    const animObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
                animObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('[data-animate]').forEach(el => {
        el.style.opacity = '0';
        animObserver.observe(el);
    });

    // ===== Parallax Effect for Hero =====
    const parallaxEls = document.querySelectorAll('[data-parallax]');
    const heroSection = document.querySelector('.hero-section');

    if (heroSection && parallaxEls.length) {
        let ticking = false;

        const updateParallax = () => {
            const scrollY = window.scrollY;
            const heroBottom = heroSection.offsetTop + heroSection.offsetHeight;

            if (scrollY < heroBottom) {
                parallaxEls.forEach(el => {
                    const speed = parseFloat(el.dataset.parallax) || 0.3;
                    const yOffset = scrollY * speed;
                    el.style.transform = `translateY(${yOffset}px)`;
                });
            }
            ticking = false;
        };

        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(updateParallax);
                ticking = true;
            }
        }, { passive: true });
    }

    // ===== Cinematic Circular Lens Implementation =====
    const heroOverlay = document.querySelector('.hero-lens-overlay');
    const lensCursor = document.querySelector('.hero-lens-cursor');

    if (heroSection && heroOverlay) {
        console.log('LB Lens: Cinematic Circular Mask Initialized');

        const updateLens = (clientX, clientY) => {
            const rect = heroSection.getBoundingClientRect();
            const x = clientX - rect.left;
            const y = clientY - rect.top;

            // Convert to percentages for better stability
            const xPercent = (x / rect.width) * 100;
            const yPercent = (y / rect.height) * 100;

            heroSection.style.setProperty('--lens-x', `${xPercent}%`);
            heroSection.style.setProperty('--lens-y', `${yPercent}%`);

            if (lensCursor) {
                lensCursor.style.opacity = '1';
            }
        };

        const resetLens = () => {
            if (lensCursor) lensCursor.style.opacity = '0';
            // Optionally reset to center
            heroSection.style.setProperty('--lens-x', '50%');
            heroSection.style.setProperty('--lens-y', '50%');
        };

        // Check for mobile/touch device
        const isMobile = window.matchMedia('(hover: none) and (pointer: coarse)').matches;

        if (isMobile) {
            // Mobile: Centered Reveal
            heroSection.style.setProperty('--lens-radius', '40vw');
            heroSection.style.setProperty('--lens-x', '50%');
            heroSection.style.setProperty('--lens-y', '50%');

            if (lensCursor) {
                lensCursor.style.opacity = '1';
                lensCursor.style.transition = 'opacity 1s ease-in-out';
            }
        } else {
            // Desktop: Interactive Tracking
            heroSection.style.setProperty('--lens-radius', '500px');

            window.addEventListener('mousemove', (e) => {
                const rect = heroSection.getBoundingClientRect();

                // Check if cursor is within the hero section with a generous buffer
                const isInside = (
                    e.clientX >= (rect.left - 200) &&
                    e.clientX <= (rect.right + 200) &&
                    e.clientY >= (rect.top - 200) &&
                    e.clientY <= (rect.bottom + 200)
                );

                if (isInside) {
                    requestAnimationFrame(() => updateLens(e.clientX, e.clientY));
                } else {
                    resetLens();
                }
            });

            window.addEventListener('scroll', () => {
                const rect = heroSection.getBoundingClientRect();
                if (rect.bottom < 0 || rect.top > window.innerHeight) {
                    resetLens();
                }
            }, { passive: true });
        }
    }
});
