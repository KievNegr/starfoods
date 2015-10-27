$(document).ready(function()
{
	$('html').on('click', '.get-buy', function()
	{
		id = $(this).attr('id');

		name = $('#cart_name_' + id).val();
		id = $('#cart_id_' + id).val();
		price = $('#cart_price_' + id).val();
		cartImg = $('#cart_img_' + id).val();

		$.ajax({
			type: 'post',
			url: 'http://starfoods/main/setInCart',
			data: {
				'name': name,
				'id': id,
				'price': price,
				'img': cartImg
			},
			success: okSetInCart
		});

	});

	function okSetInCart(data)
	{
		$('.cart-header-link').fadeIn();
		$('.load-cart').html('Корзина (' + data + ')');
	}
});