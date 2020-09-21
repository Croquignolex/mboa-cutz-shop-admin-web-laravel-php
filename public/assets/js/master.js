$(document).ready(function() {
    // Disable submit button while submit
    $('button[type="submit"]').click(function() {
        $(this).addClass('disabled')
    })
});

// Ajax request
function ajaxRequest(requestData, requestUrl, requestType = 'POST') {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: requestType,
            url: requestUrl,
            data: requestData,
            // Fired on success response
            success: function success(data) {resolve(data);},
            // Fired on failed response
            error: function error(error) {
                dangerToaster("Une erreur s'est produite sur le serveur, réessayez plus tard")
                reject(error.responseJSON);
            }
        });
    });
}

// Call toaster
function callToaster(title, message, type, delay) {
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: 'toast-top-right',
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: delay,
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    };
    if(type === 'info') toastr.info(message, title);
    else if(type === 'danger') toastr.error(message, title);
    else if(type === 'success') toastr.success(message, title);
    else if(type === 'warning') toastr.warning(message, title);
}

// Call danger toaster
function dangerToaster(message) {
    callToaster('Erreur', message, "danger", 10000)
}

// Call danger toaster
function successToaster(message) {
    callToaster('Succès', message, "success", 5000)
}

// Extra image object into input while croup
function readImageFileFromInput(input, croupModal, croupModalImgID, loader = $('#image-croup-loader')) {
    loader.show();

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
                        croupModal.modal("show");
                        $(`#${croupModalImgID}`).attr('src', e.target.result);
                        resolve();
                    };

                    reader.readAsDataURL(input.files[0]);
                } else dangerToaster("Image trop loude, choisissez une image de moins de 3Mo")
            } else dangerToaster("Type de fichier non réconnu, l'image doit être de type: gif, jpg, jpeg ou png")
        } else dangerToaster("Action annulé ou navigateur internet incompatible")

        loader.hide();
    });
}

// Resize image base on canvas
function resizeImage(imageWith, imageHeight, croupModal, $uploadCrop, loader = $('#image-croup-loader')) {
    let resultFile = undefined;
    loader.show();

    // Load image if the is a preview
    if($uploadCrop) {
        // Get the image result
        try { resultFile = (imageWith && imageHeight)
            ? $uploadCrop.getCroppedCanvas({ width: imageWith, height: imageHeight }).toDataURL('image/png')
            : $uploadCrop.getCroppedCanvas().toDataURL('image/png');
        }
        catch (e) {}
        // Get only if the image src exist
        if (!resultFile) dangerToaster("Une erreur s'est produite, réessayez plus tard', 'danger")
    } else dangerToaster("Il vous faut d'abord choisir une image")

    loader.hide();
    croupModal.modal("hide");
    return resultFile;
}

// Preview image after croup
function previewImage(base64Image, imageInput) {
    try
    {
        // Preview image user profile image

            // Show delete button
            $('#delete-user-image').removeClass('invisible');
            // Replace all user profile image
            $(".async-image").replaceWith(`<img alt="..." src="${base64Image}" class="img-responsive async-image" />`);
            // Change the default message
            imageInput.prev().replaceWith(`<span>Modifier</span>`);
        //----------------------------

            // Set group image input value
            imageInput.next().val(base64Image);
            // Display uploaded group image
            let parentNode = imageInput.parent();
            if($(parentNode.children()[0]).is('em')) {
                parentNode.removeClass('group-background-image')
                    .addClass('no-background-image')
                    .append(`<img alt="..." src="${base64Image}" class="img-responsive" />`)
                    .children()[0]
                    .remove();
            } else {
                parentNode.append(`<img alt="..." src="${base64Image}" class="img-responsive" />`)
                    .children()[2]
                    .remove();
            }

             //----------------------------
                let parentLinkNode = imageInput.parent().parent().parent().next();
                $(parentLinkNode.children()[0]).html(`<i class="fa fa-upload"></i> Modifier`);
                $(parentLinkNode.children()[1]).removeClass('invisible');
                $('#submit-image-btn').removeClass('invisible');


    } catch (ex) { dangerToaster("Une erreur s'est passé dans le script"); console.log(ex) }
}

// Send request to save image
function cropperAjaxRequest(base64Image, croupModal, imageInput, requestData, requestType, loader = $('#image-croup-loader')) {
    loader.show();

    return new Promise((resolve, reject) => {
        ajaxRequest(requestData, imageInput.data('url'), requestType).then(
            (_data) => {
                // Preview image user profile image after ajax request
                previewImage(base64Image, imageInput);

                croupModal.modal("hide");
                loader.hide();
                successToaster(_data.message);
                resolve()
            },
            () => {
                croupModal.modal("hide");
                loader.hide();
                reject()
            }
        )
    });
}