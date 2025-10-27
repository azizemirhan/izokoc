/**
 * İZOKOÇ HEADER JAVASCRIPT
 * Modern, Responsive ve İnteraktif
 */

// Sayfa yüklendiğinde çalış
document.addEventListener('DOMContentLoaded', function() {

    // ========== DEĞİŞKENLER ==========
    const searchToggle = document.getElementById('izokocSearchToggle');
    const searchModal = document.getElementById('izokocSearchModal');
    const searchModalOverlay = document.getElementById('izokocSearchModalOverlay');
    const searchModalClose = document.getElementById('izokocSearchModalClose');
    const menuToggle = document.getElementById('izokocMenuToggle');
    const mobileOverlay = document.getElementById('izokocMobileOverlay');
    const mobileSidebar = document.getElementById('izokocMobileSidebar');
    const mobileClose = document.getElementById('izokocMobileClose');
    const navbar = document.querySelector('.izokoc_navbar');
    const submenuToggles = document.querySelectorAll('.izokoc_submenu_toggle');
    const languageBtn = document.getElementById('izokocLanguageBtn');
    const languageDropdown = document.getElementById('izokocLanguageDropdown');

    // ========== ARAMA MODAL ==========
    // Arama butonuna tıklandığında modal aç
    if (searchToggle) {
        searchToggle.addEventListener('click', function(e) {
            e.preventDefault();
            openSearchModal();
        });
    }

    // Modal overlay'e tıklandığında kapat
    if (searchModalOverlay) {
        searchModalOverlay.addEventListener('click', closeSearchModal);
    }

    // Modal kapatma butonuna tıklandığında
    if (searchModalClose) {
        searchModalClose.addEventListener('click', closeSearchModal);
    }

    // Modal açma fonksiyonu
    function openSearchModal() {
        if (searchModal) {
            searchModal.classList.add('izokoc_active');
            document.body.style.overflow = 'hidden';

            // Input'a odaklan
            setTimeout(() => {
                const searchInput = searchModal.querySelector('.izokoc_search_modal_input');
                if (searchInput) searchInput.focus();
            }, 300);
        }
    }

    // Modal kapatma fonksiyonu
    function closeSearchModal() {
        if (searchModal) {
            searchModal.classList.remove('izokoc_active');
            document.body.style.overflow = '';
        }
    }

    // Arama formu submit olduğunda
    const searchModalForm = document.querySelector('.izokoc_search_modal_form');
    if (searchModalForm) {
        searchModalForm.addEventListener('submit', function(e) {
            const searchInput = this.querySelector('.izokoc_search_modal_input');
            if (!searchInput || !searchInput.value.trim()) {
                e.preventDefault();
                alert('Lütfen aramak istediğiniz kelimeyi yazın.');
            }
        });
    }

    // Suggestion tag'lere tıklandığında
    const suggestionTags = document.querySelectorAll('.izokoc_suggestion_tag');
    suggestionTags.forEach(tag => {
        tag.addEventListener('click', function(e) {
            e.preventDefault();
            const searchInput = searchModal.querySelector('.izokoc_search_modal_input');
            if (searchInput) {
                searchInput.value = this.textContent.trim();
                searchInput.focus();
            }
        });
    });

    // ========== DİL SEÇİCİ ==========
    if (languageBtn && languageDropdown) {
        // Dil butonuna tıklandığında dropdown aç/kapa
        languageBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            languageDropdown.classList.toggle('izokoc_active');
        });

        // Dropdown dışına tıklandığında kapat
        document.addEventListener('click', function(e) {
            if (!languageBtn.contains(e.target) && !languageDropdown.contains(e.target)) {
                languageDropdown.classList.remove('izokoc_active');
            }
        });

        // Dil seçeneklerine tıklandığında dropdown'u kapat
        const languageItems = languageDropdown.querySelectorAll('.izokoc_language_item');
        languageItems.forEach(item => {
            item.addEventListener('click', function() {
                languageDropdown.classList.remove('izokoc_active');
            });
        });
    }

    // ========== MOBİL MENÜ ==========
    // Menü toggle butonuna tıklandığında
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            this.classList.toggle('izokoc_active');
            mobileOverlay.classList.toggle('izokoc_active');
            mobileSidebar.classList.toggle('izokoc_active');
            document.body.style.overflow = mobileSidebar.classList.contains('izokoc_active') ? 'hidden' : '';
        });
    }

    // Mobil menü kapatma butonuna tıklandığında
    if (mobileClose) {
        mobileClose.addEventListener('click', closeMobileMenu);
    }

    // Overlay'e tıklandığında menüyü kapat
    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', closeMobileMenu);
    }

    // Menü kapatma fonksiyonu
    function closeMobileMenu() {
        menuToggle.classList.remove('izokoc_active');
        mobileOverlay.classList.remove('izokoc_active');
        mobileSidebar.classList.remove('izokoc_active');
        document.body.style.overflow = '';
    }

    // ESC tuşu ile menü ve modal kapat
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            // Mobil menü açıksa kapat
            if (mobileSidebar.classList.contains('izokoc_active')) {
                closeMobileMenu();
            }
            // Arama modal'ı açıksa kapat
            if (searchModal && searchModal.classList.contains('izokoc_active')) {
                closeSearchModal();
            }
            // Dil dropdown'u açıksa kapat
            if (languageDropdown && languageDropdown.classList.contains('izokoc_active')) {
                languageDropdown.classList.remove('izokoc_active');
            }
        }
    });

    // ========== MOBİL ALT MENÜ TOGGLE ==========
    // ========== MOBİL ALT MENÜ TOGGLE ==========
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const parentItem = this.closest('.izokoc_mobile_item');
            const submenu = parentItem.querySelector(':scope > .izokoc_mobile_submenu');

            // Toggle işlemi
            this.classList.toggle('izokoc_active');
            if (submenu) {
                submenu.classList.toggle('izokoc_active');
            }

            // SADECE aynı seviyedeki diğer menüleri kapat (kardeş elemanlar)
            const parentList = parentItem.parentElement;
            const siblingItems = Array.from(parentList.children).filter(child =>
                child !== parentItem && child.classList.contains('izokoc_mobile_item')
            );

            siblingItems.forEach(siblingItem => {
                const siblingToggle = siblingItem.querySelector(':scope > .izokoc_submenu_toggle');
                const siblingSubmenu = siblingItem.querySelector(':scope > .izokoc_mobile_submenu');

                if (siblingToggle) {
                    siblingToggle.classList.remove('izokoc_active');
                }
                if (siblingSubmenu) {
                    siblingSubmenu.classList.remove('izokoc_active');
                }
            });
        });
    });

    // ========== STICKY NAVBAR ==========
    let lastScrollTop = 0;
    const scrollThreshold = 100;

    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Navbar'a scrolled class'ı ekle/çıkar
        if (scrollTop > scrollThreshold) {
            navbar.classList.add('izokoc_scrolled');
        } else {
            navbar.classList.remove('izokoc_scrolled');
        }

        lastScrollTop = scrollTop;
    });

    // ========== AKTİF MENÜ ÖĞESİ ==========
    // Sayfa yüklendiğinde aktif menü öğesini işaretle
    const currentPath = window.location.pathname;
    const menuItems = document.querySelectorAll('.izokoc_menu_item a, .izokoc_mobile_item a');

    menuItems.forEach(item => {
        const itemPath = new URL(item.href).pathname;

        if (itemPath === currentPath) {
            const parentItem = item.closest('.izokoc_menu_item, .izokoc_mobile_item');
            if (parentItem) {
                parentItem.classList.add('izokoc_active');
            }
        }
    });

    // ========== SMOOTH SCROLL ==========
    // Tüm iç sayfa linklerine smooth scroll ekle
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');

            // Sadece # değilse
            if (href !== '#' && href !== 'javascript: void(0);') {
                const target = document.querySelector(href);

                if (target) {
                    e.preventDefault();
                    const navbarHeight = navbar.offsetHeight;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navbarHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Mobil menü açıksa kapat
                    if (mobileSidebar.classList.contains('izokoc_active')) {
                        closeMobileMenu();
                    }
                }
            }
        });
    });

    // ========== RESPONSİVE MENÜ KONTROLÜ ==========
    let windowWidth = window.innerWidth;

    window.addEventListener('resize', function() {
        const newWidth = window.innerWidth;

        // Genişlik değiştiğinde ve desktop boyutuna geçildiğinde mobil menüyü kapat
        if (windowWidth <= 992 && newWidth > 992) {
            closeMobileMenu();
        }

        windowWidth = newWidth;
    });

    // ========== DIŞARI TIKLAMA İLE MENÜ KAPAT ==========
    // Desktop'ta submenu dışına tıklandığında menüyü kapat
    document.addEventListener('click', function(e) {
        const submenu = document.querySelector('.izokoc_submenu');
        const hasSubmenuItem = document.querySelector('.izokoc_has_submenu');

        if (submenu && hasSubmenuItem) {
            if (!hasSubmenuItem.contains(e.target)) {
                submenu.style.display = 'none';
                setTimeout(() => {
                    submenu.style.display = '';
                }, 300);
            }
        }
    });

    // ========== LOADING ANİMASYONU ==========
    // Sayfa yüklenirken header elementlerine animasyon ekle
    const headerElements = document.querySelectorAll('.izokoc_info_item, .izokoc_menu_item, .izokoc_social a');

    headerElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(-20px)';

        setTimeout(() => {
            element.style.transition = 'all 0.5s ease-out';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, 100 * index);
    });

    // ========== PERFORMANS OPTİMİZASYONU ==========
    // Scroll event'ini throttle ile optimize et
    function throttle(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Scroll event'ini optimize edilmiş haliyle kullan
    const optimizedScroll = throttle(function() {
        // Scroll ile ilgili işlemler burada
    }, 100);

    window.addEventListener('scroll', optimizedScroll);

    // ========== HOVER EFEKTLERİ ==========
    // Logo hover efekti
    const logo = document.querySelector('.izokoc_logo');
    if (logo) {
        logo.addEventListener('mouseenter', function() {
            this.querySelector('img').style.filter = 'drop-shadow(0 5px 15px rgba(255, 49, 49, 0.4))';
        });

        logo.addEventListener('mouseleave', function() {
            this.querySelector('img').style.filter = 'none';
        });
    }

    // ========== ERİŞİLEBİLİRLİK ==========
    // Tab tuşu ile navigasyon için outline ekle
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            document.body.classList.add('izokoc_keyboard_nav');
        }
    });

    document.addEventListener('mousedown', function() {
        document.body.classList.remove('izokoc_keyboard_nav');
    });

    // ========== KONSOl MESAJI ==========
    console.log('%c🏗️ İzokoç İzolasyon', 'color: #FF3131; font-size: 20px; font-weight: bold;');
    console.log('%cModern Header Tasarımı', 'color: #1a237e; font-size: 14px;');
    console.log('%c✓ Responsive Design', 'color: #27ae60; font-size: 12px;');
    console.log('%c✓ Mobile Sidebar Menu', 'color: #27ae60; font-size: 12px;');
    console.log('%c✓ Smooth Animations', 'color: #27ae60; font-size: 12px;');
    console.log('%c✓ Sticky Navigation', 'color: #27ae60; font-size: 12px;');

});

// ========== YARDIMCI FONKSİYONLAR ==========

/**
 * Element'in viewport'ta görünür olup olmadığını kontrol eder
 */
function isElementInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

/**
 * Debounce fonksiyonu - Performans optimizasyonu için
 */
function debounce(func, wait, immediate) {
    let timeout;
    return function executedFunction() {
        const context = this;
        const args = arguments;
        const later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

/**
 * Cookie işlemleri
 */
const IzokocCookie = {
    set: function(name, value, days) {
        let expires = "";
        if (days) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    },
    get: function(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    },
    delete: function(name) {
        document.cookie = name + '=; Max-Age=-99999999;';
    }
};

// Export (Eğer modül sistemi kullanılıyorsa)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        isElementInViewport,
        debounce,
        IzokocCookie
    };
}