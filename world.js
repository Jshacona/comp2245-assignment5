const lookupBtn = document.getElementById("lookup");
const inputVal = document.getElementById("country");
const results = document.getElementById("result");

lookupBtn.addEventListener("click", async () => {
    try {
        await lookupCountry();
    } catch (error) {
        console.error("Error during lookup:", error);
    }
});

async function lookupCountry() {
    const country = inputVal.value.trim();

    let url = "world.php";


    if (country !== "") {
        url += `?country=${encodeURIComponent(country)}`;
    }

    try {
        const response = await fetch(url);

        if (!response.ok) {
            throw new Error("Failed to fetch data from server.");
        }

        const data = await response.text();

        displayResult(data);
    } catch (error) {
        console.error("Error fetching data:", error);
        results.innerHTML = "An error occurred while fetching data.";
    }
}

function displayResult(data) {
    results.innerHTML = data;
}


