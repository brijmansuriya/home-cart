let site = new SiteGlobal();

// Generate The Catagory List
function ProductcatagoryList(){
    var data = new FormData();
    data.append('action','get_product_catagory_list');
    return site.ControlGenerator('private/script/server/category-master.php','POST',data);
}

// Generate The Brand List
function ProductBrandList(){
    var data = new FormData();
    data.append('action','get_product_brand_list');
    return site.ControlGenerator('private/script/server/Class/ProductBrand.php','POST',data);
}

function product_card() {
    var data = new FormData();
    data.append('action','user_product_card');
    return site.ControlGenerator('private/script/server/Class/ProductMaster.php','POST',data);
}
function GenerateCart(user){
    var data = new FormData();
    data.append('user_ref',user);
    data.append('action','GenerateCart');
    site.Transaction('private/script/server/Class/CustomerCart.php','POST',data,'#product_msg');
}

function GetProductData(ref){
    var data = new FormData();
    data.append('ref',ref)
    data.append('action','GetProductDetails');
    return site.ControlGenerator('private/script/server/Class/ProductMaster.php','POST',data);
}

function AddToCart(e) {
    var data = new FormData();
    data.append('user_ref',user_ref);
    data.append('product_ref',e.getAttribute('value'));
    data.append('product_qty',$('#product_qty').val());
    data.append('action','AddToCart');
    site.Transaction('private/script/server/Class/CustomerCart.php','POST',data,'#product_msg');
}


$(document).ready(function(e){
    $('#product-catagory').html(ProductcatagoryList());
    
    $('#product-brand').html(ProductBrandList());
    
    $('#product_card_section').html(product_card());
    
    //$('#cart_body').html(GenerateCart(user_ref));
    
    $('#product_detail_section').html(GetProductData(product_ref));
    
});