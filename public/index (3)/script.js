// --- SHARED DATA ---
const roomDatabase = {
    'Meeting Room': {
        capacity: 5,
        amenities: ['<i class="ph ph-wifi-high"></i> WiFi', '<i class="ph ph-wind"></i> AC', '<i class="ph ph-presentation-chart"></i> Whiteboard'],
        image: 'assets/meeting.png'
    },
    'Conference Hall': {
        capacity: 10,
        amenities: ['<i class="ph ph-wifi-high"></i> WiFi', '<i class="ph ph-projector-screen"></i> Projector', '<i class="ph ph-wind"></i> AC'],
        image: 'assets/conference.png'
    },
    'Training Room': {
        capacity: 20,
        amenities: ['<i class="ph ph-wifi-high"></i> WiFi', '<i class="ph ph-presentation-chart"></i> Whiteboard', '<i class="ph ph-projector-screen"></i> Projector', '<i class="ph ph-microphone"></i> Audio'],
        image: 'assets/training.png'
    }
};

// --- INDEX PAGE LOGIC ---
let pendingBookingData = null;

function initIndexPage() {
    const dateInputs = document.querySelectorAll('.card-date');
    const today = new Date().toISOString().split('T')[0];
    dateInputs.forEach(input => {
        input.min = today;
        input.value = today;
    });
}

