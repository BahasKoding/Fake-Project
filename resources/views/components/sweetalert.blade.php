@once
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.showSuccessAlert = function(message) {
            return Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: message
            });
        }

        window.showErrorAlert = function(message) {
            return Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: message
            });
        }

        window.showConfirmationAlert = function(title, text, confirmButtonText) {
            return Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText
            });
        }
    </script>
    @endpush
@endonce
