import { Editor } from '@tinymce/tinymce-react';

const TinyEditor = ({initialValue, handleEditorChange, module, ...props}) => {

    const image_upload_handler = (blobInfo, success, failure, progress) => {
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', route('dashboard.images.uploaded', module));
        xhr.upload.onprogress = function (e) {
            progress(e.loaded / e.total * 100);
        };
        xhr.onload = function() {
            var json;
            if (xhr.status === 403) {
                failure('HTTP Error: ' + xhr.status, { remove: true });
                return;
            }
            if (xhr.status < 200 || xhr.status >= 300) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
            json = JSON.parse(xhr.responseText);
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
            success(json.location);
        };
        xhr.onerror = function () {
            failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };
        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        formData.append('_token', window.csrfToken);
        xhr.send(formData);
    };

    return (
        <Editor
            apiKey="tftthgxf296w4mtzl7dd4ygqep3e80lwt65shh8vf2kbctoq"
            initialValue={initialValue}
            init={{
                images_upload_handler: image_upload_handler,
                height: 500,
                menubar: true,
                plugins: [
                    'advlist autolink lists link image',
                    'charmap print preview anchor help',
                    'searchreplace visualblocks code',
                    'insertdatetime media table paste wordcount'
                ],
                toolbar:
                    'undo redo | formatselect | bold italic \
                    alignleft aligncenter alignright | \
                    bullist numlist outdent indent | help',
                paste_data_images: true,
                language: window.currentLanguage.language_code,
                directionality: window.currentLanguage.language_direction
            }}
            onEditorChange={handleEditorChange}
            {...props}
        />
    );
}

export default TinyEditor;
