$(document).ready(function(e) {
    $(function() {
        $("#filetxt").change(function() {
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["text/plain"];
            if (!((imagefile == match[0]))) {
                toastr.warning("Chỉ được phép chọn tệp loại txt", 'Vui lòng chọn tệp khác!');
                return false;
            } else {
                var t = $('#dtable').DataTable();
                var reader = new FileReader();
                reader.onload = function(e) {
                    var lines = this.result.split('\n');
                    var dem = 1;
                    var myArray = [];
                    for (var line = 0; line < lines.length; line++) {
                        var id = lines[line].trim();
                        if (id != "") {
                            var res = lines[line];
                            res = res.split("|");
                            var name = "ID thứ " + dem;
                            dem++;
                            myArray.push(["<input checked type='checkbox' id='checkbox-" + res[0] + "'>", line, name, res[0], "<a target='_blank' href='http://fb.com/" + res[0] + "'>Xem tường</a>"]);
                        }
                    }
                    myArray.reverse();
                    t.rows.add(myArray).draw();
                    toastr.success("Đọc tệp UID thành công", "Thông báo");
                    updateRange(dem);
                }
                reader.readAsText(file);
            }
        });
    });
});