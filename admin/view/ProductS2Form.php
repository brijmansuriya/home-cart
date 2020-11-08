    <div class="modal fade" id="product_model" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="card" style="margin-bottom:0">
                    <div class="card-header">
                        <strong>Add Product</strong> Details
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="card-body card-block" id="">
                        <form id='frm_new_product_s2' name='frm_new_product_s2'>
                            <div class='card-body card-block'>
                                <div class='row form-group'>
                                    <div class='col-12' id='product_msg'>

                                    </div>
                                </div>
                                <div class='row form-group'>
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='p_product_dd' class='form-control-label'>Select Parent Product Code</label>
                                            <input type='text' name='p_code' id='p_code' class='form-control'  disabled />
                                            <!--<select id='p_product_dd' class='form-control'>
                                                <option value=-1>None</option>
                                            </select>-->
                                        </div>
                                    </div> 
                                    <!--<div class='col-4'>
                                        <div class='form-group'>
                                            <label for='p_name' class='form-control-label'>Name :</label>
                                            <input type='text' name='p_name' id='p_name' class='form-control'  disabled />
                                        </div>
                                    </div>-->
                                </div>
                                <div class='row form-group'>
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='sku' class=' form-control-label'>SKU</label>
                                            <input type='text' id='sku' name='sku' placeholder='Product SKU' class='form-control'  />
                                        </div>
                                    </div> 
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='title' class=' form-control-label'>Title :</label>
                                            <input type='text' name='title' id='title' placeholder='Product Title' class='form-control'  />
                                        </div>
                                    </div> 
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='ean' class=' form-control-label'>EAN</label>
                                            <input type='text' name='ean' id='ean' placeholder='Product EAN' class='form-control'  />
                                        </div>
                                    </div> 
                                </div>
                                <div class='row form-group'>
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='product_package_unit' class=' form-control-label'>Packaging Units</label>
                                            <select class='form-control' id='product_package_unit' name='product_package_unit'></select>
                                        </div>
                                    </div> 
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='product_selling_rate' class='form-control-label'>Selling Rate</label>
                                            <input type='text' id='product_selling_rate' placeholder='Product Selling Rate (Without TAX)' class='form-control' />
                                        </div>
                                    </div>
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='product_mrp' class='form-control-label'>MRP</label>
                                            <input type='text' id='product_mrp' placeholder='Actual Product MRP (Printed On Product)' class='form-control' />
                                        </div>
                                    </div>   
                                </div>
                                <div class='row form-group'>                    
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='product_stock' class='form-control-label'>Total Stock </label>
                                            <input type='text' id='product_stock' placeholder='Total Avialable Stock In Warehouse' class='form-control' />
                                        </div>
                                    </div>
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='product_net_qty' class=' form-control-label'>Net Product Qty</label>
                                            <input type='text' id='product_net_qty' placeholder='Product Net Quantity As Per Product Unit' class='form-control' />
                                        </div>
                                    </div>           
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for=' class='form-control-label'>Product Diamantion in Inch (Only)</label>
                                            <div class='row for-group'>
                                                <div class='col-4'>
                                                    <div class='form-group'>
                                                        <input type='text' name='p_height' id='p_height' placeholder='height' class='form-control'>
                                                    </div>
                                                </div>x 
                                                <div class='col-3'>
                                                    <div class='form-group'>
                                                        <input type='text' name='p_width' id='p_width' placeholder='width' class='form-control'>
                                                    </div>
                                                </div>x 
                                                <div class='col-4'>
                                                    <div class='form-group'>
                                                        <input type='text' name='p_length' id='p_length' placeholder='length' class='form-control'>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>             
                                </div>
                                <div class='row form-group'>                    
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='product_warranty' class='form-control-label'>Warranty Information | If Applicable </label>
                                            <input type='text' id='product_warranty' placeholder='Actual Product Warranty Info' class='form-control' />
                                        </div>
                                    </div>
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='product_max_per_cust' class='form-control-label' style='font-size:14px'>Maximum Qty Per Customer As Per Product Unit</label>
                                            <input type='text' id='product_max_per_cust' placeholder='Maximum Order Per Customer' class='form-control' />
                                        </div>
                                    </div>           
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='product_additional_info' class='form-control-label'>Additional Information </label>
                                            <textarea type='text' id='product_additional_info' class='form-control' row='0'></textarea>
                                        </div>
                                    </div>             
                                </div>
                                <div class='row form-group'>                    
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='product_img1' class='form-control-label'>Product Image 1 </label>
                                            <input type='file' id='product_img1' class='form-control' />
                                        </div>
                                    </div>
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='product_img2' class='form-control-label'>Product Image 2 </label>
                                            <input type='file' id='product_img2' class='form-control' />
                                        </div>
                                    </div>           
                                    <div class='col-4'>
                                        <div class='form-group'>
                                            <label for='product_img3' class='form-control-label'>Product Image 3 </label>
                                            <input type='file' id='product_img3' class='form-control' />
                                        </div>
                                    </div>             
                                </div>
                                <div class='row form-group m-t-10'>
                                    <div class='col-6'>
                                        <div class='form group'>
                                            <button type='submit' id='save_product' class='col-4 btn btn-primary'>Save</button>
                                        </div>
                                    </div>
                                </div>
                                <div class='row form-group m-t-10'>
                                    <div class='col-6' id='frm_new_product_msg'>
                                    
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    
                    