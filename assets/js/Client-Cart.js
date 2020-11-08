let site = new SiteGlobal();

function GenerateCart(user){
    var data = new FormData();
    data.append('user_ref',user);
    data.append('action','GenerateCart');
    return site.ControlGenerator('admin/controller/CustomerCart.php','POST',data);
}

function UpdateQuantity(e){
    var data = new FormData();
    data.append('user_ref',user_ref);
    data.append('product_ref',e.getAttribute('value'));
    data.append('qty',$("#p_qty"+e.getAttribute('value')).val());
    data.append('action','UpdateCartProductQantity');
    site.Transaction('admin/controller/CustomerCart.php','POST',data,'#cart_msg');
}
function DeleteProduct(e){
    var data = new FormData();
    data.append('user_ref',user_ref);
    data.append('product_ref',e.getAttribute('value'));
    data.append('action','DeleteCartProduct');
    site.Transaction('admin/controller/CustomerCart.php','POST',data,'#cart_msg');
}
$(document).ready(function(e){       
    $('#cart_body').html(GenerateCart(user_ref));

    $('#PlaceOrder').on('click',function(){
        var data = new FormData();
        data.append('action','place_order');
        site.Transaction('admin/controller/OrderController.php','POST',data,'#cart_msg');
    });
});