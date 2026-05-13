/* assets/js/main.js */
document.addEventListener('DOMContentLoaded', function() {
    // AOS Initialization
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });
    }

    // Navbar Scroll Class
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Counter Animation
    const counters = document.querySelectorAll('.counter');
    if (counters.length > 0) {
        const observerOptions = {
            threshold: 0.5
        };

        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = +counter.getAttribute('data-target');
                    const duration = 2000;
                    const increment = target / (duration / 16);

                    let currentCount = 0;
                    const updateCount = () => {
                        currentCount += increment;
                        if (currentCount < target) {
                            counter.innerText = Math.ceil(currentCount);
                            requestAnimationFrame(updateCount);
                        } else {
                            counter.innerText = target;
                        }
                    };
                    updateCount();
                    observer.unobserve(counter);
                }
            });
        }, observerOptions);

        counters.forEach(counter => counterObserver.observe(counter));
    }

    // Multi-step Form Logic
    const steps = document.querySelectorAll('.form-step');
    const nextBtns = document.querySelectorAll('.btn-next');
    const prevBtns = document.querySelectorAll('.btn-prev');
    const stepIndicators = document.querySelectorAll('.step-item');
    let currentStep = 0;

    if (steps.length > 0) {
        const updateForm = () => {
            steps.forEach((step, index) => {
                step.classList.toggle('active', index === currentStep);
                if (index === currentStep) {
                    step.style.display = 'block';
                } else {
                    step.style.display = 'none';
                }
            });

            stepIndicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index <= currentStep);
            });
        };

        nextBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    updateForm();
                    window.scrollTo(0, 0);
                }
            });
        });

        prevBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                if (currentStep > 0) {
                    currentStep--;
                    updateForm();
                    window.scrollTo(0, 0);
                }
            });
        });

        updateForm();
    }

    // Smooth Fee Transition
    const testModeSelect = document.getElementById('test_mode');
    const feeDisplay = document.getElementById('fee_display');
    const feeInput = document.getElementById('fee_input');

    if (testModeSelect && feeDisplay) {
        testModeSelect.addEventListener('change', function() {
            const newFee = (this.value === 'Online Remote Test') ? 600 : 1000;

            // Fade effect
            feeDisplay.style.opacity = '0';
            setTimeout(() => {
                feeDisplay.innerText = newFee;
                feeInput.value = newFee;
                feeDisplay.style.opacity = '1';
            }, 300);
        });
        feeDisplay.style.transition = 'opacity 0.3s ease';
    }
});

// Toast Notification System
const showToast = (message, type = 'info') => {
    const toastContainer = document.getElementById('toast-container') || createToastContainer();
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-white bg-${type} border-0 show mb-2`;
    toast.role = 'alert';
    toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">${message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;
    toastContainer.appendChild(toast);
    setTimeout(() => toast.remove(), 5000);
};

const createToastContainer = () => {
    const container = document.createElement('div');
    container.id = 'toast-container';
    container.className = 'toast-container position-fixed bottom-0 end-0 p-3';
    container.style.zIndex = '1100';
    document.body.appendChild(container);
    return container;
};
