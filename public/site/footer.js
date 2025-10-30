    // Back to Top Button Functionality
    document.addEventListener('DOMContentLoaded', function() {
    const backToTopBtn = document.getElementById('izkc-back-to-top');

    if (backToTopBtn) {
    window.addEventListener('scroll', function() {
    if (window.pageYOffset > 300) {
    backToTopBtn.classList.add('active');
} else {
    backToTopBtn.classList.remove('active');
}
});

    backToTopBtn.addEventListener('click', function(e) {
    e.preventDefault();
    window.scrollTo({
    top: 0,
    behavior: 'smooth'
});
});
}
});
