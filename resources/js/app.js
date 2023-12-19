import Dropzone from "dropzone"; //importa la biblioteca Dropzone en tu código para que puedas utilizarla.

Dropzone.autoDiscover = false; //desactiva la función de autodetección de Dropzone, lo cual es útil cuando quieres inicializar manualmente las instancias de Dropzone en tu página.


/**Aquí se configuran varias opciones, como el mensaje predeterminado, los tipos de archivos aceptados, la capacidad para agregar y eliminar archivos, el número máximo de archivos permitidos y si se permite la carga múltiple. */
const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Arrastra y suelta aqui para cargar tu imagen',
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);

            this.options.thumbnail.call(
                this,
                imagenPublicada,
                `/uploads/${imagenPublicada.name}` //nombre del signo: Backtick
            );

            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        }
    },
});

/**se definen varios eventos de Dropzone, como "sending", "success", "error" y "removedfile". Estos eventos se activarán cuando ocurran ciertas acciones durante el proceso de carga de archivos, y puedes utilizarlos para realizar acciones adicionales, como mostrar mensajes de éxito o error, o realizar alguna otra lógica personalizada. */

dropzone.on("sending", function (file, xhr, formData) {
    console.log(formData);
});

dropzone.on("success", function (file, response) {
    console.log(response.imagen);
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on("error", function (file, message) {
    console.log(message);
});

dropzone.on('removedfile', function () {
    document.querySelector('[name="imagen"]').value = "";
});