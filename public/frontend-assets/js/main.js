/**
 * TURTLE MAARKS — CORE FRONTEND CONTROLLER
 * Vanilla JavaScript & Bootstrap 5 Interaction Engine
 */

document.addEventListener('DOMContentLoaded', () => {
  initStickyHeader();
  initSearchAutocomplete();
  initGlobalTooltips();
  updateGlobalBadges();
});

// 1. STICKY HEADER & SCROLL BEHAVIOR
function initStickyHeader() {
  const header = document.querySelector('.tm-header');
  if (!header) return;

  window.addEventListener('scroll', () => {
    if (window.scrollY > 40) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  });
}

// 2. TOAST NOTIFICATION SYSTEM
function showToast(title, message, type = 'success') {
  let container = document.querySelector('.tm-toast-container');
  if (!container) {
    container = document.createElement('div');
    container.className = 'tm-toast-container';
    document.body.appendChild(container);
  }

  const icons = {
    success: 'bi-check-circle-fill text-success',
    info: 'bi-info-circle-fill text-primary',
    warning: 'bi-exclamation-triangle-fill text-warning',
    danger: 'bi-x-circle-fill text-danger'
  };

  const toast = document.createElement('div');
  toast.className = 'tm-toast';
  toast.innerHTML = `
    <i class="bi ${icons[type] || icons.info} fs-4"></i>
    <div class="flex-grow-1">
      <div class="fw-bold fs-6">${title}</div>
      <div class="text-secondary small">${message}</div>
    </div>
    <button type="button" class="btn-close btn-close-sm" aria-label="Close"></button>
  `;

  toast.querySelector('.btn-close').addEventListener('click', () => {
    toast.remove();
  });

  container.appendChild(toast);

  setTimeout(() => {
    if (toast.parentNode) {
      toast.style.opacity = '0';
      toast.style.transform = 'translateX(40px)';
      toast.style.transition = 'all 0.3s ease';
      setTimeout(() => toast.remove(), 300);
    }
  }, 4000);
}

// 3. SEARCH AUTOCOMPLETE & MODAL
function initSearchAutocomplete() {
  const searchInput = document.getElementById('tmGlobalSearchInput');
  const resultsContainer = document.getElementById('tmSearchResultsContainer');
  if (!searchInput || !resultsContainer) return;

  let searchTimer = null;

  searchInput.addEventListener('input', (e) => {
    const query = e.target.value.trim();

    if (query.length < 2) {
      resultsContainer.innerHTML = '<div class="p-3 text-muted text-center small">Type at least 2 characters to search...</div>';
      return;
    }

    clearTimeout(searchTimer);
    searchTimer = setTimeout(async () => {
      resultsContainer.innerHTML = '<div class="p-3 text-muted text-center small"><span class="spinner-border spinner-border-sm me-2"></span>Searching the catalogue…</div>';

      try {
        const res = await fetch(`${window.TM.routes.search}/ajax?q=${encodeURIComponent(query)}`, {
          headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        });
        const matches = await res.json();

        if (!matches.length) {
          resultsContainer.innerHTML = `<div class="p-4 text-center text-muted">No matching products or diagnostic services found for "<strong>${query}</strong>"</div>`;
          return;
        }

        resultsContainer.innerHTML = `
          <div class="list-group list-group-flush">
            ${matches.map(item => `
              <a href="${item.url}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-2 px-3">
                <div class="d-flex align-items-center gap-2">
                  <img src="${item.image}" alt="${item.name}" style="width: 34px; height: 34px; object-fit: contain;">
                  <div class="fw-semibold text-navy">${item.name}</div>
                </div>
                <div class="fw-bold text-orange">₹${Number(item.price).toLocaleString('en-IN')}</div>
              </a>
            `).join('')}
            <a href="${window.TM.routes.search}?q=${encodeURIComponent(query)}" class="list-group-item list-group-item-action text-center small fw-bold text-orange">
              View all results for "${query}"
            </a>
          </div>`;
      } catch (err) {
        resultsContainer.innerHTML = '<div class="p-3 text-muted text-center small">Search is unavailable right now.</div>';
      }
    }, 220);
  });
}

// 4. GLOBAL BADGES (CART, WISHLIST, COMPARE)
function updateGlobalBadges(cartCount) {
  const count = typeof cartCount === 'number'
    ? cartCount
    : (window.Cart && Cart.state ? Cart.state.count : 0);

  document.querySelectorAll('.tm-cart-badge-count').forEach(b => {
    b.textContent = count;
    b.style.display = count > 0 ? 'inline-block' : 'none';
  });

  const wishlistCount = (window.TM && Array.isArray(window.TM.wishlistIds)) ? window.TM.wishlistIds.length : 0;
  document.querySelectorAll('.tm-wishlist-badge-count').forEach(b => {
    b.textContent = wishlistCount;
    b.style.display = wishlistCount > 0 ? 'inline-block' : 'none';
  });
}

// 5. TOOLTIPS
function initGlobalTooltips() {
  if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
  }
}

