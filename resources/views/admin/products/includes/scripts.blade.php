<script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/bootstrap-notify.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script>
    Dropzone.autoDiscover = false;

    $( document ).ready(function() {
        $('#categories').select2();

        let myDropzone = new Dropzone("#dropzone", {
            paramName: "image",
            addRemoveLinks: false,
            maxFilesize: 4,
            parallelUploads: 2,
            uploadMultiple: false,
            url: "{{ route('admin.products.images.upload') }}",
            autoProcessQueue: false,
        });
        myDropzone.on("queuecomplete", function (file) {
            window.location.reload();
            showNotification('Completed', 'All product images uploaded', 'success', 'fa-check');
        });
        $('#uploadButton').click(function(){
            if (myDropzone.files.length === 0) {
                showNotification('Error', 'Please select files to upload.', 'danger', 'fa-close');
            } else {
                myDropzone.processQueue();
            }
        });
        function showNotification(title, message, type, icon)
        {
            $.notify({
                title: title + ' : ',
                message: message,
                icon: 'fa ' + icon
            },{
                type: type,
                allow_dismiss: true,
                placement: {
                    from: "top",
                    align: "right"
                },
            });
        }
    });
</script>