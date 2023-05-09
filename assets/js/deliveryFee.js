async function calculateDeliveryFee(startAddress, endAddress) {
    // Get the latitude and longitude of the starting address
    const startUrl = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(startAddress)},PH&format=json&limit=1`;
    const startRes = await fetch(startUrl);
    const startData = await startRes.json();
    const startLat = startData[0].lat;
    const startLng = startData[0].lon;

    // Get the latitude and longitude of the ending address
    const endUrl = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(endAddress)},PH&format=json&limit=1`;
    const endRes = await fetch(endUrl);
    const endData = await endRes.json();
    const endLat = endData[0].lat;
    const endLng = endData[0].lon;

    // Calculate the distance in kilometers using the Haversine formula
    const R = 6371; // Earth's radius in km
    const dLat = toRad(endLat - startLat);
    const dLng = toRad(endLng - startLng);
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(toRad(startLat)) * Math.cos(toRad(endLat)) * Math.sin(dLng / 2) * Math.sin(dLng / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    const distanceInKm = R * c;

    // Calculate the delivery fee
    const deliveryFee = 49 + (distanceInKm * 5);

    // Return the delivery fee
    return deliveryFee;

    // Helper function to convert degrees to radians
    function toRad(deg) {
        return deg * Math.PI / 180;
    }
}