// 6. YOUTUBE PATIENT STORIES MODAL CONTROLLER (dynamic — data comes from each card's data-* attributes)
function openYouTubePatientVideo(source) {
  // `source` is either the clicked card element (dynamic, DB-driven cards)
  // or a legacy raw YouTube video id string, kept for backward compatibility.
  let video;

  if (source && source.dataset && source.dataset.youtubeId) {
    video = {
      id: source.dataset.youtubeId,
      title: source.dataset.title || 'Patient Hearing Transformation',
      badge: source.dataset.badge || 'Patient Story',
      speaker: source.dataset.speaker || 'Turtle Maarks Hearing Health',
      location: source.dataset.location || '',
      desc: source.dataset.desc || 'Watch real patient stories and hearing transformations with Turtle Maarks.',
    };
  } else if (typeof source === 'string') {
    video = { id: source, title: 'Patient Hearing Transformation', badge: 'Patient Story', speaker: 'Turtle Maarks Hearing Health', location: '', desc: 'Watch real patient stories and hearing transformations with Turtle Maarks.' };
  } else {
    return;
  }

  let modalEl = document.getElementById('tmYouTubeModal');
  if (!modalEl) {
    console.error('YouTube modal not found in DOM');
    return;
  }

  // Populate modal data
  const iframe = document.getElementById('tmYouTubeIframe');
  const titleEl = document.getElementById('tmYouTubeTitle');
  const badgeEl = document.getElementById('tmYouTubeBadge');
  const speakerEl = document.getElementById('tmYouTubeSpeaker');
  const descEl = document.getElementById('tmYouTubeDesc');
  const waBtn = document.getElementById('tmYouTubeWaBtn');

  if (iframe) {
    iframe.src = `https://www.youtube.com/embed/${video.id}?autoplay=1&rel=0&modestbranding=1`;
  }
  if (titleEl) titleEl.textContent = video.title;
  if (badgeEl) badgeEl.textContent = video.badge;
  if (speakerEl) speakerEl.innerHTML = `<i class="bi bi-person-check-fill text-success me-1"></i> ${video.speaker}${video.location ? ` • <span class="text-muted">${video.location}</span>` : ''}`;
  if (descEl) descEl.textContent = video.desc;

  if (waBtn) {
    const waText = encodeURIComponent(`Hi Turtle Maarks, I watched your video "${video.title}" and would like to book a 7-day free trial / consultation.`);
    waBtn.href = `https://wa.me/918130495476?text=${waText}`;
  }

  // Show Bootstrap modal
  if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
    const bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
    bsModal.show();
  }
}

// Stop YouTube video playback when modal is closed
document.addEventListener('DOMContentLoaded', () => {
  const modalEl = document.getElementById('tmYouTubeModal');
  if (modalEl) {
    modalEl.addEventListener('hidden.bs.modal', () => {
      const iframe = document.getElementById('tmYouTubeIframe');
      if (iframe) {
        iframe.src = '';
      }
    });
  }

  // Initialize dynamic clinic open/closed status in footer
  updateFooterClinicStatus();
});

// 4. FOOTER E-COMMERCE INTERACTIONS
function handleNewsletterSubmit(e) {
  e.preventDefault();
  const input = document.getElementById('tmNewsletterEmail');
  if (!input) return false;

  const email = input.value.trim();
  if (!email || !email.includes('@')) {
    if (typeof showToast === 'function') {
      showToast('Invalid Email', 'Please enter a valid email address.', 'warning');
    }
    return false;
  }

  // Simulate successful subscription with persistent feedback
  if (typeof showToast === 'function') {
    showToast('Subscribed Successfully!', 'Thank you for joining Turtle Maarks VIP Hearing Club! Welcome perks and hearing health guides are on their way.', 'success');
  }

  input.value = '';
  return false;
}

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
}

function updateFooterClinicStatus() {
  const statusBadge = document.querySelector('.tm-footer-clinic-card .badge');
  if (!statusBadge) return;

  const now = new Date();
  const day = now.getDay(); // 0 is Sunday, 1-6 is Mon-Sat
  const hours = now.getHours();
  const minutes = now.getMinutes();
  const currentTime = hours * 60 + minutes;

  // Mon-Sat: 10:00 AM (600 mins) to 7:30 PM (1170 mins)
  const openTime = 10 * 60;
  const closeTime = 19 * 60 + 30;

  if (day === 0) {
    statusBadge.innerHTML = '<i class="bi bi-calendar-event me-1"></i> Sunday: Appt Only';
    statusBadge.className = 'badge bg-warning-subtle text-warning border border-warning-subtle d-inline-flex align-items-center gap-1 small py-1 px-2';
  } else if (currentTime >= openTime && currentTime < closeTime) {
    statusBadge.innerHTML = '<span class="tm-pulse-dot"></span> Open Today • Closes 7:30 PM';
    statusBadge.className = 'badge bg-success-subtle text-success border border-success-subtle d-inline-flex align-items-center gap-1 small py-1 px-2';
  } else {
    statusBadge.innerHTML = '<i class="bi bi-clock-history me-1"></i> Opens 10:00 AM';
    statusBadge.className = 'badge bg-secondary-subtle text-secondary border border-secondary-subtle d-inline-flex align-items-center gap-1 small py-1 px-2';
  }
}



