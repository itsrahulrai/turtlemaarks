/**
 * TURTLE MAARKS — PRODUCT FILTER & SORT ENGINE
 * Dynamic multi-criteria filter + live count + grid/list toggle
 * Uses centralized TurtleProducts repository and canonical renderCard
 */

const ProductFilter = {
  get products() {
    return (typeof TurtleProducts !== 'undefined') ? TurtleProducts.getAll() : [];
  },

  currentPage: 1,
  perPage: 9,

  activeFilters: {
    categories: [],
    subcategories: [],
    brands: [],
    styles: [],
    minPrice: 0,
    maxPrice: 500000,
    sort: 'featured',
    search: ''
  },

  init() {
    this.parseUrlParams();
    this.bindEvents();
    this.renderProducts();
  },

  parseUrlParams() {
    const params = new URLSearchParams(window.location.search);
    const getParamValues = (key) => {
      const vals = [...params.getAll(key), ...params.getAll(key + '[]')];
      return vals.filter(Boolean);
    };

    const brands = getParamValues('brand');
    const styles = getParamValues('style');
    const subcategories = getParamValues('subcategory');
    const categories = getParamValues('category');
    const page = parseInt(params.get('page'), 10);
    const sort = params.get('sort');

    if (page && page > 0) {
      this.currentPage = page;
    }

    if (sort) {
      this.activeFilters.sort = sort;
      const sortSelect = document.getElementById('tmSortSelect');
      if (sortSelect) sortSelect.value = sort;
    }

    categories.forEach(cat => {
      if (!this.activeFilters.categories.includes(cat)) {
        this.activeFilters.categories.push(cat);
      }
      const cb = document.querySelector(`.filter-category-checkbox[value="${cat}"]`);
      if (cb) cb.checked = true;
    });

    subcategories.forEach(sub => {
      if (!this.activeFilters.subcategories.includes(sub)) {
        this.activeFilters.subcategories.push(sub);
      }
      const cb = document.querySelector(`.filter-subcategory-checkbox[value="${sub}"]`);
      if (cb) cb.checked = true;
    });

    styles.forEach(style => {
      if (!this.activeFilters.styles.includes(style)) {
        this.activeFilters.styles.push(style);
      }
      const cb = document.querySelector(`.filter-style-checkbox[value="${style}"]`);
      if (cb) cb.checked = true;
    });

    brands.forEach(brand => {
      if (!this.activeFilters.brands.includes(brand)) {
        this.activeFilters.brands.push(brand);
      }
      let cb = document.querySelector(`.filter-brand-checkbox[value="${brand}"]`);
      if (!cb) {
        const brandSlug = brand.toLowerCase().replace(/[\s_]+/g, '-');
        document.querySelectorAll('.filter-brand-checkbox').forEach(el => {
          const elVal = el.value.toLowerCase();
          const elSlug = elVal.replace(/[\s_]+/g, '-');
          if (elVal === brand.toLowerCase() || elSlug === brandSlug) {
            cb = el;
          }
        });
      }
      if (cb) cb.checked = true;
    });
  },

  bindEvents() {
    // Category checkboxes
    document.querySelectorAll('.filter-category-checkbox').forEach(cb => {
      cb.addEventListener('change', (e) => {
        const val = e.target.value;
        if (e.target.checked) {
          if (!this.activeFilters.categories.includes(val)) this.activeFilters.categories.push(val);
        } else {
          this.activeFilters.categories = this.activeFilters.categories.filter(c => c.toLowerCase() !== val.toLowerCase());
        }
        this.currentPage = 1;
        this.renderProducts();
      });
    });

    // Subcategory checkboxes
    document.querySelectorAll('.filter-subcategory-checkbox').forEach(cb => {
      cb.addEventListener('change', (e) => {
        const val = e.target.value;
        if (e.target.checked) {
          if (!this.activeFilters.subcategories.includes(val)) this.activeFilters.subcategories.push(val);
        } else {
          this.activeFilters.subcategories = this.activeFilters.subcategories.filter(s => s.toLowerCase() !== val.toLowerCase());
        }
        this.currentPage = 1;
        this.renderProducts();
      });
    });

    // Form Factor (Style) checkboxes
    document.querySelectorAll('.filter-style-checkbox').forEach(cb => {
      cb.addEventListener('change', (e) => {
        const val = e.target.value;
        if (e.target.checked) {
          if (!this.activeFilters.styles.includes(val)) this.activeFilters.styles.push(val);
        } else {
          this.activeFilters.styles = this.activeFilters.styles.filter(s => s.toLowerCase() !== val.toLowerCase());
        }
        this.currentPage = 1;
        this.renderProducts();
      });
    });

    // Brand checkboxes
    document.querySelectorAll('.filter-brand-checkbox').forEach(cb => {
      cb.addEventListener('change', (e) => {
        const val = e.target.value;
        if (e.target.checked) {
          if (!this.activeFilters.brands.includes(val)) this.activeFilters.brands.push(val);
        } else {
          this.activeFilters.brands = this.activeFilters.brands.filter(b => b.toLowerCase() !== val.toLowerCase());
        }
        this.currentPage = 1;
        this.renderProducts();
      });
    });

    // Price range slider
    const priceSlider = document.getElementById('tmPriceRangeInput') || document.getElementById('filterMaxPrice');
    const priceDisplay = document.getElementById('tmPriceRangeDisplay');
    if (priceSlider) {
      priceSlider.addEventListener('input', (e) => {
        const val = Number(e.target.value) || 500000;
        this.activeFilters.maxPrice = val;
        if (priceDisplay) {
          priceDisplay.textContent = '₹' + val.toLocaleString('en-IN');
        }
        this.currentPage = 1;
        this.renderProducts();
      });
    }

    // Sort select
    const sortSelect = document.getElementById('tmSortSelect');
    if (sortSelect) {
      sortSelect.addEventListener('change', (e) => {
        this.activeFilters.sort = e.target.value;
        this.currentPage = 1;
        this.renderProducts();
      });
    }

    // Reset Filters button
    const resetBtn = document.getElementById('tmResetFiltersBtn') || document.getElementById('tmClearFiltersBtn');
    if (resetBtn) {
      resetBtn.addEventListener('click', () => {
        document.querySelectorAll('.filter-category-checkbox, .filter-subcategory-checkbox, .filter-style-checkbox, .filter-brand-checkbox').forEach(c => c.checked = false);
        if (priceSlider) {
          priceSlider.value = 500000;
        }
        if (priceDisplay) {
          priceDisplay.textContent = '₹5,00,000';
        }
        this.activeFilters = {
          categories: [],
          subcategories: [],
          brands: [],
          styles: [],
          minPrice: 0,
          maxPrice: 500000,
          sort: 'featured',
          search: ''
        };
        this.currentPage = 1;
        this.renderProducts();
      });
    }
  },

  filterList() {
    let list = [...this.products];

    // Filter Categories
    if (this.activeFilters.categories.length > 0) {
      const activeCats = this.activeFilters.categories.map(c => c.toLowerCase());
      list = list.filter(p => {
        const pCat = (p.category || '').toLowerCase();
        const pCatName = (p.categoryName || '').toLowerCase();
        if (activeCats.includes(pCat) || activeCats.includes(pCatName)) return true;
        if (activeCats.some(c => pCat.includes(c) || c.includes(pCat))) return true;
        if (activeCats.includes('rechargeable') && Boolean(p.rechargeable)) return true;
        if (activeCats.includes('bluetooth') && Boolean(p.bluetooth)) return true;
        if (activeCats.includes('accessories') && (pCat === 'accessories' || pCat === 'batteries' || pCat === 'hearing-aid-charger' || (p.style || '').toLowerCase() === 'accessory')) return true;
        return false;
      });
    }

    // Filter Subcategories
    if (this.activeFilters.subcategories.length > 0) {
      const activeSubs = this.activeFilters.subcategories.map(s => s.toLowerCase());
      list = list.filter(p => {
        const pSub = (p.subcategory || '').toLowerCase();
        const pSubName = (p.subcategoryName || '').toLowerCase();
        return activeSubs.includes(pSub) || activeSubs.includes(pSubName) || activeSubs.some(s => pSub.includes(s) || s.includes(pSub));
      });
    }

    // Filter Form Factor (Style)
    if (this.activeFilters.styles && this.activeFilters.styles.length > 0) {
      const activeStyles = this.activeFilters.styles.map(s => s.toLowerCase());
      list = list.filter(p => {
        const pStyle = (p.style || '').toLowerCase();
        if (activeStyles.includes(pStyle)) return true;
        if (activeStyles.includes('itc') && (pStyle === 'itc' || pStyle === 'ite')) return true;
        if (activeStyles.includes('accessory') && (pStyle === 'accessory' || (p.category || '').toLowerCase() === 'accessories' || (p.category || '').toLowerCase() === 'batteries' || (p.category || '').toLowerCase() === 'hearing-aid-charger')) return true;
        return false;
      });
    }

    // Filter Brands
    if (this.activeFilters.brands.length > 0) {
      const activeBrands = this.activeFilters.brands.map(b => b.toLowerCase().trim());
      list = list.filter(p => {
        const pBrand = (p.brand || '').toLowerCase().trim();
        const pBrandSlug = pBrand.replace(/[\s_]+/g, '-');
        return activeBrands.some(b => {
          const bSlug = b.replace(/[\s_]+/g, '-');
          return b === pBrand || b === pBrandSlug || bSlug === pBrand || bSlug === pBrandSlug || pBrand.includes(b) || b.includes(pBrand);
        });
      });
    }

    // Filter Price
    list = list.filter(p => p.price >= this.activeFilters.minPrice && p.price <= this.activeFilters.maxPrice);

    // Sorting
    if (this.activeFilters.sort === 'price-low') {
      list.sort((a, b) => a.price - b.price);
    } else if (this.activeFilters.sort === 'price-high') {
      list.sort((a, b) => b.price - a.price);
    } else if (this.activeFilters.sort === 'rating') {
      list.sort((a, b) => b.rating - a.rating);
    }

    return list;
  },

  renderProducts() {
    const grid = document.getElementById('tmProductsGrid');
    const countEl = document.getElementById('tmProductsMatchCount');
    if (!grid) return;

    const filtered = this.filterList();
    const totalItems = filtered.length;
    const totalPages = Math.ceil(totalItems / this.perPage) || 1;

    if (this.currentPage > totalPages) {
      this.currentPage = 1;
    }

    const startIdx = (this.currentPage - 1) * this.perPage;
    const endIdx = Math.min(startIdx + this.perPage, totalItems);

    if (countEl) {
      countEl.innerHTML = `Showing <strong>${totalItems > 0 ? (startIdx + 1) : 0} &ndash; ${endIdx}</strong> of <strong>${totalItems}</strong> models (Page <strong>${this.currentPage}</strong> of <strong>${totalPages}</strong>)`;
    }

    if (totalItems === 0) {
      const contactUrl = (window.TM && window.TM.routes && window.TM.routes.contact) ? window.TM.routes.contact : '/contact-us';
      grid.innerHTML = `
        <div class="col-12 d-flex justify-content-center w-100">
          <div class="tm-empty-state-card">
            <div class="tm-empty-state-icon">
              <i class="bi bi-funnel"></i>
            </div>
            <h4 class="tm-empty-state-title">No Products Available</h4>
            <p class="tm-empty-state-text">
              Try adjusting your filters or browse all hearing aids.
            </p>
            <div class="tm-empty-state-actions">
              <a href="${contactUrl}" class="tm-btn tm-btn-primary btn-sm px-4">
                <i class="bi bi-headset me-1"></i> Contact Us
              </a>
            </div>
          </div>
        </div>
      `;
      this.renderPagination(0);
      return;
    }

    const paged = filtered.slice(startIdx, endIdx);
    grid.innerHTML = paged.map(p => 
      TurtleProducts.renderCard(p, { colClass: 'col-xl-4 col-lg-4 col-md-6' })
    ).join('');

    if (typeof Wishlist !== 'undefined' && Wishlist.updateIcons) {
      Wishlist.updateIcons();
    }

    this.renderPagination(totalItems);
  },

  renderPagination(totalItems) {
    const wrap = document.getElementById('tmProductsPaginationWrap');
    if (!wrap) return;

    const totalPages = Math.ceil(totalItems / this.perPage) || 1;
    if (totalPages <= 1) {
      wrap.innerHTML = '';
      return;
    }

    let html = `
      <nav aria-label="Product pagination" class="d-flex justify-content-center mt-4 mb-4">
        <ul class="tm-pagination shadow-xs rounded-3 p-1 bg-white border">
          <!-- Previous Button -->
          <li class="page-item ${this.currentPage <= 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${this.currentPage - 1}" aria-label="Previous">
              <i class="bi bi-chevron-left"></i>
            </a>
          </li>
    `;

    for (let p = 1; p <= totalPages; p++) {
      html += `
        <li class="page-item ${p === this.currentPage ? 'active' : ''}">
          <a class="page-link" href="#" data-page="${p}">${p}</a>
        </li>
      `;
    }

    html += `
          <!-- Next Button -->
          <li class="page-item ${this.currentPage >= totalPages ? 'disabled' : ''}">
            <a class="page-link" href="#" data-page="${this.currentPage + 1}" aria-label="Next">
              <i class="bi bi-chevron-right"></i>
            </a>
          </li>
        </ul>
      </nav>
    `;

    wrap.innerHTML = html;

    // Attach click handlers to page links
    wrap.querySelectorAll('.page-link').forEach(link => {
      link.addEventListener('click', (e) => {
        e.preventDefault();
        const targetPage = parseInt(link.getAttribute('data-page'), 10);
        if (targetPage && targetPage >= 1 && targetPage <= totalPages && targetPage !== this.currentPage) {
          this.currentPage = targetPage;
          this.renderProducts();

          // Scroll smoothly to top of products grid
          const grid = document.getElementById('tmProductsGrid');
          if (grid) {
            const topPos = grid.getBoundingClientRect().top + window.pageYOffset - 90;
            window.scrollTo({ top: topPos, behavior: 'smooth' });
          }

          // Update URL ?page= without reload
          try {
            const url = new URL(window.location.href);
            url.searchParams.set('page', targetPage);
            window.history.replaceState({}, '', url.toString());
          } catch (err) {}
        }
      });
    });
  },

  resetFilters() {
    window.location.href = '/products';
  }
};

window.TurtleFilter = ProductFilter;
window.ProductFilter = ProductFilter;

document.addEventListener('DOMContentLoaded', () => {
  ProductFilter.init();
});
