$(document).ready(function () {
    let searchResults = [];

    // Search for addresses using the Nominatim API
    const searchAddress = (input) => {
        let address = input.val();

        // Send a GET request to the Nominatim API to search for the address
        $.get('https://nominatim.openstreetmap.org/search?q=' + address + '&countrycodes=PH&format=json', function (data) {
            if (data.length > 0) {
                // Add the search results to the array and keep only the last 3
                searchResults = data.map(result => result.display_name);
                searchResults = searchResults.slice(-3);

                // Create a list group to display the search results
                let resultList = $('<div class="list-group" id="address-search">');
                for (let i = 0; i < searchResults.length; i++) {
                    let resultItem = $('<a href="#" class="list-group-item list-group-item-action">').text(searchResults[i]);

                    resultList.append(resultItem);
                }

                // Attach a click event handler to the list group to set the selected address
                resultList.on('click', 'a', function (event) {
                    event.preventDefault();
                    let selectedAddress = $(this).text();
                    input.val(selectedAddress);
                    $('#address-search').remove();
                });

                // Remove any previous search result lists
                $('#address-search').remove();

                // Display the search results below the input field
                input.after(resultList);
            }
        });
    }

    // attach keyup event listener to a parent element
    $(document).on('keyup', '#address, #edit_address', function (event) {
        if (event.target.id === 'address' || event.target.id === 'edit_address') {
            searchAddress($(event.target));
        }
    });
});

