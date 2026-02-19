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

        // Function to set Idle State (Full Blur - No Seam)
        // We use just one pane to cover everything to avoid the 1px gap line
        const setIdleState = () => {
            paneTop.style.height = '100%';
            paneBottom.style.top = '100%';
            paneBottom.style.height = '0%';
            if (lensCursor) lensCursor.style.opacity = '0';
        };

        // Function to set Active/Clear State (No Blur)
        const setClearState = () => {
            paneTop.style.height = '0%';
            paneBottom.style.top = '100%';
            paneBottom.style.height = '0%';
            if (lensCursor) lensCursor.style.opacity = '0';
        };

        const updateLens = (clientY) => {
            const rect = heroSection.getBoundingClientRect();
            const y = clientY - rect.top;
            const heroH = rect.height;
            // Gap size (clear area)
            const gapRadius = 150;

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

        // Check for mobile/touch device
        const isMobile = window.matchMedia('(hover: none) and (pointer: coarse)').matches;

        if (isMobile) {
            // Mobile: Automatic Reveal
            // 1. Start fully blurred
            setIdleState();

            // 2. Prepare for split animation (force layout calc)
            // We want the starting point of animation to be the center split
            requestAnimationFrame(() => {
                paneTop.style.height = '50%';
                paneBottom.style.top = '50%';
                paneBottom.style.height = '50%';

                // 3. Add transition and trigger reveal after a moment
                setTimeout(() => {
                    paneTop.style.transition = 'height 1.5s ease-in-out';
                    paneBottom.style.transition = 'top 1.5s ease-in-out, height 1.5s ease-in-out';
                    setClearState();
                }, 500);
            });

        } else {
            // Desktop: Interactive Hover with Buffer
            setIdleState();

            // Remove transitions for instant responsiveness
            paneTop.style.transition = 'none';
            paneBottom.style.transition = 'none';

            // Buffer distance in pixels to keep tracking outside the box
            const BUFFER = 100;

            window.addEventListener('mousemove', (e) => {
                const rect = heroSection.getBoundingClientRect();
                const clientY = e.clientY;

                // Check if mouse is near the hero section (including buffer)
                const isNear = clientY >= (rect.top - BUFFER) &&
                    clientY <= (rect.bottom + BUFFER);

                if (isNear) {
                    // Update lens position relative to hero, allowing it to go off-edges
                    requestAnimationFrame(() => updateLens(clientY));
                } else {
                    // Too far away, reset to full blur
                    setIdleState();
                }
            });

            // Handle scrolling - update positions if mouse stays still but page moves
            window.addEventListener('scroll', () => {
                // Optional: strictly re-check mouse pos or just let the next mousemove handle it. 
                // For simplicity and performance, we rely on mouse movement or just set idle if scrolled far away.
                const rect = heroSection.getBoundingClientRect();
                if (rect.bottom < 0 || rect.top > window.innerHeight) {
                    setIdleState();
                }
            }, { passive: true });
        }
    }
});
