$(document).ready(function(e) {
    $(function() {
        $("#file").change(function() {
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                $('#previewing').attr('src', 'noimage.png');
                toastr.warning("Chỉ được phép chọn đuôi ảnh (png, jpg...)", 'Vui lòng chọn 1 hình ảnh khác!');
                return false;
            } else {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
                var fd = new FormData();
                fd.append("file", this.files[0]);
                $.ajax({
                    url: "img.php",
                    type: "POST",
                    data: fd,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        $('#loading').hide();
                        if (data.indexOf("imgur.com") > -1) {
                            document.getElementById('url').value = data;
                            document.getElementById('img').value = "1";
                            toastr.success("Upload thành công hình ảnh lên máy chủ", 'Thành công!');
                        } else {
                            toastr.warning(data, 'Vui lòng chọn 1 hình ảnh khác!');
                        }
                    }
                });
            }
        });
    });

    function imageIsLoaded(e) {
        $("#file").css("color", "orange");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '230px');
    };
});