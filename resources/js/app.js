import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#my-dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen...',
    acceptedFiles: '.png,.jpg,.jpeg,.gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar imagen',
    maxFiles: 1,
    uploadMultiple: false,
});