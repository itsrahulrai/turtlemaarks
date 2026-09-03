/**
 * TURTLE MAARKS — WISHLIST (server-backed)
 *
 * Saved products live in the `wishlists` table so they follow the patient
 * across devices and are visible to the clinic in the admin panel.
 * Guests are sent to the login page with their intended action preserved.
 */

const Wishlist = {
  ids() {
    return (window.TM && Array.isArray(window.TM.wishlistIds)) ? window.TM.wishlistIds.map(String) : [];
  },

  has(id) {
    return this.ids().includes(String(id));
  },

  async toggle(item) {
    if (!item || !item.id) return;

    if (!window.TM || !window.TM.auth) {
      showToast('Sign in required', 'Please sign in to save products to your wishlist.', 'info');
      setTimeout(() => { window.location.href = window.TM.routes.login; }, 900);
      return;
    }

    try {
      const res = await fetch(window.TM.routes.wishlistToggle, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest',
          'X-CSRF-TOKEN': window.TM.csrf
        },
        body: JSON.stringify({ product_id: item.id })
      });

      const data = await res.json();
      if (!res.ok || !data.success) {
        showToast('Could not update wishlist', data.message || 'Please try again.', 'warning');
        return;
      }

      const ids = this.ids().filter(id => id !== String(item.id));
      if (data.inWishlist) ids.push(String(item.id));
      window.TM.wishlistIds = ids;

      this.updateIcons();
      updateWishlistBadge(data.count);
      showToast(data.inWishlist ? 'Saved to Wishlist' : 'Removed from Wishlist', `${item.name}`, data.inWishlist ? 'success' : 'info');

      // On the wishlist page itself, drop the card out of the grid immediately.
      if (!data.inWishlist && document.getElementById('tmWishlistGrid')) {
        const card = document.querySelector(`.tm-product-card[data-product-id="${item.id}"]`);
        if (card) {
          const col = card.closest('[class*="col-"]');
          (col || card).remove();
          if (!document.querySelectorAll('#tmWishlistGrid .tm-product-card').length) window.location.reload();
        }
      }
    } catch (e) {
      showToast('Network error', 'We could not reach the clinic server. Please try again.', 'warning');
    }
  },

  /** Paint the heart icons to match the saved state. */
  updateIcons() {
    const saved = this.ids();
    document.querySelectorAll('[data-wishlist-id]').forEach(btn => {
      const on = saved.includes(String(btn.getAttribute('data-wishlist-id')));
      btn.classList.toggle('active', on);
      const icon = btn.querySelector('i');
      if (icon) {
        icon.classList.toggle('bi-heart-fill', on);
        icon.classList.toggle('bi-heart', !on);
        icon.classList.toggle('text-danger', on);
      }
    });
  },

  count() {
    return this.ids().length;
  }
};

function updateWishlistBadge(count) {
  document.querySelectorAll('.tm-wishlist-badge-count').forEach(el => {
    el.textContent = count;
    el.style.display = count > 0 ? '' : 'none';
  });
}

document.addEventListener('DOMContentLoaded', () => {
  Wishlist.updateIcons();
  updateWishlistBadge(Wishlist.count());
});
