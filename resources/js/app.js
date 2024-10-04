//import Dropzone from "dropzone";
import Dropzone from "Dropzone";

dropzone.autoDiscover = false;

const dropzone = new Dropzone("mydropzone", {
    dictDefaultMessage: "sube aqui tu imagen2",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false
});


