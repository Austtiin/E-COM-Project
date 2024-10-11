document.addEventListener('DOMContentLoaded', () => {
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const loginShadowbox = document.getElementById('loginShadowbox');
    const registerShadowbox = document.getElementById('registerShadowbox');
    const closeLogin = document.getElementById('closeLogin');
    const closeRegister = document.getElementById('closeRegister');

    loginBtn.addEventListener('click', () => {
        loginShadowbox.style.display = 'block';
    });

    registerBtn.addEventListener('click', () => {
        registerShadowbox.style.display = 'block';
    });

    closeLogin.addEventListener('click', () => {
        loginShadowbox.style.display = 'none';
    });

    closeRegister.addEventListener('click', () => {
        registerShadowbox.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === loginShadowbox) {
            loginShadowbox.style.display = 'none';
        }
        if (event.target === registerShadowbox) {
            registerShadowbox.style.display = 'none';
        }
    });
});