var createPostForm  = $('[name="createPostForm"]');

createPostForm.on('submit', function(e) {
    var formData = new FormData(this);
    e.preventDefault();
    $.ajax({
        method: 'post',
        url: '/posts/store',
        data:  formData,
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        error: function (data) {
            console.log(data);return false;
        },
        success: function(data) {
            var j = JSON.parse(data);
            if(j.status === true) {
                window.location.href = '/posts';
            } else {
                console.log(j)
            }
        }
    });
});

$(document).ready(function() {
    $('.uploadImages').change(function () {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            // пробегаем в цикле по загруженным файлам
            for (var i = 0, f; f = input.files[i]; i++) {
                // если это не изображение - проходим дальше
                if (!f.type.match('image.*')) {
                    console.log(f.type);return false;
                }
                var reader = new FileReader();
                reader.onload = (function (theFile) {
                    return function (e) {
                        $('.previewBlock').append(
                            $('<div/>').addClass('imgWrapper').append(
                                $('<img/>').attr({
                                    'class': 'previewImage',
                                    'src': e.target.result,
                                    'title': theFile.name,
                                    'name': theFile.name
                                })
                            )
                        );
                    }
                })(f);
                reader.readAsDataURL(f);
            }
        }
    }
});