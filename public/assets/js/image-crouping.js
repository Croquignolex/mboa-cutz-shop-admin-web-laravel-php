// initialize data
let $uploadCrop;
let croupModal = $('#upload-modal');
let loader = $('#image-croup-loader');
let copperAspectRatioWidth = undefined;
let currentUploadImageInput = undefined;
let copperAspectRatioHeight = undefined;
let croupModalImgID = 'croup-modal-image';

croupModal.modal("hide");

// Action the upload input
$(".upload-image-input").change(function () {
    currentUploadImageInput = $(this);

    readImageFileFromInput(this, croupModal, croupModalImgID).then(() => {
        let input = this;
        let aspectRadio = undefined;
        let avatar = document.getElementById(croupModalImgID);

        // Loading indicators
        let saveButton = $("#save-image");
        loader.show();
        saveButton.attr("disabled", true);

        croupModal.on("shown.bs.modal", function() {

            if(!$uploadCrop) {

                if(currentUploadImageInput.data('ratio') === 'rectangular') {
                    aspectRadio = null;
                    // Comment this to avoid an aspect ratio, to let the user be free to croup
                    aspectRadio = 16/9;
                    copperAspectRatioWidth = 400;
                    copperAspectRatioHeight = 200;
                } else {
                    aspectRadio = 4/4;
                    copperAspectRatioWidth = 300;
                    copperAspectRatioHeight = 300;
                }

                // Init cropper
                $uploadCrop = new Cropper(avatar, {
                    viewMode: 1,
                    guides: false,
                    movable: false,
                    scalable: false,
                    responsive: true,
                    highlight: false,
                    dragMode: 'move',
                    autoCropArea: 0.8,
                    aspectRatio: aspectRadio,
                    toggleDragModeOnDblclick: false,
                    ready: function () {
                        loader.hide();
                        input.value = '';
                        saveButton.attr("disabled", false);
                    }
                });
            }
        }).on("hidden.bs.modal", function() {
            //Destroy the cropper instance
            if($uploadCrop) {
                loader.hide();
                $uploadCrop.destroy();
                $uploadCrop = undefined;
                saveButton.attr("disabled", false);
            }
        });
    });
});

// Action on the image modal validation
$("#save-image").click(function () {
    let base64Image = resizeImage(copperAspectRatioWidth, copperAspectRatioHeight, croupModal, $uploadCrop);
    cropperAjaxRequest(base64Image, croupModal, currentUploadImageInput, { base_64_image: base64Image }, 'PUT').then();
});

