window.onload = function () {

    var loadFile = document.getElementById('loadFile');

    function log(html) {
        document.getElementById('log').innerHTML = html;
    }

    if (loadFile) {
        document.getElementById('loadFile').onsubmit = function () {
            var file = this.elements.img.files[0];

            if (file) {
                upload(file);
            }
            return false;
        };
    }

    function upload(file) {

        var xhr = new XMLHttpRequest();
        var formData = new FormData();
        formData.append("file", file);

        xhr.upload.onprogress = function(event) {
            log(event.loaded + ' / ' + event.total);
        };

        xhr.onload = xhr.onerror = function() {

            if (this.status == 200) {

                console.log(xhr.responseText);

                var data = JSON.parse(xhr.responseText);
                var ul = document.getElementById('image');
                var li = document.createElement('LI');
                li.style.cssText = "list-style-type: none";

                var img = document.createElement('img');
                img.src = '/UploadedFiles/' + data['img'];
                img.width = 100;
                img.height = 100;

                var a = document.createElement('A');
                a.href = 'show/' + data['id'];
                a.target = '_blank';

                a.appendChild(img);
                li.appendChild(a);
                ul.appendChild(li);

                log("Загружено");
            } else {
                log("error " + this.status);
            }
        };

        xhr.open("POST", "addAjaxImage", true);
        xhr.send(formData);
    }
};