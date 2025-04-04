function toggleSidebar() {
    let sidebar = document.getElementById("sidebar");
    let content = document.getElementById("content");

    // Toggle for desktop view
    if (window.innerWidth > 768) {
        sidebar.classList.toggle("collapsed");
        content.classList.toggle("collapsed");
    } 
    // Toggle for mobile view
    else {
        sidebar.classList.toggle("show");
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.sidebar .nav-link');
    links.forEach(link => {
        link.addEventListener('click', function() {
            links.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });
});

// calender

const monthYearElement = document.getElementById('monthYear');
const datesElement = document.getElementById('dates');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

let date = new Date();

const updateCalendar = () => {
    const currentYear = date.getFullYear();
    const currentMonth = date.getMonth();

    const firstDay = new Date(currentYear, currentMonth, 0);
    const lastDay = new Date(currentYear, currentMonth + 1, 0);
    const totalDays = lastDay.getDate();
    const firstDayIndex = firstDay.getDay();
    const lastDayIndex = lastDay.getDay();

    const monthYearString = date.toLocaleString('default', { month: 'long', year: 'numeric' });
    monthYearElement.textContent = monthYearString;

    let datesHtml = '';

    for (let i = firstDayIndex; i > 0; i--) {
        const prevDate = new Date(currentYear, currentMonth, 0 - i + 1);
        datesHtml += `<div class="date inactive">${prevDate.getDate()}</div>`;
    }

    for (let i = 1; i <= totalDays; i++) {
        const date = new Date(currentYear, currentMonth, i);
        const activeClass = date.toDateString() === new Date().toDateString() ? 'active' : '';
        datesHtml += `<div class="date ${activeClass}">${i}</div>`;
    }

    for (let i = 1; i <= 7 - lastDayIndex; i++) {
        const nextDate = new Date(currentYear, currentMonth + 1, i);
        datesHtml += `<div class="date inactive">${nextDate.getDate()}</div>`;
    }

    datesElement.innerHTML = datesHtml;
};

prevBtn.addEventListener('click', () => {
    date.setMonth(date.getMonth() - 1);
    updateCalendar();
});

nextBtn.addEventListener('click', () => {
    date.setMonth(date.getMonth() + 1);
    updateCalendar();
});

updateCalendar();

// set the current date
const currentDateElement = document.getElementById('currentDate');
const options = {year: 'numeric', month: 'short', day: 'numeric' };
const today = new Date().toLocaleDateString('en-US', options);
currentDateElement.textContent = today;


function setDeleteAction(action) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = action;
}