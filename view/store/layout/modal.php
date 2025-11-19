<!--Application loader-->
<div class="app-loader" style="display: none">
    <div style="position:relative; padding: 10%" class="text-center" id="content-loader">
        <div class="loader-container">
            <div class="loader"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="app-modal-loader" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="">
            <div class="modal-body">
                <div id="content" class="mb-4 px-3"></div>
            </div>
        </div>
    </div>
</div>
<!--application modal -->
<div class="modal fade" id="app-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <div id="content" class="mb-4 px-3"></div>
            </div>
        </div>
    </div>
</div>

<!--application modal sm-->
<div class="modal fade" id="app-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="content" class="mb-4 px-3"></div>
            </div>
        </div>
    </div>
</div>

<!--application modal lg-->
<div class="modal fade" id="app-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <div id="content" class="mb-4 px-3"></div>
            </div>
        </div>
    </div>
</div>

<!--application modal extended-->
<div class="modal fade" id="app-modal-extend" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg-extend modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>
            <div class="modal-body">
                <div id="content" class="mb-4 px-3"></div>
            </div>
        </div>
    </div>
</div>

<!-- cropper modal -->
<div class="modal fade" id="cropper-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 480px !important; margin: 3rem auto;">
        <div class="modal-content card bg-light border-0 br-0">
            <div class="modal-body card-body text-center  p-3" id="cropper-loader-contents">
                <div id="cropper-upload" class="center-block"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger closeCropper"><i
                            class="ri-close-line icon"></i>
                    Close
                </button>
                <button type="button" id="cropImageBtn" class="btn btn-primary"><i class="ri-crop-line icon"></i>
                    Crop
                </button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="base_path" value="<?php echo BASE_PATH; ?>">