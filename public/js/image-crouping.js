// initialize data
let $uploadCrop;
let croupModal = $('#upload-modal');
let copperAspectRatioWidth = undefined;
let currentUploadImageInput = undefined;
let copperAspectRatioHeight = undefined;
let croupModalImgID = 'croup-modal-image';

// Action the upload input
$("#upload-model-image-input").change(function () {
    inputChangeEventHandle(this)
});

// Action the upload input
$("#upload-image-input").change(function () {
    inputChangeEventHandle(this)
});

// Action on the image modal validation
$("#modal-save-image").click(function () {
    toggleCroupModalLoader(true)
    let base64Image = resizeImage(copperAspectRatioWidth, copperAspectRatioHeight, $uploadCrop);
    // Save crouped image into backend
    ajaxRequest({ base_64_image: base64Image }, currentUploadImageInput.data('url'))
        .then((data) => {
            previewImage(base64Image, currentUploadImageInput.data('class'));
            croupModal.modal("hide");
            successToaster(data.message);
        })
        .catch(() => {croupModal.modal("hide");})
});

// Handle input change event
function inputChangeEventHandle(_input) {
    currentUploadImageInput = $(_input);
    toggleCroupModalLoader(true)

    readImageFileFromInput(_input).then(() => {
        let input = _input;
        let aspectRadio = undefined;
        let image = document.getElementById(croupModalImgID);

        croupModal.on("shown.bs.modal", function() {

            if(!$uploadCrop) {

                const ratio = currentUploadImageInput.data('ratio');

                if(ratio === 'square') {
                    aspectRadio = 4/4;
                    copperAspectRatioWidth = 360;
                    copperAspectRatioHeight = 360;
                } else if(ratio === 'rectangle') {
                    aspectRadio = 16/9;
                    copperAspectRatioWidth = 640;
                    copperAspectRatioHeight = 360;
                } else aspectRadio = null;

                // Init cropper
                $uploadCrop = new Cropper(image, {
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
                        toggleCroupModalLoader(false)
                        input.value = '';
                    }
                });
            }
        }).on("hidden.bs.modal", function() {
            //Destroy the cropper instance
            if($uploadCrop) {
                toggleCroupModalLoader(false)
                $uploadCrop.destroy();
                $uploadCrop = undefined;
            }
        });
    });
}

// Extra image object into input while croup
function readImageFileFromInput(input) {
    return new Promise((resolve) => {
        if (input.files && input.files[0]) {
            // Get image type
            const fileType = input.files[0]['type'];
            // The /1024/1024 is to have the size in megabytes
            const fileSize = input.files[0].size/1024/1024;
            // Valid image types array
            const validImageTypes = ['image/jpeg', 'image/JPEG', 'image/png', 'image/PNG', 'image/jpg', 'image/JPG'];

            if (validImageTypes.includes(fileType)) {
                // valid image size
                if (fileSize < 10) {
                    // initialize the image reader
                    let reader = new FileReader();

                    // When the reader is loaded
                    // asynchronous function so it will execute after
                    reader.onload = function (e) {
                        // Show the cropper modal
                        // croupModal.modal("show");
                        // Open model with a static backdrop
                        croupModal.modal({backdrop: 'static', keyboard: false});
                        $(`#${croupModalImgID}`).attr('src', e.target.result);
                        resolve();
                    };

                    reader.readAsDataURL(input.files[0]);
                } else dangerToaster("Image trop loude, choisissez une image de moins de 3Mo")
            } else dangerToaster("Type de fichier non réconnu, l'image doit être de type: gif, jpg, jpeg ou png")
        } else dangerToaster("Action annulé ou navigateur internet incompatible")
    });
}

// Resize image base on canvas
function resizeImage(imageWith, imageHeight, $uploadCrop) {
    let resultFile = undefined;

    // Load image if the is a preview
    if($uploadCrop) {
        // Get the image result
        try {
            resultFile = (imageWith && imageHeight)
                ? $uploadCrop.getCroppedCanvas({ width: imageWith, height: imageHeight }).toDataURL('image/png')
                : $uploadCrop.getCroppedCanvas().toDataURL('image/png');
        }
        catch (e) {}
        // Get only if the image src exist
        if (!resultFile) dangerToaster("Une erreur s'est produite, réessayez plus tard', 'danger")
    } else dangerToaster("Il vous faut d'abord choisir une image")

    return resultFile;
}

// Toggle croup modal loader
function toggleCroupModalLoader(toggleStatus) {
    if(toggleStatus) {
        // Show loader
        $("#croup-modal-image-canvas").css('opacity', .2)
        $("#croup-modal-action-buttons").hide();
        $("#croup-modal-loader").show();
    } else {
        // Hide loader
        $("#croup-modal-image-canvas").css('opacity', 1);
        $("#croup-modal-loader").hide();
        $("#croup-modal-action-buttons").show();
    }
}

// Preview image after croup
function previewImage(base64Image, imageClass) {
    try {
        $(`.${imageClass}`).replaceWith(`<img alt="..." src="${base64Image}" class="img-responsive ${imageClass}" />`);
    } catch (ex) {
        dangerToaster("Une erreur s'est passé dans le script"); console.log(ex)
    }
}