function filterSpaces() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const capFilter = document.getElementById('capacityFilter').value;
    const priceFilter = document.getElementById('priceFilter').value;
    const cards = document.querySelectorAll('.card');

    cards.forEach(card => {
        const title = card.getAttribute('data-name').toLowerCase();
        const cap = parseInt(card.getAttribute('data-capacity'));
        const price = parseInt(card.getAttribute('data-price'));

        const matchesSearch = title.includes(search);

        let matchesCap = true;
        if (capFilter !== 'all') {
            const reqCap = parseInt(capFilter);
            if (reqCap === 5) matchesCap = cap <= 5;
            else if (reqCap === 10) matchesCap = cap > 5 && cap <= 10;
            else if (reqCap === 20) matchesCap = cap >= 20;
        }

        let matchesPrice = true;
        if (priceFilter !== 'all') {
            const reqPrice = parseInt(priceFilter);
            if (reqPrice === 500) matchesPrice = price < 800;
            else if (reqPrice === 800) matchesPrice = price >= 800 && price < 1000;
            else if (reqPrice === 1000) matchesPrice = price >= 1000;
        }

        if (matchesSearch && matchesCap && matchesPrice) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

function viewDetails(roomName) {
    const toast = document.getElementById('toast');
    toast.innerHTML = `<i class="ph-fill ph-info"></i> Loading details for ${roomName}...`;
    toast.classList.add('show');
    setTimeout(() => {
        toast.classList.remove('show');
    }, 2500);
}

function openBookingPopup(btnElement) {
    const card = btnElement.closest('.card');
    const roomName = card.getAttribute('data-name');
    const price = card.getAttribute('data-price');

    const dateInput = card.querySelector('.card-date').value;
    const startInput = card.querySelector('.card-start').value;
    const endInput = card.querySelector('.card-end').value;

    const warningEl = document.getElementById('modalWarning');
    const proceedBtn = document.getElementById('confirmProceedBtn');

    const isMockBooked = startInput < '14:00' && endInput > '13:00';

    if (!dateInput || !startInput || !endInput) {
        warningEl.innerHTML = '<i class="ph-fill ph-warning-circle"></i> Please select Date, Start Time, and End Time on the card before booking.';
        warningEl.style.display = 'flex';
        proceedBtn.disabled = true;
    } else if (isMockBooked) {
        warningEl.innerHTML = '<i class="ph-fill ph-warning-circle"></i> This time slot (13:00 - 14:00) is already booked. Please choose another time.';
        warningEl.style.display = 'flex';
        proceedBtn.disabled = true;
    } else {
        const start = new Date(`${dateInput}T${startInput}`);
        const end = new Date(`${dateInput}T${endInput}`);
        if (end <= start) {
            warningEl.innerHTML = '<i class="ph-fill ph-warning-circle"></i> End time must be after the start time.';
            warningEl.style.display = 'flex';
            proceedBtn.disabled = true;
        } else {
            warningEl.style.display = 'none';
            proceedBtn.disabled = false;
        }
    }

    document.getElementById('modalRoomName').textContent = roomName;
    document.getElementById('modalDate').textContent = dateInput || 'Not selected';
    document.getElementById('modalTime').textContent = (startInput && endInput) ? `${startInput} to ${endInput}` : 'Not selected';
    document.getElementById('modalPrice').textContent = price;

    pendingBookingData = {
        room: roomName,
        price: price,
        date: dateInput,
        start: startInput,
        end: endInput
    };

    document.getElementById('bookingModal').classList.add('active');
}

function closeModal() {
    document.getElementById('bookingModal').classList.remove('active');
}

function confirmProceed() {
    if (!pendingBookingData) return;
    const params = new URLSearchParams(pendingBookingData);
    window.location.href = `booking?${params.toString()}`;
}


// --- BOOKING PAGE LOGIC ---
let currentRoomPrice = 0;
let currentTotalPrice = 0;
let currentDurationHours = 0;
let maxCapacity = 0;

function initBookingPage() {
    const params = new URLSearchParams(window.location.search);
    const roomName = params.get('room');
    const price = params.get('price');
    const date = params.get('date');
    const start = params.get('start');
    const end = params.get('end');

    if (!roomName || !price) {
        window.location.href = '/';
        return;
    }

    document.getElementById('displayRoomName').textContent = roomName;
    document.getElementById('displayRoomPrice').textContent = price;
    currentRoomPrice = parseFloat(price);

    const details = roomDatabase[roomName];
    if (details) {
        document.getElementById('summaryImage').src = details.image;
        document.getElementById('displayCapacity').innerHTML = `<i class="ph-fill ph-users"></i> Up to ${details.capacity} People`;
        maxCapacity = details.capacity;

        const amContainer = document.getElementById('displayAmenities');
        amContainer.innerHTML = '';
        details.amenities.forEach(am => {
            const span = document.createElement('span');
            span.innerHTML = am;
            amContainer.appendChild(span);
        });
    }

    const dateInput = document.getElementById('bookingDate');
    const today = new Date().toISOString().split('T')[0];
    dateInput.min = today;

    if (date) dateInput.value = date;
    const startInput = document.getElementById('startTime');
    if (start) startInput.value = start;
    const endInput = document.getElementById('endTime');
    if (end) endInput.value = end;

    if (date && start && end) {
        calculateTotal();
    }
}

function validateGuests() {
    const guestInput = document.getElementById('guests');
    const warning = document.getElementById('guestWarning');
    const val = parseInt(guestInput.value);

    if (val > maxCapacity) {
        warning.innerHTML = `<i class="ph-fill ph-warning-circle"></i> This room only fits ${maxCapacity} people.`;
        warning.style.display = 'block';
    } else {
        warning.style.display = 'none';
    }
}

function calculateTotal() {
    const dateStr = document.getElementById('bookingDate').value;
    const startTimeStr = document.getElementById('startTime').value;
    const endTimeStr = document.getElementById('endTime').value;
    const proceedBtn = document.getElementById('proceedBtn');

    const timeWarning = document.getElementById('timeWarning');
    const durationRow = document.getElementById('durationRow');
    const taxRow = document.getElementById('taxRow');

    const isMockBooked = startTimeStr < '14:00' && endTimeStr > '13:00';

    if (dateStr && startTimeStr && endTimeStr) {
        const start = new Date(`${dateStr}T${startTimeStr}`);
        const end = new Date(`${dateStr}T${endTimeStr}`);

        const diffMs = end - start;
        const diffHours = diffMs / (1000 * 60 * 60);

        if (diffHours <= 0) {
            timeWarning.innerHTML = '<i class="ph-fill ph-warning-circle"></i> End time must be after the start time.';
            timeWarning.style.display = 'flex';
            proceedBtn.disabled = true;
            resetTotals();
        } else if (isMockBooked) {
            timeWarning.innerHTML = '<i class="ph-fill ph-warning-circle"></i> The slot between 13:00 - 14:00 is unavailable.';
            timeWarning.style.display = 'flex';
            proceedBtn.disabled = true;
            resetTotals();
        } else {
            timeWarning.style.display = 'none';
            currentDurationHours = diffHours;
            const baseTotal = diffHours * currentRoomPrice;
            const tax = baseTotal * 0.18;
            const platformFee = 50; // Added platform fee
            currentTotalPrice = baseTotal + tax + platformFee;

            durationRow.style.display = 'flex';
            taxRow.style.display = 'flex';

            // Reusing existing DOM elements, but we should add platform fee display in booking.html if needed.
            // Since booking.html doesn't have platformFee span explicitly right now we will just show the updated total.

            document.getElementById('calcHours').textContent = diffHours.toFixed(1);
            document.getElementById('calcBaseTotal').textContent = baseTotal.toFixed(2);
            document.getElementById('calcTax').textContent = tax.toFixed(2);
            document.getElementById('displayTotalPrice').textContent = currentTotalPrice.toFixed(2);

            proceedBtn.disabled = false;
        }
    } else {
        timeWarning.style.display = 'none';
        proceedBtn.disabled = true;
        resetTotals();
    }
}

function resetTotals() {
    document.getElementById('durationRow').style.display = 'none';
    document.getElementById('taxRow').style.display = 'none';
    document.getElementById('displayTotalPrice').textContent = '0.00';
    currentTotalPrice = 0;
    currentDurationHours = 0;
}

function proceedToPayment(event) {
    validateGuests();
    if (document.getElementById('guestWarning').style.display === 'block') {
        event.preventDefault(); // Stop submission since validation failed
        const guestsInput = document.getElementById('guests');
        guestsInput.focus();
        return;
    }
    if (currentTotalPrice <= 0) {
        event.preventDefault();
        return;
    }

    const params = new URLSearchParams(window.location.search);
    const roomName = params.get('room');

    // Populate the hidden fields before the form submits to Laravel
    document.getElementById('hidden_room_name').value = roomName;
    document.getElementById('hidden_total_price').value = currentTotalPrice.toFixed(2);

    // Let the form submit normally because of method="POST" action="{{ route('booking.store') }}"
}

// --- PROFESSIONAL PAYMENT SIMULATION LOGIC ---
let timerInterval = null;

function initPaymentPage() {
    const params = new URLSearchParams(window.location.search);
    const roomName = params.get('room');
    if (!roomName) { window.location.href = '/'; return; }

    const hours = parseFloat(params.get('hours'));
    const rate = parseFloat(params.get('rate'));
    const finalTotal = parseFloat(params.get('total'));

    const baseTotal = hours * rate;
    const gst = baseTotal * 0.18;
    const platformFee = 50.00;

    document.getElementById('pgPayTotal').textContent = finalTotal.toFixed(2);
    document.getElementById('sumRoom').textContent = roomName;
    document.getElementById('sumDate').textContent = params.get('date');
    document.getElementById('sumTime').textContent = `${params.get('start')} to ${params.get('end')}`;
    document.getElementById('sumHours').textContent = `${hours} hrs`;
    document.getElementById('sumRate').textContent = `₹${rate.toFixed(2)}`;

    document.getElementById('sumBaseTotal').textContent = `₹${baseTotal.toFixed(2)}`;
    document.getElementById('sumGst').textContent = `₹${gst.toFixed(2)}`;
    document.getElementById('sumPlatformFee').textContent = `₹${platformFee.toFixed(2)}`;
    document.getElementById('sumTotal').textContent = `₹${finalTotal.toFixed(2)}`;

    startTimer(300); // 5 minutes (300 seconds)
}

function startTimer(duration) {
    let timer = duration, minutes, seconds;
    const display = document.getElementById('paymentTimer');

    timerInterval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            clearInterval(timerInterval);
            display.textContent = "00:00";
            alert("Payment Session Expired for Demo. Plase try again.");
            window.location.href = '/';
        }
    }, 1000);
}

