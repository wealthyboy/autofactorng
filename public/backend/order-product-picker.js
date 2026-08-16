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
            panel.innerHTML = '<div class="product-autocomplete-empty">No catalogue match. The name you typed will be saved as an unlisted item.</div>';
            panel.classList.remove('d-none');
            return;
        }

        products.forEach(function (product) {
            var option = document.createElement('button');
            option.type = 'button';
            option.className = 'product-autocomplete-option';
            var productMeta = escapeHtml(product.sku || 'No SKU') + ' · ' + product.quantity + ' in stock';
            var image = product.image
                ? '<img class="product-autocomplete-image" src="' + escapeHtml(product.image) + '" alt="">'
                : '';
            option.innerHTML = '<span class="product-autocomplete-details">' + image + '<span><strong>' + escapeHtml(product.name) + '</strong><br><small class="text-muted">' + productMeta + '</small></span></span><strong>' + money(product.price) + '</strong>';
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
        picker.querySelector('.product-selection-status').textContent = 'Select a catalogue result, or keep this name as an unlisted item.';
        clearTimeout(timers.get(input));

        if (input.value.trim().length < 2) {
            panel.classList.add('d-none');
            return;
        }

        timers.set(input, setTimeout(function () {
            fetch('/admin/orders/products/search?q=' + encodeURIComponent(input.value.trim()), {
                headers: { 'Accept': 'application/json' },
                cache: 'no-store'
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
        closeAll(event.target.closest('.product-autocomplete-results'));
    });

    document.addEventListener('submit', function (event) {
        var productRows = event.target.querySelectorAll('.product-items');

        productRows.forEach(function (row, position) {
            var positionInput = row.querySelector('.order-product-sort-order');
            if (positionInput) positionInput.value = position;
        });
    });
})();
