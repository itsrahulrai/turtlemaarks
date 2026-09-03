/**
 * TURTLE MAARKS — CLINICAL GALLERY & LIGHTBOX ENGINE
 */

const GalleryViewer = {
  items: [],
  currentIndex: 0,

  init() {
    this.collectItems();
    this.bindFilters();
    this.bindKeyboard();
  },

  collectItems() {
    const cards = document.querySelectorAll('.tm-gallery-item');
    this.items = [];
    cards.forEach((card, index) => {
      card.setAttribute('data-index', index);
      this.items.push({
        src: card.getAttribute('data-img-src') || '',
        title: card.getAttribute('data-title') || 'Clinic Infrastructure',
        category: card.getAttribute('data-category-label') || 'Turtle Maarks',
        desc: card.getAttribute('data-desc') || ''
      });
    });
  },

  bindFilters() {
    const pills = document.querySelectorAll('.tm-gallery-filter-pill');
    pills.forEach(pill => {
      pill.addEventListener('click', () => {
        pills.forEach(p => p.classList.remove('active'));
        pill.classList.add('active');

        const filter = pill.getAttribute('data-filter');
        const items = document.querySelectorAll('.tm-gallery-item');
        let count = 0;

        items.forEach(item => {
          const cat = item.getAttribute('data-category');
          if (filter === 'all' || cat === filter) {
            item.style.display = '';
            count++;
          } else {
            item.style.display = 'none';
          }
        });

        const countBadge = document.getElementById('tmGalleryVisibleCount');
        if (countBadge) countBadge.textContent = count;
      });
    });
  },

  openLightbox(index) {
    this.currentIndex = parseInt(index, 10);
    this.updateLightboxContent();

    const modalEl = document.getElementById('tmGalleryLightboxModal');
    if (modalEl) {
      const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
      modal.show();
    }
  },

  updateLightboxContent() {
    const item = this.items[this.currentIndex];
    if (!item) return;

    const img = document.getElementById('tmLightboxImg');
    const title = document.getElementById('tmLightboxTitle');
    const cat = document.getElementById('tmLightboxCategory');
    const desc = document.getElementById('tmLightboxDesc');
    const counter = document.getElementById('tmLightboxCounter');

    if (img) {
      img.src = item.src;
      img.alt = item.title;
    }
    if (title) title.textContent = item.title;
    if (cat) cat.textContent = item.category;
    if (desc) desc.textContent = item.desc;
    if (counter) counter.textContent = `${this.currentIndex + 1} / ${this.items.length}`;
  },

  next() {
    this.currentIndex = (this.currentIndex + 1) % this.items.length;
    this.updateLightboxContent();
  },

  prev() {
    this.currentIndex = (this.currentIndex - 1 + this.items.length) % this.items.length;
    this.updateLightboxContent();
  },

  bindKeyboard() {
    document.addEventListener('keydown', (e) => {
      const modalEl = document.getElementById('tmGalleryLightboxModal');
      if (modalEl && modalEl.classList.contains('show')) {
        if (e.key === 'ArrowRight') this.next();
        if (e.key === 'ArrowLeft') this.prev();
      }
    });
  }
};

document.addEventListener('DOMContentLoaded', () => {
  GalleryViewer.init();
});


