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

    // ===== Fresh Hero Lens Implementation (Local First) =====
    const paneTop = document.getElementById('lens-pane-top');
    const paneBottom = document.getElementById('lens-pane-bottom');
    const lensCursor = document.querySelector('.hero-lens-cursor');

    if (heroSection && paneTop && paneBottom) {
        console.log('LB Lens: Fresh Structural Initialized');

        // Function to set Idle State (Full Blur)
        const setIdleState = () => {
            paneTop.style.height = '120%';
            paneBottom.style.top = '100%';
            paneBottom.style.height = '0%';
            if (lensCursor) lensCursor.style.top = '-500px';
        };

        const updateLens = (e) => {
            const rect = heroSection.getBoundingClientRect();
            const y = e.clientY - rect.top;
            const heroH = rect.height;
            // Gap size (clear area)
            const gapRadius = 200;

            // Top Pane: Ends at cursor - gap
            paneTop.style.height = `${Math.max(0, y - gapRadius)}px`;

            // Bottom Pane: Starts at cursor + gap
            const bottomTop = Math.min(heroH, y + gapRadius);
            paneBottom.style.top = `${bottomTop}px`;
            paneBottom.style.height = `${Math.max(0, heroH - bottomTop)}px`;

            if (lensCursor) {
                lensCursor.style.top = `${y}px`;
                lensCursor.style.opacity = '1';
            }
        };

        // Initialize in Idle State to prevent "Center Line" on load
        setIdleState();

        heroSection.addEventListener('mousemove', (e) => {
            requestAnimationFrame(() => updateLens(e));
        });

        heroSection.addEventListener('mouseleave', setIdleState);
    }
});
