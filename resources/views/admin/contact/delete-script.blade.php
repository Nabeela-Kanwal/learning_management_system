<script>
    document.querySelectorAll('form[data-contact-delete]').forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (form.dataset.confirmed === 'true') return;
            event.preventDefault();

            Swal.fire({
                title: 'Delete inquiry?',
                text: 'This inquiry will be permanently deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel',
                focusCancel: true,
                customClass: {
                    confirmButton: 'btn btn-danger me-2',
                    cancelButton: 'btn btn-outline-secondary'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.dataset.confirmed = 'true';
                    form.requestSubmit();
                }
            });
        });
    });
</script>
