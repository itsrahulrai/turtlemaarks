/**
 * TURTLE MAARKS — CART ENGINE (server-backed)
 *
 * Every operation goes through the Laravel cart (App\Services\CartService),
 * so the drawer, the cart page, checkout and the admin panel always agree.
 * The old localStorage store has been removed.
 */

const Cart = {
  state: { count: 0, items: [], totals: { subtotal: 0, discount: 0, shipping: 0, total: 0 } },

  headers() {
    return {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': window.TM ? window.TM.csrf : ''
    };
  },

  /** Pull the authoritative cart from the server and repaint everything. */
  async refresh() {
    try {
      const res = await fetch(window.TM.routes.cartData, { headers: this.headers() });
      const data = await res.json();
      this.state = data;
      updateGlobalBadges(data.count);
      this.renderDrawer();
    } catch (e) {
      /* offline / session expired — leave the last painted state */
    }
  },

  async addItem(item) {
    if (!item || !item.id) return;

    try {
      const res = await fetch(window.TM.routes.cartAdd, {
        method: 'POST',
        headers: this.headers(),
        body: JSON.stringify({ product_id: item.id, quantity: item.qty || 1 })
      });

      const data = await res.json();

      if (!res.ok || !data.success) {
        showToast('Could not add item', data.message || 'Please try again.', 'warning');
        return;
      }

      await this.refresh();
      showToast('Added to Cart', `${item.name} has been added to your shopping cart.`, 'success');

      const drawerEl = document.getElementById('tmCartDrawer');
      if (drawerEl && typeof bootstrap !== 'undefined') {
        bootstrap.Offcanvas.getOrCreateInstance(drawerEl).show();
      }
    } catch (e) {
      showToast('Network error', 'We could not reach the clinic server. Please try again.', 'warning');
    }
  },

  async removeItem(cartId) {
    try {
      await fetch(`${window.TM.routes.cartUpdate}/${cartId}`, {
        method: 'DELETE',
        headers: this.headers()
      });
      await this.refresh();
      showToast('Item Removed', 'Item has been removed from your cart.', 'info');
    } catch (e) { /* ignore */ }
  },

  async setQty(cartId, qty) {
    if (qty < 1) return this.removeItem(cartId);

    try {
      await fetch(`${window.TM.routes.cartUpdate}/${cartId}`, {
        method: 'PATCH',
        headers: this.headers(),
        body: JSON.stringify({ quantity: qty })
      });
      await this.refresh();
    } catch (e) { /* ignore */ }
  },

  updateQty(cartId, delta) {
    const item = this.state.items.find(i => String(i.id) === String(cartId));
    if (!item) return;
    this.setQty(cartId, item.qty + delta);
  },

  money(value) {
    return '₹' + Number(value || 0).toLocaleString('en-IN');
  },

  renderDrawer() {
    const container = document.getElementById('tmCartDrawerItems');
    const grandTotalEl = document.getElementById('tmCartDrawerGrandTotal');
    const countEl = document.getElementById('tmCartDrawerCount');
    if (!container) return;

    const { items, totals } = this.state;

    if (countEl) countEl.textContent = this.state.count || 0;
    if (grandTotalEl) grandTotalEl.textContent = this.money(totals.total);

    if (!items || items.length === 0) {
      container.innerHTML = `
        <div class="text-center py-5">
          <div class="mb-3"><i class="bi bi-cart-x text-muted" style="font-size: 3.5rem;"></i></div>
          <h6 class="fw-bold text-navy mb-1">Your Shopping Cart is Empty</h6>
          <p class="text-secondary small mb-3">Add hearing devices, test packages, or batteries to start.</p>
          <a href="${window.TM.routes.products}" class="tm-btn tm-btn-primary tm-btn-sm">Browse Products</a>
        </div>`;
      return;
    }

    container.innerHTML = items.map(item => `
      <div class="d-flex gap-3 align-items-center border-bottom pb-3 mb-3">
        <img src="${item.image}" alt="${item.name}" class="rounded-3 border bg-white p-1" style="width: 58px; height: 58px; object-fit: contain;">
        <div class="flex-grow-1">
          <div class="fw-bold text-navy small mb-1">${item.name}</div>
          <div class="text-muted" style="font-size: 0.75rem;">${item.brand}</div>
          <div class="d-flex align-items-center gap-2 mt-1">
            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="Cart.updateQty('${item.id}', -1)">−</button>
            <span class="small fw-bold">${item.qty}</span>
            <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2" onclick="Cart.updateQty('${item.id}', 1)">+</button>
            <span class="ms-auto fw-bold text-orange small">${this.money(item.lineTotal)}</span>
          </div>
        </div>
        <button type="button" class="btn btn-sm btn-link text-danger p-0" onclick="Cart.removeItem('${item.id}')" title="Remove">
          <i class="bi bi-trash3"></i>
        </button>
      </div>`).join('');
  }
};

document.addEventListener('DOMContentLoaded', () => {
  if (window.TM && window.TM.routes) Cart.refresh();
});
