(function () {
    'use strict';

    var timers = new WeakMap();

    function money(value) {
        return '₦' + Number(value || 0).toLocaleString();
    }

    function escapeHtml(value) {
        var div = document.createElement('div');
        div.textContent = value || '';
        return div.innerHTML;
    }

    function closeAll(except) {
        document.querySelectorAll('.product-autocomplete-results').forEach(function (panel) {
            if (panel !== except) panel.classList.add('d-none');
        });
    }

    function renderResults(picker, products) {
        var panel = picker.querySelector('.product-autocomplete-results');
        panel.innerHTML = '';

        if (!products.length) {
            panel.innerHTML = '<div class="product-autocomplete-empty">No catalogue match. Use “Enter custom item” to type it manually.</div>';
            panel.classList.remove('d-none');
            return;
        }

        products.forEach(function (product) {
            var option = document.createElement('button');
            option.type = 'button';
            option.className = 'product-autocomplete-option';
            option.innerHTML = '<span><strong>' + escapeHtml(product.name) + '</strong><br><small class="text-muted">' + escapeHtml(product.sku || 'No SKU') + ' · ' + product.quantity + ' in stock</small></span><strong>' + money(product.price) + '</strong>';
            option.addEventListener('click', function () {
                picker.querySelector('.order-product-search').value = product.name;
                picker.querySelector('.order-product-id').value = product.id;
                picker.querySelector('.product-selection-status').textContent = 'Catalogue product selected · ' + product.quantity + ' currently in stock';
                var row = picker.closest('.product-items');
                var price = row ? row.querySelector('input[name="products[price][]"]') : null;
                if (price) price.value = product.price;
                panel.classList.add('d-none');
            });
            panel.appendChild(option);
        });

        panel.classList.remove('d-none');
    }

    document.addEventListener('input', function (event) {
        if (!event.target.matches('.order-product-search')) return;
        var input = event.target;
        var picker = input.closest('[data-product-picker]');
        var panel = picker.querySelector('.product-autocomplete-results');
        picker.querySelector('.order-product-id').value = '';
        picker.querySelector('.product-selection-status').textContent = 'Typing a custom item until a catalogue result is selected.';
        clearTimeout(timers.get(input));

        if (input.value.trim().length < 2) {
            panel.classList.add('d-none');
            return;
        }

        timers.set(input, setTimeout(function () {
            fetch('/admin/orders/products/search?q=' + encodeURIComponent(input.value.trim()), {
                headers: { 'Accept': 'application/json' }
            })
                .then(function (response) { return response.json(); })
                .then(function (products) { renderResults(picker, products); })
                .catch(function () {
                    panel.innerHTML = '<div class="product-autocomplete-empty">Products could not be loaded. You can still enter a custom item.</div>';
                    panel.classList.remove('d-none');
                });
        }, 250));
    });

    document.addEventListener('click', function (event) {
        var customButton = event.target.closest('.custom-product-toggle');
        if (customButton) {
            var picker = customButton.closest('[data-product-picker]');
            picker.querySelector('.order-product-id').value = '';
            picker.querySelector('.order-product-search').focus();
            picker.querySelector('.product-selection-status').textContent = 'Custom item mode — enter the exact item name and price.';
            picker.querySelector('.product-autocomplete-results').classList.add('d-none');
            return;
        }

        closeAll(event.target.closest('.product-autocomplete-results'));
    });
})();
