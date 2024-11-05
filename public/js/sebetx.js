$(document).ready(function() {
    // CSRF token'ını ayarla
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Sepete ürün ekleme
    $(document).on('click', '.add-to-cart', function() {
        var productId = $(this).data('id');
        $.post('/cart/add/' + productId, function(response) {
            alert(response.message);
            loadCartItems(); // Sepet ürünlerini güncelle
        }).fail(function(response) {
            alert(response.responseJSON.message);
        });
    });

    // Sepetten ürün silme
    $(document).on('click', '.remove-from-cart', function() {
        var productId = $(this).data('id');
        $.post('/cart/remove/' + productId, function(response) {
            alert(response.message);
            loadCartItems(); // Sepet ürünlerini güncelle
        }).fail(function(response) {
            alert(response.responseJSON.message);
        });
    });

    // Sepet içeriğini yükle
    function loadCartItems() {
        $.get('/cart/items', function(data) {
            var cartItems = '';
            $.each(data, function(index, product) {
                cartItems += `
                    <tr>
                        <td>${product.name}</td>
                        <td>${product.price} TL</td>
                        <td><img src="${product.image_url}" width="50" alt="${product.name}"></td>
                        <td>
                            <button class="btn btn-danger remove-from-cart" data-id="${product.id}">Sil</button>
                        </td>
                    </tr>
                `;
            });
            $('#cart-items tbody').html(cartItems);
        });
    }

    // Sepeti onaylama
    $('#confirm-cart').click(function() {
        $.post('/cart/confirm', function(response) {
            alert(response.message);
            loadCartItems(); // Sepeti boşaltmak için yenile
        }).fail(function(response) {
            alert(response.responseJSON.message);
        });
    });

    // Sayfa yüklendiğinde sepet içeriğini getir
    loadCartItems();
});
