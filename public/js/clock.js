

function updateClock() {
    const now = new Date();
    const hours = now.getHours();
    const appm = hours >= 12 ? 'PM' : 'AM';
    const formattedHours = (hours % 12 || 12).toString().padStart(2, 0); // Convert to 12-hour format and pad to 2 digits
    const minutes = now.getMinutes().toString().padStart(2, 0);
    const seconds = now.getSeconds().toString().padStart(2, 0);
    const formattedTime = `${formattedHours}:${minutes}:${seconds} ${appm}`;            
    document.getElementById('time').textContent = formattedTime;
}

setInterval(updateClock, 1000);
updateClock(); // Initial call to display the time immediately