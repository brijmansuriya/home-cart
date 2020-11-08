<div class="card">
    <div class="card-header">
        <strong>About Us</strong>
        <small> Page Data</small>
    </div>
    <form action="#" id="frm_aboutus_page" enctype="multipart/form-data">
    <div class="modal-body">
            <div class="card-body card-block">
                <div class="form-group" id="aboutus_pg_err">
                </div>
                <div class="form-group">
                    <label for="page_banner" class=" form-control-label">Page Banner Image</label>
                    <input type="file" name="page_banner" id="page_banner" class="form-control">
                </div>
               <div class="form-group">
                    <label for="page_feature_img" class=" form-control-label">Page Feature Image</label>
                    <input type="file" name="page_feature_img" id="page_feature_img" class="form-control">
                </div>
                <div class="form-group">
                    <label for="page_story" class=" form-control-label">Page Story</label>
                    <textarea name="page_story" id="page_story" cols="30" rows="10" class="form-control"><?php printf($site->ABOUT_US_PAGE['PAGE_STORY']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="page_thought" class=" form-control-label">Page Thought</label>
                    <input type="text" name="page_thought" id="page_thought" placeholder="" class="form-control" value="<?php printf($site->ABOUT_US_PAGE['PAGE_THOUGHT']); ?>">
                </div>
            </div>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-secondary">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
    </form>
</div>