import Swal from 'sweetalert2';

export function showSuccessAlert(title, text) {
    Swal.fire({
        icon: 'success',
        title: title,
        text: text,
        confirmButtonColor: '#3498db'
    });
}

export function showErrorAlert(title, text) {
    Swal.fire({
        icon: 'error',
        title: title,
        text: text,
        confirmButtonColor: '#3498db'
    });
}

export function showConfirmationAlert(title, text, confirmButtonText, cancelButtonText) {
    return Swal.fire({
        icon: 'warning',
        title: title,
        text: text,
        showCancelButton: true,
        confirmButtonColor: '#3498db',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmButtonText,
        cancelButtonText: cancelButtonText
    });
}
