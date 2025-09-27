        document.addEventListener('DOMContentLoaded', function () {
            // Select all "add to cart" forms
            const addToCartForms = document.querySelectorAll('.add-to-cart-form');

            addToCartForms.forEach(form => {
                form.addEventListener('submit', function (event) {
                    // 1. Prevent the default page reload
                    event.preventDefault();

                    const form = this;
                    const url = form.action;
                    const formData = new FormData(form);

                    // 2. Send the request in the background (AJAX)
                    fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // 3. Update the cart count in the header
                            updateCartCount(data.cartCount);
                            
                            // Optional: Show a success toast/notification
                            showToast(data.message);
                        } else {
                            // Show an error toast
                            showToast(data.message, true);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('An unexpected error occurred.', true);
                    });
                });
            });

            function updateCartCount(count) {
                const cartBadge = document.getElementById('cart-badge');
                if (cartBadge) {
                    cartBadge.textContent = count;
                    cartBadge.style.display = count > 0 ? 'flex' : 'none';
                }
            }
            
            //  toast notification function
            function showToast(message, isError = false) {
                const toast = document.createElement('div');
                toast.textContent = message;
                toast.style.position = 'fixed';
                toast.style.bottom = '20px';
                toast.style.right = '20px';
                toast.style.backgroundColor = isError ? '#dc3545' : '#10cab7';
                toast.style.color = 'white';
                toast.style.padding = '15px 20px';
                toast.style.borderRadius = '8px';
                toast.style.zIndex = '1001';
                toast.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.remove();
                }, 3000);
            }
        });
