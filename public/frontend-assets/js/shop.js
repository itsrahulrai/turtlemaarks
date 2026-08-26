/**
 * Site-wide shop interactions.
 *
 * Previously, the icon-only "Add to Cart" (.btn-add-to-cart) and
 * "Wishlist" (.btn-wishlist) buttons used on the product card partial
 * (home, category, subcategory, search results, wishlist, related
 * products) had NO JavaScript wired up anywhere in the project, so
 * clicking them did nothing at all. This file fixes that with a single
 * delegated handler that works for every card on the site, present or
 * added later (e.g. after an AJAX filter refresh).
 */

function showToast(message, type = 'success') {
    let container = document.getElementById('tm-toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'tm-toast-container';
        container.style.cssText = 'position:fixed;top:90px;right:20px;z-index:2000;display:flex;flex-direction:column;gap:10px;';
        document.body.appendChild(container);
    }

    const colors = {
        success: { bg: '#0c3c64', icon: 'bi-check-circle-fill' },
        error:   { bg: '#dc3545', icon: 'bi-exclamation-circle-fill' },
    };
    const c = colors[type] || colors.success;

    const toast = document.createElement('div');
    toast.style.cssText = `background:${c.bg};color:#fff;padding:12px 18px;border-radius:10px;font-size:.88rem;font-weight:600;box-shadow:0 10px 25px rgba(0,0,0,.18);display:flex;align-items:center;gap:8px;min-width:220px;opacity:0;transform:translateY(-8px);transition:all .25s ease;`;
    toast.innerHTML = `<i class="bi ${c.icon}"></i><span>${message}</span>`;
    container.appendChild(toast);

    requestAnimationFrame(() => {
        toast.style.opacity = '1';
        toast.style.transform = 'translateY(0)';
    });

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(-8px)';
        setTimeout(() => toast.remove(), 250);
    }, 2500);
}

function updateCartBadge(count) {
    const badge = document.getElementById('cart-count');
    if (!badge) return;
    badge.textContent = count;
    badge.style.display = count > 0 ? '' : 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('click', function (e) {
        // ---- Add to cart (icon button on product cards) ----
        const addBtn = e.target.closest('.btn-add-to-cart');
        if (addBtn && !addBtn.disabled) {
            e.preventDefault();
            const productId = addBtn.dataset.productId;
            if (!productId) return;

            addBtn.disabled = true;
          $.post((window.APP_BASE_URL || '') + '/cart/add', { product_id: productId, quantity: 1 })
                .done(res => {
                    if (res.success) {
                        updateCartBadge(res.count);
                        showToast(res.message || 'Added to cart!', 'success');
                    } else {
                        showToast(res.message || 'Could not add to cart.', 'error');
                    }
                })
                .fail(xhr => {
                    const msg = xhr.status === 401
                        ? 'Please login to add items to your cart.'
                        : 'Could not add to cart. Please try again.';
                    showToast(msg, 'error');
                })
                .always(() => { addBtn.disabled = false; });
            return;
        }

        // ---- Wishlist toggle ----
        const wishBtn = e.target.closest('.btn-wishlist');
        if (wishBtn && wishBtn.dataset.productId) {
            e.preventDefault();
            const productId = wishBtn.dataset.productId;

         $.post((window.APP_BASE_URL || '') + '/wishlist/toggle', { product_id: productId })
                .done(res => {
                    if (res.success) {
                        const icon = wishBtn.querySelector('i');
                        wishBtn.classList.toggle('wishlisted', res.inWishlist);
                        if (icon) icon.className = res.inWishlist ? 'bi bi-heart-fill' : 'bi bi-heart';
                        showToast(res.message, 'success');
                    }
                })
                .fail(xhr => {
                    const msg = xhr.status === 401
                        ? 'Please login to use your wishlist.'
                        : 'Something went wrong. Please try again.';
                    showToast(msg, 'error');
                });
        }
    });
});
