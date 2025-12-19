


export async function getWeather(city, date) {
    const params = new URLSearchParams({
        city: city,
        date: date,
        action: "getWeather"
    });
    const url = `http://localhost:8000/server/index.php?${params.toString()}`;

    await fetch(url).then(
        async response => {
        if (!response.ok) {
            const err = await response.json();
            throw new Error(err.message);
        }
        return response.blob();
    }).then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'weather.xlsx';
            a.click();
    }).catch(err => {
        alert(err.message);
    });
}