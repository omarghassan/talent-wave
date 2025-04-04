function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggle = document.querySelector('.password-toggle');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggle.textContent = '🔒';
    } else {
        passwordInput.type = 'password';
        toggle.textContent = '👁️';
    }
}


// Create animated particles
function createParticles() {
    const particles = document.getElementById('particles');
    const particleCount = 20;
    
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        
        // Random size
        const size = Math.random() * 10 + 5;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        
        // Random position
        const posX = Math.random() * 100;
        const posY = Math.random() * 100;
        particle.style.left = `${posX}%`;
        particle.style.top = `${posY}%`;
        
        // Random opacity & color
        const opacity = Math.random() * 0.2;
        const hue = Math.random() * 20;
        particle.style.backgroundColor = `hsla(${hue}, 100%, 50%, ${opacity})`;
        
        // Animation
        const duration = Math.random() * 5 + 3;
        particle.style.animation = `particle-animation ${duration}s ease infinite`;
        
        particles.appendChild(particle);
    }
}

// Initialize animations
window.addEventListener('load', function() {
    createParticles();
    
    // Focus effect for inputs
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.querySelector('label').style.color = 'var(--accent-color)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.querySelector('label').style.color = 'var(--heading-color)';
        });
    });
});