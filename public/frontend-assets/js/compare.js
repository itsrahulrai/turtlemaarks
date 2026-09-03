/**
 * TURTLE MAARKS — PRODUCT COMPARISON ENGINE (DEPRECATED & REMOVED)
 */

if (typeof localStorage !== 'undefined') {
  localStorage.removeItem('turtle_compare');
}

const Compare = {
  getList() { return []; },
  toggle() {},
  renderBar() {
    const bar = document.getElementById('tmCompareFloatingBar');
    if (bar) bar.remove();
  },
  renderPage() {}
};

document.addEventListener('DOMContentLoaded', () => {
  Compare.renderBar();
});

