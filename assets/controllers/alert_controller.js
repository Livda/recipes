import { Controller } from '@hotwired/stimulus';
import Swal from 'sweetalert2';

export default class extends Controller {
    static values = {
        text: String,
        confirmButtonText: String,
    }

    async send(e) {
        e.preventDefault();
        
        const response = await Swal.fire({
            buttonsStyling: false,
            cancelButtonText: 'Annuler',
            confirmButtonText: this.confirmButtonTextValue || 'Supprimer',
            customClass: {
                cancelButton: 'btn btn-outline-danger',
                confirmButton: 'btn btn-outline-light me-2',
            },
            icon: 'warning',
            showCancelButton: true,
            text: this.textValue || 'Cette action est irréversible',
            title: 'Êtes-vous sûr ?',
        });

        if (response.isConfirmed) {
            window.location = this.element.href;
        }
    }
}