function copyUpi() {
    const text = document.getElementById('dummyUpiId').textContent;
    navigator.clipboard.writeText(text).then(() => {
        const toast = document.getElementById('copyToast');
        toast.style.display = 'block';
        setTimeout(() => toast.style.display = 'none', 2000);
    });
}

function switchPgMethod(methodId, btnElement) {
    document.querySelectorAll('.pg-pane').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.pg-method').forEach(el => el.classList.remove('active'));

    document.getElementById(methodId).classList.add('active');
    btnElement.classList.add('active');
}

function startPaymentSimulation() {
    document.getElementById('pgLoader').classList.add('active');

    // Simulate real delay for processing
    setTimeout(() => {
        const params = new URLSearchParams(window.location.search);
        // Generate random fake transaction IDs
        const txnId = 'txn_' + Math.random().toString(36).substr(2, 9).toUpperCase();
        const bkId = 'BK-' + Math.floor(100000 + Math.random() * 900000);

        params.append('txnid', txnId);
        params.append('bkid', bkId);

        window.location.href = `success.html?${params.toString()}`;
    }, 2500);
}

// --- SUCCESS PAGE LOGIC ---
function initSuccessPage() {
    // Redundant in Laravel as we use Blade variables
    return;
}

function downloadDummyReceipt() {
    const btn = document.querySelector('.btn-outline');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="ph-bold ph-spinner"></i> Generating...';
    btn.disabled = true;

    try {
        // Create an off-screen container to ensure html2canvas calculates dimensions properly
        const printContainer = document.createElement('div');
        printContainer.innerHTML = document.querySelector('.success-wrapper').outerHTML;

        // Remove Action buttons from the PDF clone
        const actions = printContainer.querySelector('.success-actions');
        if (actions) actions.remove();

        // Enforce static styles for the PDF capture to avoid responsive breaks
        const wrapper = printContainer.querySelector('.success-wrapper');
        wrapper.style.margin = '0 auto';
        wrapper.style.boxShadow = 'none';
        wrapper.style.border = '2px solid #eaeaea';
        wrapper.style.maxWidth = '800px';

        // Position it completely off-screen but in the DOM
        printContainer.style.position = 'absolute';
        printContainer.style.top = '-10000px';
        printContainer.style.left = '-10000px';
        printContainer.style.width = '800px';
        printContainer.style.background = '#ffffff';
        printContainer.style.padding = '40px';
        document.body.appendChild(printContainer);

        const bkId = document.getElementById('recBkId').textContent;
        const opt = {
            margin: 0, // Using internal padding instead of jsPDF margins
            filename: `${bkId}_Receipt.pdf`,
            image: { type: 'jpeg', quality: 1.0 },
            html2canvas: { scale: 2, useCORS: true, logging: false },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' },
            pagebreak: { mode: 'avoid-all' } // Prevents snapping table items into 2 pages
        };

        if (window.html2pdf) {
            html2pdf().set(opt).from(printContainer).save().then(() => {
                document.body.removeChild(printContainer);
                btn.innerHTML = originalText;
                btn.disabled = false;
            }).catch(e => {
                console.error(e);
                document.body.removeChild(printContainer);
                fallbackTextDownload();
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
        } else {
            document.body.removeChild(printContainer);
            fallbackTextDownload();
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    } catch (err) {
        console.error(err);
        fallbackTextDownload();
        btn.innerHTML = originalText;
        btn.disabled = false;
    }
}

function fallbackTextDownload() {
    const bkId = document.getElementById('recBkId').textContent;
    const txt = `======================================\n       SPACE BOOKING RECEIPT\n======================================\nBooking ID     : ${bkId}\nTransaction ID : ${document.getElementById('recTxnId').textContent}\nName           : ${document.getElementById('recName').textContent}\nEmail          : ${document.getElementById('recEmail').textContent}\nPhone          : ${document.getElementById('recPhone').textContent}\nCompany        : ${document.getElementById('recCompany').textContent}\nGuests         : ${document.getElementById('recGuests').textContent}\nRoom Name      : ${document.getElementById('recRoom').textContent}\nDate & Time    : ${document.getElementById('recDateTime').textContent}\nAmount Paid    : ${document.getElementById('recAmount').textContent}\nStatus         : Successful\n======================================\nPowered by Razorpay (Test Mode)\n`;
    const blob = new Blob([txt], { type: 'text/plain' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `${bkId}_Receipt.txt`;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}
