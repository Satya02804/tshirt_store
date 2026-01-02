
function saveTshirt() {


    // Get the values
    const title = document.getElementById('pTitle').value;
    const url = document.getElementById('pURL').value;
    const price = document.getElementById('pPrice').value;
    const discount = document.getElementById('pDiscount').value;


    const errorTitle = document.getElementById('error-title');
    const errorURL = document.getElementById('error-url');
    const errorPrice = document.getElementById('error-price');
    const errorDiscount = document.getElementById('error-discount');

    // Reset error messages

    errorTitle.classList.add('d-none');
    errorURL.classList.add('d-none');
    errorPrice.classList.add('d-none');
    errorDiscount.classList.add('d-none');

    let isValid = true;

    if (title.trim() === '') {
        errorTitle.textContent = "Title is required";
        errorTitle.classList.remove('d-none');
        isValid = false;
    }

    if (url.trim() === '') {
        errorURL.textContent = "Enter Image URL.";
        errorURL.classList.remove('d-none');
        isValid = false;
    }
    else if (!urlPattern.test(url)) {
        errorURL.textContent = "Enter Valid Image URL";
        errorURL.classList.remove('d-none');
        isValid = false;
    }

    if (price.trim() === '') {
        errorPrice.textContent = "Price is required";
        errorPrice.classList.remove('d-none');
        isValid = false;
    }
    if (discount.value <= 0) {
        errorDiscount.textContent = "Discount must be above zero";
        errorDiscount.classList.remove('d-none');
        isValid = false;

    }

    return isValid;


}

function deleteData(id) {

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {

            let destroy = document.getElementById('deleteForm');

            destroy.action = '/tshirt/' + id;

            destroy.submit();

        }
    });
}

function updateTshirt() {

    const urlPattern = /^(http|https|ftp):\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(:[a-zA-Z0-9]*)?(\/.*)?$/;

    // Get values from the EDIT inputs
    const title = document.getElementById('editTitle').value;
    const url = document.getElementById('editURL').value;
    const price = document.getElementById('editPrice').value;
    const discount = document.getElementById('editDiscount').value;

    const errorTitle = document.getElementById('error-editTitle');
    const errorURL = document.getElementById('error-editURL');
    const errorPrice = document.getElementById('error-editPrice');
    const errorDiscount = document.getElementById('error-editDiscount');

    //  Reset Errors
    errorTitle.classList.add('d-none');
    errorURL.classList.add('d-none');
    errorPrice.classList.add('d-none');
    errorDiscount.classList.add('d-none');

    let isValid = true;
    //validation
    if (title.trim() === '') {
        errorTitle.textContent = "Title is required";
        errorTitle.classList.remove('d-none');
        isValid = false;
    }

    if (url.trim() === '') {
        errorURL.textContent = "Enter Image URL.";
        errorURL.classList.remove('d-none');
        isValid = false;
    } else if (!urlPattern.test(url)) {
        errorURL.textContent = "Enter Valid Image URL";
        errorURL.classList.remove('d-none');
        isValid = false;
    }

    if (price.trim() === '') {
        errorPrice.textContent = "Price is required";
        errorPrice.classList.remove('d-none');
        isValid = false;
    }
    if (discount < 0 || discount > 100) {
        errorDiscount.textContent = "Discount must be between 0 and 100";
        errorDiscount.classList.remove('d-none');
        isValid = false;

    }
    return isValid;
}


function editData(index) {
    let product = tshirtData[index];

    document.getElementById('editTitle').value = product.name;
    document.getElementById('editURL').value = product.url;
    document.getElementById('editPrice').value = product.price;
    document.getElementById('editDiscount').value = product.discount;

    document.getElementById('error-editTitle').classList.add('d-none');
    document.getElementById('error-editURL').classList.add('d-none');
    document.getElementById('error-editPrice').classList.add('d-none');
    document.getElementById('error-editDiscount').classList.add('d-none');

    let update = document.getElementById('editForm');
    update.action = '/tshirt/' + product.id;

    let myModal = new bootstrap.Modal(document.getElementById('editModal'));
    myModal.show();
}

// function openNav() {
//     document.getElementById("mySidenav").style.width = "250px";
// }

// function closeNav() {
//     document.getElementById("mySidenav").style.width = "0";
// }
