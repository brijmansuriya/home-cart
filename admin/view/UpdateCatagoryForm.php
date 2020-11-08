                    <form action="#" method="post" class="" id="UpdateCatagoryForm">
                        <div class="form-group">
                            <label for="NewCatName" class="form-control-label">Category</label>
                            <input type="text" id="NewCatName" name="NewCatName" class="form-control" maxlength="20" />
                        </div>
                        <div class="form-group">
                            <label for="NewDesc" class="form-control-label">Description</label>
                            <textarea id="NewDesc" name="NewDesc" class="form-control" rows="7"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="NewIcon" class="form-control-label">New Icon</label>
                            <input type="file" id="NewIcon" name="NewIcon" class="form-control"  />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-md">
                                <i class="fa fa-dot-circle-o"></i> Save
                            </button>
                            <!-- <button type="button" class="btn btn-danger btn-md" id="btn_del">
                                <i class="fa fa-ban"></i> Delete
                            </button> -->
                            <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">
                            <span aria-hidden="true">×</span> Close
                            </button>
                        </div>
                        <div class="form-group">
                            <div id="mod_p_cat_war">
                                <span>Note :</span>
                                <div class='sufee-alert alert with-close alert-warning' alert-dismissible fade show'><span class='badge badge-pill badge-warning''>Parent Category</span>&nbsp;&nbsp;Not Be Updated
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="mod_p_cat_war">
                                <div class='sufee-alert alert with-close alert-warning' alert-dismissible fade show'><span class='badge badge-pill badge-warning''>Category Delete Action</span>&nbsp;&nbsp;When You Delete Any Category Then It Will Delete The Sub-category And Product Releted That Category.
                                </div>
                            </div>
                        </div>
                    </form>