    <div class="modal fade" id="s1_s2_sub_model" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="card" style="margin-bottom:0">
                    <div class="card-header">
                        <strong>View The Whole Product</strong> Details
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="card-body card-block" id="s1_s2_sub">
                    <div class='row form-group'>
                        <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_name' class='form-control-label'>Product Name</label>
                                        <input type='text' id='s1_product_name' name='s1_product_name' class='form-control' disabled />
                                    </div>
                                </div> 
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_cat' class='form-control-label'>Product Catagory :</label>
                                        <select id='s1_product_cat' name='s1_product_cat' class='form-control' disabled ></select>
                                    </div>
                                </div> 
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='pro_mar_brand' class=' form-control-label'>Product Marketing Company</label>
                                        <select id='s1_pro_mar_brand' name='s1_pro_mar_brand' class='form-control' disabled ></select>
                                    </div>
                                </div> 
                            </div>
                            <div class='row form-group'>
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='pro_manu_brand' class=' form-control-label'>Product Manufacturer Company</label>
                                        <select id='s1_pro_manu_brand' name='s1_pro_manu_brand' class='form-control' disabled ></select>
                                    </div>
                                </div> 
                                <div class='col-4'>
                                    <div class='form-group'>
                                        <label for='product_tax_slab' class=' form-control-label'>TAX SLAB (in %)</label>
                                        <input type='text' id='s1_product_tax_slab' class='form-control' disabled />
                                    </div>
                                </div>
                                
                            </div>
                            <div class='row form-group'>
                                <div class='col-3'>
                                    <div class='form-group'>
                                        <label for='product_desc' class=' form-control-label'>Description</label>
                                        <textarea name='s1_product_desc' id='s1_product_desc' rows='5' class='form-control' disabled ></textarea>
                                    </div>
                                </div>           
                                <div class='col-3'>
                                    <div class='form-group'>
                                        <label for='product_storage_tips' class='form-control-label'>Storage Tips</label>
                                        <textarea id='s1_product_storage_tips' name='s1_product_storage_tips' class='form-control' rows='5' disabled ></textarea>
                                    </div>
                                </div>
                                <div class='col-3'>
                                    <div class='form-group'>
                                        <label for='product_benifits' class=' form-control-label'>Benifits</label>
                                        <textarea name='s1_product_benifits' id='s1_product_benifits' rows='5' class='form-control' disabled ></textarea>
                                    </div>
                                </div>           
                                <div class='col-3'>
                                    <div class='form-group'>
                                        <label for='product_usage' class='form-control-label'>Usage</label>
                                        <textarea id='s1_product_usage' name='s1_product_usage' class='form-control' rows='5' disabled ></textarea>
                                    </div>
                                </div>             
                            </div>
                    </div>
                    <center><h3>Avilable Product List</h3>
                        <div id='s1_s2_sub_msg' style='width : 60%'></div>
                    </center>

                    <div class="table-responsive table-data" style="background:white">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>SKU</td>
                                    <td>Title</td>
                                    <td>EAN</td>
                                    <td>Selling Rate</td>
                                    <td>MRP</td>
                                    <td>Total Stock</td>
                                    <td>Warranty Info</td>
                                    <td>Max Order</td>
                                    <td>Addi. Info. </td>
                                    <td>Product Image 1</td>
                                    <td>Product Image 2</td>
                                    <td>Product Image 3</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody id="s1_s2_tbl">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>