function setArchiveAction() {
    if (confirm("Are you sure want to Archive the Selected?")) {
	document.multiactions.action = "/projectmarchive";
	document.multiactions.submit();
}
}
function setunArchiveAction() {
    if (confirm("Are you sure want to Unarchive thr Selected?")) {
	document.multiactions.action = "munarchive.php";
	document.multiactions.submit();
}
}
// multiple delete
function setDeleteAction() {
    if (confirm("Are you sure want to delete the Selected?")) {
	document.multiactions.action = "/projectmdelete";
	document.multiactions.submit();
}
}

//get subcategory based on selection of a category

window.addEventListener('DOMContentLoaded', function() {
    const categoryDropdown = document.getElementById('category');
    const subcategoryDropdown = document.getElementById('subcat');
    const subcategoryLabel = document.getElementById('subcatlabel');

    subcategoryDropdown.style.display = 'none';
    subcategoryLabel.style.display = 'none';

    function checkCategoryValue() {
        const categoryId = categoryDropdown.value;
        if (categoryId !== '') {
            subcategoryDropdown.style.display = 'block';
            subcategoryLabel.style.display = 'block';
            // Make an AJAX request to fetch the related subcategories
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'taskGetSubCat?categoryId=' + categoryId, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Parse the response and populate the subcategory dropdown
                    const subcategories = JSON.parse(xhr.responseText);
                    const selectedSubcat = subcategoryDropdown.value; // Store the selected value
                    populateSubcategoryDropdown(subcategories);
                    subcategoryDropdown.value = selectedSubcat; // Set the selected option
                    if (subcategories.length === 0) {
                        subcategoryDropdown.style.display = 'none';
                        subcategoryLabel.style.display = 'none';
                    }
                }
            };
            xhr.send();
        } else {
            // Clear and disable the subcategory dropdown
            subcategoryDropdown.style.display = 'none';
            subcategoryLabel.style.display = 'none';
            subcategoryDropdown.innerHTML = '<option value="">Select</option>';
            subcategoryDropdown.disabled = true;
        }
    }

    function populateSubcategoryDropdown(subcategories) {
        // Clear any existing options
        subcategoryDropdown.innerHTML = '';

        // Add the new options based on the fetched subcategories
        subcategories.forEach(function(subcategory) {
            const option = document.createElement('option');
            option.value = subcategory.id;
            option.textContent = subcategory.subcat;
            subcategoryDropdown.appendChild(option);
        });

        // Enable the subcategory dropdown
        subcategoryDropdown.disabled = false;
    }

    // Call the function initially to check the category value on page load
    checkCategoryValue();

    // Add the event listener to handle category change
    categoryDropdown.addEventListener('change', checkCategoryValue);
});
// End of get subcategory based on selection of a category
