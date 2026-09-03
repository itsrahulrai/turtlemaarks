/**
 * TURTLE MAARKS — CLIENT-SIDE PRODUCT REPOSITORY & CARD ENGINE
 *
 * Blade twin: resources/views/site/partials/product-card.blade.php
 *
 * The catalogue itself is injected by the site layout from the database
 * (App\Support\TmCatalog), so admin changes appear here with no code edits.
 * The server renders the first paint of every grid with the Blade partial;
 * this file only re-renders cards for live interactions: filters, sort,
 * search, wishlist and compare. Any change to the card markup must be made
 * in BOTH places.
 */

const TURTLE_PRODUCTS = Array.isArray(window.TURTLE_PRODUCTS) ? window.TURTLE_PRODUCTS : [];

const TurtleProducts = {
  products: TURTLE_PRODUCTS,

  getAll() {
    return this.products;
  },

  getById(id) {
    return this.products.find(p => p.id === id) || null;
  },

  filter(criteria = {}) {
    let list = [...this.products];

    if (criteria.brand) {
      const brands = Array.isArray(criteria.brand) ? criteria.brand : [criteria.brand];
      list = list.filter(p => brands.map(b => b.toLowerCase()).includes(p.brand.toLowerCase()));
    }

    if (criteria.style) {
      const styles = Array.isArray(criteria.style) ? criteria.style : [criteria.style];
      list = list.filter(p => styles.map(s => s.toLowerCase()).includes(p.style.toLowerCase()));
    }

    if (criteria.category) {
      const cats = Array.isArray(criteria.category) ? criteria.category : [criteria.category];
      list = list.filter(p => cats.map(c => c.toLowerCase()).includes((p.category || '').toLowerCase()));
    }

    if (criteria.isPopular) {
      list = list.filter(p => p.isPopular);
    }

    if (criteria.isFeatured) {
      list = list.filter(p => p.isFeatured);
    }

    if (criteria.rechargeableOnly) {
      list = list.filter(p => p.rechargeable);
    }

    if (criteria.bluetoothOnly) {
      list = list.filter(p => p.bluetooth);
    }

    if (criteria.minPrice !== undefined) {
      list = list.filter(p => p.price >= criteria.minPrice);
    }

    if (criteria.maxPrice !== undefined) {
      list = list.filter(p => p.price <= criteria.maxPrice);
    }

    if (criteria.search) {
      const q = criteria.search.trim().toLowerCase();
      list = list.filter(p => 
        p.name.toLowerCase().includes(q) ||
        p.brand.toLowerCase().includes(q) ||
        p.style.toLowerCase().includes(q) ||
        (p.techLevel && p.techLevel.toLowerCase().includes(q)) ||
        (p.featureHighlight && p.featureHighlight.toLowerCase().includes(q))
      );
    }

    if (criteria.limit && criteria.limit > 0) {
      list = list.slice(0, criteria.limit);
    }

    return list;
  },

  /**
   * CANONICAL LUXURY PRODUCT CARD GENERATOR (ONLY ONE CODE USED EVERYWHERE)
   * @param {Object} p Product Data Object
   * @param {Object} options Configuration (colClass, showCompare, isWishlistPage, etc.)
   * @returns {string} HTML markup string
   */
  renderCard(p, options = {}) {
    if (!p) return '';

    const colClass = options.colClass || 'col-xl-3 col-lg-4 col-md-6';
    const isWishlistPage = !!options.isWishlistPage || !!options.isWishlist;
    const savings = Math.max(0, (p.mrp || p.price) - p.price);
    const savePercent = p.mrp > p.price ? Math.round(((p.mrp - p.price) / p.mrp) * 100) : 0;
    const badgeText = p.badge || (savePercent > 0 ? `${savePercent}% OFF` : 'Authorized');
    
    // Check if saved in wishlist
    const wishlist = (typeof localStorage !== 'undefined') 
      ? JSON.parse(localStorage.getItem('turtle_wishlist') || '[]') 
      : [];
    const isWishlisted = wishlist.some(i => i.id === p.id);

    // Escape single quotes in names for onclick handlers
    const safeName = p.name.replace(/'/g, "\\'");
    const safeBrand = (p.brand || 'Turtle Maarks').replace(/'/g, "\\'");
    const safeImage = p.image || (window.TM && window.TM.placeholder) || '';

    return `
      <div class="${colClass}">
        <div class="tm-product-card" data-product-id="${p.id}">
          
          <!-- Top Floating Actions & Badges -->
          <div class="tm-product-media">
            <span class="tm-product-save-badge">${badgeText}</span>
            
            <div class="tm-product-actions-group">
              <button type="button" class="tm-product-action-btn ${isWishlisted ? 'active' : ''}" 
                data-wishlist-id="${p.id}" 
                onclick="Wishlist.toggle({id:'${p.id}', name:'${safeName}', brand:'${safeBrand}', price:${p.price}, mrp:${p.mrp || p.price}, image:'${safeImage}'})" 
                title="${isWishlisted ? 'Remove from Wishlist' : 'Add to Wishlist'}"
                aria-label="Wishlist">
                <i class="bi ${isWishlisted ? 'bi-heart-fill text-danger' : 'bi-heart'}"></i>
              </button>
            </div>

            <a href="${p.url || '#'}" class="tm-product-img-wrap d-flex align-items-center justify-content-center">
              <img src="${safeImage}" alt="${p.name}" class="tm-product-img" loading="lazy">
            </a>
          </div>

          <!-- Card Content Body -->
          <div class="tm-product-body">
            
            <!-- Brand Tag & Rating -->
            <div class="tm-product-brand-tag">
              <span class="tm-brand-name"><i class="bi bi-shield-check text-orange me-1"></i>${p.brand} <span class="tm-origin-text">• ${p.brandOrigin || 'Global'}</span></span>
              <span class="tm-rating-chip"><i class="bi bi-star-fill text-warning"></i> ${(p.rating || 4.9).toFixed(1)} <span class="text-muted tm-reviews-count">(${p.reviews || 20})</span></span>
            </div>

            <!-- Title -->
            <h6 class="tm-product-title">
              <a href="${p.url || '#'}" title="${p.name}">${p.name}</a>
            </h6>

            <!-- Tech Spec Chips -->
            <div class="tm-product-specs-chips">
              ${p.style ? `<span class="tm-spec-chip tm-spec-style"><i class="bi bi-soundwave"></i> ${p.style}</span>` : ''}
              ${p.rechargeable ? `<span class="tm-spec-chip tm-spec-recharge"><i class="bi bi-battery-charging text-success"></i> Rechargeable</span>` : ''}
              ${p.bluetooth ? `<span class="tm-spec-chip tm-spec-bt"><i class="bi bi-bluetooth text-primary"></i> Bluetooth</span>` : ''}
              ${p.channels ? `<span class="tm-spec-chip tm-spec-channels"><i class="bi bi-cpu"></i> ${p.channels} Ch</span>` : ''}
              ${p.featureHighlight ? `<span class="tm-spec-chip tm-spec-feature">${p.featureHighlight}</span>` : ''}
            </div>

            <!-- Pricing & Add to Cart Row -->
            <div class="tm-product-price-row">
              <div>
                <div class="tm-product-sale-price">₹${p.price.toLocaleString('en-IN')}</div>
                ${p.mrp && p.mrp > p.price ? `<div class="tm-product-mrp">MRP: ₹${p.mrp.toLocaleString('en-IN')}</div>` : ''}
              </div>
              <button type="button" class="tm-product-btn-cart" 
                onclick="Cart.addItem({id:'${p.id}', name:'${safeName}', brand:'${safeBrand}', price:${p.price}, mrp:${p.mrp || p.price}, image:'${safeImage}'})" title="Add to Cart">
                <i class="bi bi-cart-plus-fill"></i> Add to Cart
              </button>
            </div>

            ${isWishlistPage ? `
            <!-- Dedicated Remove Button on Wishlist Page -->
            <div class="tm-product-wishlist-actions mt-2 pt-2 border-top">
              <button type="button" class="tm-btn tm-btn-sm tm-btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-1"
                onclick="Wishlist.toggle({id:'${p.id}', name:'${safeName}'})" title="Remove product from Wishlist">
                <i class="bi bi-trash3"></i> Remove from Wishlist
              </button>
            </div>
            ` : ''}

          </div>

        </div>
      </div>
    `;
  },

  /**
   * Render list of products into a DOM container
   */
  renderGrid(containerOrSelector, products, options = {}) {
    const container = typeof containerOrSelector === 'string' 
      ? document.querySelector(containerOrSelector) 
      : containerOrSelector;
    
    if (!container) return;

    if (!products || products.length === 0) {
      const contactUrl = (window.TM && window.TM.routes && window.TM.routes.contact) ? window.TM.routes.contact : '/contact-us';
      container.innerHTML = `
        <div class="col-12 d-flex justify-content-center w-100">
          <div class="tm-empty-state-card">
            <div class="tm-empty-state-icon">
              <i class="bi bi-search"></i>
            </div>
            <h4 class="tm-empty-state-title">No Products Available</h4>
            <p class="tm-empty-state-text">
              Try selecting another brand or explore all hearing aids.
            </p>
            <div class="tm-empty-state-actions">
              <a href="${contactUrl}" class="tm-btn tm-btn-primary btn-sm px-4">
                <i class="bi bi-headset me-1"></i> Contact Us
              </a>
            </div>
          </div>
        </div>
      `;
      return;
    }

    container.innerHTML = products.map(p => this.renderCard(p, options)).join('');

    // Re-bind wishlist active state
    if (typeof Wishlist !== 'undefined' && Wishlist.updateIcons) {
      Wishlist.updateIcons();
    }
  },

  /**
   * Auto-initialize all declarative containers on DOM load
   */
  init() {
    // 1. Containers with data-tm-products (e.g. data-tm-products="popular", data-tm-products="invisible", data-tm-products="brand:phonak")
    document.querySelectorAll('[data-tm-products]').forEach(el => {
      const type = el.getAttribute('data-tm-products');
      const limit = parseInt(el.getAttribute('data-tm-limit') || '4', 10);
      const colClass = el.getAttribute('data-tm-col') || 'col-xl-3 col-lg-4 col-md-6';
      
      let list = [];
      if (type === 'all') {
        list = this.filter({ limit });
      } else if (type === 'popular') {
        list = this.filter({ isPopular: true, limit });
        if (list.length === 0) list = this.filter({ limit });
      } else if (type === 'invisible') {
        list = this.filter({ style: ['IIC', 'CIC'], limit });
      } else if (type === 'rechargeable') {
        list = this.filter({ rechargeableOnly: true, limit });
      } else if (type === 'bte') {
        list = this.filter({ style: 'BTE', limit });
      } else if (type === 'chargers' || type === 'accessories') {
        list = this.filter({ category: ['chargers', 'batteries', 'hearing-aid-charger'], limit });
      } else if (type.startsWith('brand:')) {
        const brand = type.replace('brand:', '');
        list = this.filter({ brand, limit });
      } else {
        list = this.filter({ limit });
      }

      this.renderGrid(el, list, { colClass });
    });

    // 2. Interactive tab showcase controller (for homepage tabbed featured cards)
    this.initInteractiveTabs();

    // 3. Interactive brand switcher controller (for homepage brand ecosystem)
    this.initBrandSwitchers();
  },

  initInteractiveTabs() {
    const tabButtons = document.querySelectorAll('[data-tm-filter-tab]');
    const targetGrid = document.getElementById('tmInteractiveFeaturedGrid');
    const viewAllBtn = document.getElementById('tmFeaturedViewAllBtn');
    if (!tabButtons.length || !targetGrid) return;

    tabButtons.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        tabButtons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const filterKey = btn.getAttribute('data-tm-filter-tab');
        let filtered = [];

        const baseProdUrl = (window.TM && window.TM.routes && window.TM.routes.products) ? window.TM.routes.products : '/products';

        if (filterKey === 'all') {
          filtered = this.filter({ limit: 12 });
          if (!filtered.length) filtered = this.getAll().slice(0, 12);
          if (viewAllBtn) {
            viewAllBtn.href = baseProdUrl;
            viewAllBtn.innerHTML = 'View All Products <i class="bi bi-arrow-right ms-1"></i>';
          }
        } else if (filterKey === 'popular') {
          filtered = this.filter({ isPopular: true, limit: 12 });
          if (!filtered.length) filtered = this.filter({ limit: 12 });
          if (viewAllBtn) {
            viewAllBtn.href = baseProdUrl;
            viewAllBtn.innerHTML = 'View All Products <i class="bi bi-arrow-right ms-1"></i>';
          }
        } else if (filterKey === 'invisible') {
          filtered = this.filter({ style: ['IIC', 'CIC'], limit: 12 });
          if (viewAllBtn) {
            viewAllBtn.href = `${baseProdUrl}?style[]=IIC&style[]=CIC`;
            viewAllBtn.innerHTML = 'Explore All Invisible Models <i class="bi bi-arrow-right ms-1"></i>';
          }
        } else if (filterKey === 'rechargeable') {
          filtered = this.filter({ rechargeableOnly: true, limit: 12 });
          if (viewAllBtn) {
            viewAllBtn.href = baseProdUrl;
            viewAllBtn.innerHTML = 'Explore Rechargeable Models <i class="bi bi-arrow-right ms-1"></i>';
          }
        } else if (filterKey === 'bte') {
          filtered = this.filter({ style: 'BTE', limit: 12 });
          if (viewAllBtn) {
            viewAllBtn.href = `${baseProdUrl}?style[]=BTE`;
            viewAllBtn.innerHTML = 'Explore BTE Models <i class="bi bi-arrow-right ms-1"></i>';
          }
        } else if (filterKey === 'accessories') {
          filtered = this.filter({ category: ['chargers', 'batteries', 'hearing-aid-charger'], limit: 12 });
          if (viewAllBtn) {
            viewAllBtn.href = `${baseProdUrl}?category[]=hearing-aid-charger`;
            viewAllBtn.innerHTML = 'Explore All Accessories <i class="bi bi-arrow-right ms-1"></i>';
          }
        } else {
          // Dynamic category slug filtering
          const catKey = (filterKey || '').toLowerCase().replace(/^category:/, '').trim();
          filtered = this.products.filter(p => {
            const pCat = (p.category || '').toLowerCase();
            const pCatName = (p.categoryName || '').toLowerCase();
            const pBrand = (p.brand || '').toLowerCase();
            const pStyle = (p.style || '').toLowerCase();
            return pCat === catKey || 
                   pCatName === catKey ||
                   pCat.includes(catKey) || 
                   catKey.includes(pCat) ||
                   pBrand === catKey ||
                   catKey.includes(pBrand);
          }).slice(0, 12);

          if (viewAllBtn) {
            viewAllBtn.href = `${baseProdUrl}?category[]=${encodeURIComponent(catKey)}`;
            const tabName = btn.textContent.trim();
            viewAllBtn.innerHTML = `Explore All ${tabName} <i class="bi bi-arrow-right ms-1"></i>`;
          }
        }

        // Smooth transition effect
        targetGrid.style.opacity = '0.3';
        targetGrid.style.transform = 'translateY(8px)';
        targetGrid.style.transition = 'all 0.2s ease';

        setTimeout(() => {
          this.renderGrid(targetGrid, filtered, { colClass: 'col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3' });
          targetGrid.style.opacity = '1';
          targetGrid.style.transform = 'translateY(0)';
        }, 150);
      });
    });

    // Category strip left/right arrow navigation
    const catPrevBtn = document.getElementById('tmCategoryPrevBtn');
    const catNextBtn = document.getElementById('tmCategoryNextBtn');
    const catStrip = document.getElementById('tmCategoryTabsStrip') || document.querySelector('.tm-category-tabs-strip');

    if (catPrevBtn && catNextBtn && catStrip) {
      catPrevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (catStrip.scrollLeft <= 10) {
          catStrip.scrollTo({ left: catStrip.scrollWidth, behavior: 'smooth' });
        } else {
          catStrip.scrollBy({ left: -240, behavior: 'smooth' });
        }
      });

      catNextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const maxScroll = catStrip.scrollWidth - catStrip.clientWidth;
        if (catStrip.scrollLeft >= maxScroll - 10) {
          catStrip.scrollTo({ left: 0, behavior: 'smooth' });
        } else {
          catStrip.scrollBy({ left: 240, behavior: 'smooth' });
        }
      });
    }
  },

  initBrandSwitchers() {
    const brandTabs = document.querySelectorAll('[data-tm-brand-tab]');
    const brandGrid = document.getElementById('tmBrandShowcaseGrid');
    const brandNameEl = document.getElementById('tmActiveBrandName');
    const brandUspEl = document.getElementById('tmActiveBrandUsp');
    const brandOriginEl = document.getElementById('tmActiveBrandOrigin');
    const brandViewAllBtn = document.getElementById('tmBrandViewAllBtn');

    if (!brandTabs.length || !brandGrid) return;

    brandTabs.forEach(tab => {
      tab.addEventListener('click', (e) => {
        e.preventDefault();
        brandTabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        const brand = tab.getAttribute('data-tm-brand-tab');
        let brandProducts = [];
        const baseProdUrl = (window.TM && window.TM.routes && window.TM.routes.products) ? window.TM.routes.products : '/products';

        if (!brand || brand === 'all') {
          if (brandNameEl) brandNameEl.textContent = 'All Authorized Brands';
          if (brandUspEl) brandUspEl.textContent = '• Official warranty & clinical precision across all global brands';
          if (brandOriginEl) brandOriginEl.textContent = 'Global Premium Technology';
          if (brandViewAllBtn) {
            brandViewAllBtn.href = baseProdUrl;
            brandViewAllBtn.innerHTML = 'Explore All Hearing Aids <i class="bi bi-arrow-right ms-1"></i>';
          }
          brandProducts = this.filter({ limit: 4 });
          if (!brandProducts.length) brandProducts = this.getAll().slice(0, 4);
        } else {
          // Values provided dynamically by the Brand database model in the view
          const origin = tab.getAttribute('data-tm-brand-origin') || 'Global Manufacturer';
          const usp    = tab.getAttribute('data-tm-brand-usp') || `• Official authorized dispenser for genuine ${brand} digital hearing aids & warranty`;
          const url    = tab.getAttribute('data-tm-brand-url') || `${baseProdUrl}?brand[]=${encodeURIComponent(brand)}`;

          if (brandNameEl) brandNameEl.textContent = brand;
          if (brandUspEl) brandUspEl.textContent = usp;
          if (brandOriginEl) brandOriginEl.textContent = origin;
          if (brandViewAllBtn) {
            brandViewAllBtn.href = url;
            brandViewAllBtn.innerHTML = `Explore All ${brand} Models <i class="bi bi-arrow-right ms-1"></i>`;
          }

          brandProducts = this.filter({ brand, limit: 4 });
        }

        brandGrid.style.opacity = '0.3';
        brandGrid.style.transform = 'translateY(8px)';
        brandGrid.style.transition = 'all 0.2s ease';

        setTimeout(() => {
          this.renderGrid(brandGrid, brandProducts, { colClass: 'col-xl-3 col-lg-3 col-md-6 col-sm-6 mb-3' });
          brandGrid.style.opacity = '1';
          brandGrid.style.transform = 'translateY(0)';
        }, 150);
      });
    });

    // Brand strip left/right arrow navigation
    const prevBtn = document.getElementById('tmBrandPrevBtn');
    const nextBtn = document.getElementById('tmBrandNextBtn');
    const brandStrip = document.getElementById('tmBrandTabsStrip') || document.querySelector('.tm-brand-tabs-strip');

    if (prevBtn && nextBtn && brandStrip) {
      prevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (brandStrip.scrollLeft <= 10) {
          brandStrip.scrollTo({ left: brandStrip.scrollWidth, behavior: 'smooth' });
        } else {
          brandStrip.scrollBy({ left: -280, behavior: 'smooth' });
        }
      });

      nextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const maxScroll = brandStrip.scrollWidth - brandStrip.clientWidth;
        if (brandStrip.scrollLeft >= maxScroll - 10) {
          brandStrip.scrollTo({ left: 0, behavior: 'smooth' });
        } else {
          brandStrip.scrollBy({ left: 280, behavior: 'smooth' });
        }
      });
    }
  }
};

// Initialize on DOM ready if in browser
if (typeof document !== 'undefined') {
  document.addEventListener('DOMContentLoaded', () => {
    TurtleProducts.init();
  });
}

// Node/CommonJS export for testing/tooling
if (typeof module !== 'undefined' && module.exports) {
  module.exports = { TURTLE_PRODUCTS, TurtleProducts };
}
