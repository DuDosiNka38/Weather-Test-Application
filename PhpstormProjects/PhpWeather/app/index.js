import {getWeather} from "./service/service.js";

const submitButton = document.getElementById("submit");
const loadingForSubmit = document.getElementById("loader");


submitButton.addEventListener("click", async () => {
    const city = document.getElementById("city").value.trim();
    const date = document.getElementById("date").value;

    if (!city || !date) {
        alert("Please enter both city and date.");
        return;
    }

    loadingForSubmit.classList.remove("hidden");

    try {
       await getWeather(city, date);
    } catch (e) {
        console.log(e);
    } finally {
        loadingForSubmit.classList.add("hidden");
    }
});