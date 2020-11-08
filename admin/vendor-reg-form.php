<div class="navbar-sidebar2">
    <ul class="list-unstyled navbar__list">
        <li class="has-sub">
            <a class="js-arrow" href="#">
                <i class="fas fa-plus"></i>Add Vendor
                <span class="arrow">
                    <i class="fas fa-angle-down"></i>
                </span>
            </a>
            <div class="col-lg-12 m-t-50 list-unstyled navbar__sub-list js-sub-list">
                <div class="card">
                    <div class="card-header">
                        <strong>Add New</strong>
                        <small>Vendor</small>
                    </div>
                    <form id="vendor_reg" name="vendor_reg">
                        <div class="card-body card-block">
                        
                        <div class="card-header">
                            <strong>Vendor Company | Shop Legel Info</strong>
                        </div>
                        
                        <div class="row form-group m-t-30">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="company" class=" form-control-label">Company | Shop Legal Name</label>
                                    <input type="text" id="company" name="company" placeholder="Enter your company | Shop name" class="form-control" required />
                                </div>
                            </div> 
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="established_date" class=" form-control-label">Establishing Date</label>
                                    <input type="date" id="established_date" name="established_date" placeholder="Enter your Company | Shop Establishment Date" class="form-control"  />
                                </div>
                            </div> 
                            <div class="col-4">
                            <div class="form-group">
                                <label for="gst_no" class=" form-control-label">GST No</label>
                                    <input type="text" id="gst_no" name="gst_no" placeholder="Enter your Company GST Number" class="form-control" required />
                                </div>
                            </div> 
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="bank_account_no" class=" form-control-label">Bank Account No :</label>
                                    <input type="text" id="bank_account_no" name="bank_account_no" placeholder="Enter your Company |'s Bank A/C" class="form-control" required />
                                </div>
                            </div> 
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="bank_ifcs_code" class=" form-control-label">Bank IFSC Code</label>
                                    <input type="text" id="bank_ifcs_code" name="bank_ifcs_code" placeholder="Bank IFSC Code" class="form-control" required />
                                </div>
                            </div> 
                            <div class="col-4">
                            <div class="form-group">
                                <label for="cmp_address" class=" form-control-label">Full Address</label>
                                    <input type="text" id="cmp_address" name="cmp_address" placeholder="Company | Shop's Full Address" class="form-control" required />
                                </div>
                            </div> 
                        </div>
                        <div class="row form-group">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="pincode" class=" form-control-label">Pincode</label>
                                    <input type="text" id="pincode" name="pincode" placeholder="Pincode" class="form-control" required />
                                </div>
                            </div> 
                        </div>
                        <div class="card-header">
                            <strong>Owner</strong>
                            <small> Info</small>
                        </div>
                        <div class="row form-group m-t-30">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="owner_name" class=" form-control-label">Owner Name</label>
                                    <input type="text" id="owner_name" name="owner_name" placeholder="Company | Shop's Owner Name" class="form-control" required /> 
                                </div>
                            </div> 
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="owner_email" class=" form-control-label">Email</label>
                                    <input type="email" id="owner_email" name="owner_name" placeholder="Company | Shop's Email Address" class="form-control" required />
                                </div>
                            </div> 
                            <div class="col-4">
                            <div class="form-group">
                                <label for="owner_ph_no" class=" form-control-label">Phone No</label>
                                    <input type="text" id="owner_ph_no" placeholder="Owner's Phone | Mobile Number" class="form-control" required />
                                </div>
                            </div> 
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="owner_birthdate" class=" form-control-label">Birthdate</label>
                                    <input type="date" id="owner_birthdate" placeholder="Owner's Birthdate" class="form-control" required />
                                </div>
                            </div> 
                        </div>
                        <div class="card-header">
                            <strong>Product</strong>
                            <small> Info : (Select Product Catagory For Uploading The Product Based On The Catagory)</small>
                        </div>
                        <div class="card-header">
                            <strong>Company | Shop </strong>
                            <small> Photos :</small>
                        </div>
                        <div class="row form-group m-t-30">
                                <div class="col-6">
                                    <label for="cmp_photos" class=" form-control-label">Select Photos :</label>
                                    <input type="file" id="cmp_photos" name="cmp_photos" class="form-control">
                                </div>
                        </div>
                        <div class="card-header">
                            <strong>Save</strong>
                            <small>Data :</small>
                        </div>
                        <div class="row form-group m-t-10">
                                <div class="col-6">
                                    <button type="submit" id="save_data" class="col-4 btn btn-primary"> 
                                        <i class="fa fa-file"></i>&nbsp; Save</button>
                               </div>
                        </div>
                        <div class="row form-group m-t-10">
                            <div class="col-6" id="vendor_frm_err">
                            
                            </div>
                        </div>
                        </div>
                        </div>
                     </div>
                    </form>
                </div>
            </div>
        </li>
    </ul>
</div>