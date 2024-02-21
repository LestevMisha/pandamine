$(document).ready(function () {
    // Function to show/hide upload field based on selected option
    function toggleUploadField(element) {
        var selectedValue = element.querySelector("option:checked").getAttribute("value");
        var uploadField = element.closest("form").querySelector(".upload-field");

        if (selectedValue == '32' || selectedValue == '33' || selectedValue == '34') {
            // Show upload field
            uploadField.style.display = "block";
        } else {
            // Hide upload field
            uploadField.style.display = "none";
        }
    }

    // Attach change event to the select element
    $('.select-group').change(function (e) {
        // Call the function when the selection changes
        toggleUploadField(e.target);
    });

    const uploadFields = document.querySelectorAll(".file");

    uploadFields.forEach(uploadField => {
        uploadField.onchange = function () {
            console.log(uploadField, 123)
            if (this.files[0].size > 2097152) {
                alert("Файл слишком большой, максимальный размер 2МБ");
                this.value = "";
            }
        }
    });
 

});