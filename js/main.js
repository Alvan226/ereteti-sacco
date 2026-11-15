/*
  Ereteti Dairy Sacco - JavaScript for the deliveries and routes pages.
  The script checks whether the relevant page elements exist before using them,
  so it can safely be loaded by more than one page.
*/

document.addEventListener("DOMContentLoaded", function () {
    // STEP 3: Validate the delivery form before it is submitted.
    const deliveryForm = document.querySelector("#delivery-form");

    if (deliveryForm) {
        deliveryForm.addEventListener("submit", function (event) {
            // Stop the browser from reloading/submitting the page.
            event.preventDefault();

            const memberInput = document.querySelector("#member");
            const litresInput = document.querySelector("#litres");
            const memberMessage = document.querySelector("#member-message");
            const litresMessage = document.querySelector("#litres-message");
            const formMessage = document.querySelector("#form-message");

            // Clear messages from the previous attempt.
            memberMessage.textContent = "";
            litresMessage.textContent = "";
            formMessage.textContent = "";

            let isValid = true;
            const memberNumber = memberInput.value.trim();
            const litres = Number(litresInput.value);

            // A member number must follow the format ER-0000.
            if (!/^ER-\d{4}$/i.test(memberNumber)) {
                memberMessage.textContent = "Enter a valid member number, for example ER-0001.";
                isValid = false;
            }

            // Litres must be a number greater than zero.
            if (litresInput.value.trim() === "" || !Number.isFinite(litres) || litres <= 0) {
                litresMessage.textContent = "Enter a litres value greater than 0.";
                isValid = false;
            }

            if (!isValid) {
                formMessage.textContent = "Please correct the errors above.";
                return;
            }

            formMessage.textContent = "Delivery details are valid. (This demonstration does not save to a database.)";
            deliveryForm.reset();
        });
    }

    // STEP 4: Filter the route sections as the user types.
    const routeSearch = document.querySelector("#route-search");

    if (routeSearch) {
        const routeSections = document.querySelectorAll("main .route-card");
        const noResultsMessage = document.querySelector("#route-no-results");

        routeSearch.addEventListener("input", function () {
            const searchText = routeSearch.value.toLowerCase().trim();
            let visibleRoutes = 0;

            // Loop through every route section and check its text.
            for (let i = 0; i < routeSections.length; i++) {
                const routeText = routeSections[i].textContent.toLowerCase();
                const matches = routeText.includes(searchText);

                routeSections[i].hidden = !matches;

                if (matches) {
                    visibleRoutes++;
                }
            }

            if (noResultsMessage) {
                noResultsMessage.hidden = visibleRoutes !== 0;
            }
        });
    }

    // STEP 5: Add the litres for accepted deliveries only.
    const acceptedTotal = document.querySelector("#accepted-total");

    if (acceptedTotal) {
        const deliveryRows = document.querySelectorAll("table tbody tr");
        let totalLitres = 0;

        // Each row contains member, farmer, session, litres and accepted status.
        for (let i = 0; i < deliveryRows.length; i++) {
            const cells = deliveryRows[i].querySelectorAll("td");
            if (cells.length >= 5) {
                const litres = Number.parseFloat(cells[3].textContent);
                const accepted = cells[4].textContent.trim().toLowerCase();

                if (accepted === "yes" && Number.isFinite(litres)) {
                    totalLitres += litres;
                }
            }
        }

        // Display the total to two decimal places.
        acceptedTotal.textContent = totalLitres.toFixed(2);
    }
});
