<div class="card">
    <div class="card-header">
        <strong>Site / Business</strong>
        <small> Social Links</small>
    </div>
    <form action="#" id="social_frm">
        <div class="card-body card-block">
            <div class="form-group" id="social_frm_err">

            </div>
            <div class="form-group">
                <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
                    <span class="badge badge-pill badge-warning">1. Don't Have Profile ? </span> Just Leave it Blank. 
                    <span class="badge badge-pill badge-warning">2. Delete Profile ?</span> Clear Old Link And Leave It To Blank.
                </div>
            </div>
            <div class="form-group">
                <label for="g_p" class=" form-control-label">
                    <i class="fa fa-google-plus"></i>
                    Google Plus
                </label>
                <input type="text" id="g_p" placeholder="Place google plus profile link" class="form-control" value="<?php printf($site->SITE_DATA['GOOGLE']); ?>">
            </div>
            <div class="form-group">
                <label for="fb" class=" form-control-label">
                    <i class="fa fa-facebook"></i>
                    facebook
                </label>
                <input type="text" id="fb" placeholder="Place facebokk profile or page link" class="form-control" value="<?php printf($site->SITE_DATA['FACEBOOK']); ?>">
            </div>
            <div class="form-group">
                <label for="insta" class=" form-control-label">
                    <i class="fa fa-instagram"></i>
                    Instagram
                </label>
                <input type="text" id="insta" placeholder="Place Instagram profile link" class="form-control" value="<?php printf($site->SITE_DATA['INSTAGRAM']); ?>">
            </div>
            <div class="form-group">
                <label for="youtube" class=" form-control-label">
                    <i class="fa fa-youtube-play"></i>
                    Youtube
                </label>
                <input type="text" id="youtube" placeholder="Place Youtube Channel link" class="form-control" value="<?php printf($site->SITE_DATA['YOUTUBE']); ?>" >
            </div>
            <div class="form-group">
                <label for="linkedin" class=" form-control-label">
                    <i class="fa fa-linkedin"></i>
                    LinkedIn
                </label>
                <input type="text" id="linkedin" placeholder="Place LinkedIn profile link" class="form-control" value="<?php printf($site->SITE_DATA['LINKEDIN']); ?>">
            </div>
            <div class="form-group">
                <label for="wg" class=" form-control-label">
                    <i class="fa  fa-whatsapp"></i>
                    Whatsapp Group
                </label>
                <input type="text" id="wg" placeholder="Place Whatsapp Group link" class="form-control" value="<?php printf($site->SITE_DATA['WHATSAPP']); ?>">
            </div>
        </div>
        <div class="card-footer">
            <button type='submit' class="btn btn-primary">Save</button>
        </div>
    </form>
</div>