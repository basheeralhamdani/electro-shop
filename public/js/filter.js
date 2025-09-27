// Filtering & sorting
const categorySelect = document.getElementById('category');
const sortSelect = document.getElementById('sort');
const products = Array.from(document.querySelectorAll('.product-grid .product'));
const grid = document.querySelector('.product-grid');

function applyFilters() {
  const category = categorySelect.value;
  let filtered = products;

  if (category !== 'all') {
    filtered = products.filter(p => p.dataset.category === category);
  }

  // Sorting
  const sort = sortSelect.value;
  if (sort === 'name') {
    filtered.sort((a, b) => a.dataset.name.localeCompare(b.dataset.name));
  } else if (sort === 'price-low') {
    filtered.sort((a, b) => parseInt(a.dataset.price) - parseInt(b.dataset.price));
  } else if (sort === 'price-high') {
    filtered.sort((a, b) => parseInt(b.dataset.price) - parseInt(a.dataset.price));
  }

  // Re-render
  grid.innerHTML = '';
  filtered.forEach(p => grid.appendChild(p));
}

categorySelect.addEventListener('change', applyFilters);
sortSelect.addEventListener('change', applyFilters);
