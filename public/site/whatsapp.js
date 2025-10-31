// Telefon numarasını buradan değiştirebilirsiniz
const phoneNumber = '905551234567'; // 90 ülke kodu + telefon
const message = 'Merhaba, web sitenizden ulaşıyorum'; // Varsayılan mesaj

// WhatsApp linkini güncelle
document.querySelector('.whatsapp-button').href =
    `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;

// Tıklama olayını logla (opsiyonel - analytics için)
document.querySelector('.whatsapp-button').addEventListener('click', function (e) {
    console.log('WhatsApp butonu tıklandı!');

    // Google Analytics event (eğer kullanıyorsanız)
    // gtag('event', 'click', {
    //     'event_category': 'WhatsApp',
    //     'event_label': 'Float Button'
    // });
});

// Notification badge'i gizleme (opsiyonel)
// 5 saniye sonra badge'i gizle
setTimeout(() => {
    const badge = document.querySelector('.notification-badge');
    if (badge) {
        badge.style.animation = 'none';
        badge.style.transform = 'scale(0)';
        setTimeout(() => badge.remove(), 300);
    }
}, 5000);
