<?php
session_start();

// Redirect ke halaman login jika belum login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Proses logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: logout.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Four Points by Sheraton Makassar</title>
  <link rel="stylesheet" href="css/style.css">

</head>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<body>

<header>
  <div style="display: flex; justify-content: space-between; width: 100%; align-items: center;">
  <h1>Welcome To Four Points by Sheraton Makassar</h1>
    <div class="user-greeting" style="font-size: 1.5em; margin-right: 15%; color: white;  padding-top: 50px;">Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></div>
  </div>
  <nav>
  <ul style="list-style: none; padding: 0; margin-right: 150%;; display: flex; justify-content: flex-start; background-color: #2c7e91;">
    <li style="margin-right: 20px;">
      <a href="#Home" class="nav-link">Home</a>
    </li>
    <li style="margin-right: 20px;">
      <a href="#About" class="nav-link">About</a>
    </li>
    <li style="margin-right: 20px;">
      <a href="#form-container" class="nav-link">Form</a>
    </li>
    <li style="margin-right: 20px;">
      <a href="#RoomTypes" class="nav-link">Table</a>
    </li>
    <li style="margin-right: 20px;">
      <a href="#Contact" class="nav-link">Contact</a>
    </li>
    <li>
      <a href="dashboard.php?logout=true" class="nav-link">Logout</a>
    </li>
  </ul>
</nav>


  </header>
  
  <div id="Home" class="hero" style="background-image: url(resource/hotel.jpg) ;">
    <div class="hero-content">
      <h1>Four Points by Sheraton Makassar</h1>
      <p>Experience the best of Makassar at our hotel</p>
    </div>
  </div>

  <table>
    <tr>
      <th>
        <div class="content">
          <div id="About" class="section">
            <h2>Welcome to Four Points by Sheraton Makassar</h2>
           <p>Temukan kenyamanan dan pengalaman menginap tak terlupakan di Four Points by Sheraton Makassar, berlokasi strategis dengan akses mudah ke destinasi wisata seperti Benteng Rotterdam dan Masjid 99 Kubah di Pantai Losari. Selama menginap, nikmati fasilitas unggulan seperti kolam renang di lantai 9 dengan pemandangan kota, pusat kebugaran 24 jam, restoran dengan berbagai cita rasa, serta kamar luas dengan desain modern, dilengkapi Four Comfort Beds dan akses internet gratis. Untuk acara, tersedia ruang serbaguna terbesar di Indonesia Timur seluas 43.518 meter persegi, dengan tim profesional siap membantu mewujudkan acara impian Anda. Kami menantikan kedatangan Anda di Four Points by Sheraton Makassar.</p> 
          </div>
        </div>
      </th>
      <th>
        <img src="resource/hotel.jpg" alt="Hotel Image" class="section-image" width="300" height="300">
      </th>
    </tr>
  </table>
  
  <table>
    <tr>
      <th>
        <img src="resource/room.jpg" alt="Room Image" class="section-image">
      </th>
      <th>
        <div class="section">
          <div id="About" class="section">
            <h2>OUR ROOM</h2>
            <p>Kamar kami dirancang untuk memberikan kenyamanan dan relaksasi terbaik. Setiap kamar dilengkapi dengan fasilitas modern, termasuk TV layar datar, Wi-Fi gratis, dan tempat tidur yang nyaman.</p>
            
          </div>
        </div>
      </th>
    </tr>
  </table>
  </header>

  <!-- Form Tambah Kamar -->

<div id="form-container" style="max-width: 500px; margin: 20px auto; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
    <h3 style="text-align: center; color: #29668f; margin-bottom: 20px;" id="formTitle">Add New Room</h3>
    <form id="roomForm">
        <label for="roomType" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Room Type:</label>
        <input type="text" id="roomType" name="roomType" required style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">

        <label for="category" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Category:</label>
        <input type="text" id="category" name="category" required style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">

        <label for="price" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Price (per night):</label>
        <input type="number" id="price" name="price" required style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">

        <label for="benefits" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Benefits:</label>
        <input type="text" id="benefits" name="benefits" required style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">

        <label for="roomImage" style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Room Image:</label>
        <input type="file" id="roomImage" name="image" accept="image/*" style="padding: 8px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; font-size: 1rem;">

        <button type="button" onclick="saveRoom()" style="width: 100%; padding: 10px; background-color: #4aa4e0; color: #fff; font-size: 1rem; border: none; border-radius: 5px; cursor: pointer;">Save Room</button>
    </form>
</div>

<div id="RoomTypes" class="section" style="padding: 20px; margin-bottom: 20px; background-color: #f9f9f9; border-radius: 10px; box-shadow: 10px 4px 10px rgba(0, 0, 0, 0.1);">
    <h2 style="text-align: center; color: #29668f; margin-bottom: 20px;">Room Types and Rates</h2>
    <table class="reservation-table" id="reservationTable" style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
        <thead>
            <tr style="background-color: #29668f; color: #fff; text-align: left;">
                <th style="padding: 10px; border: 1px solid #ddd;">Room Image</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Room Type</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Category</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Price (per night)</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Benefits</th>
                <th style="padding: 10px; border: 1px solid #ddd;">Action</th>
            </tr>
        </thead>
        <tbody id="roomTableBody">
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;">
                    <img src="resource/single.jpg" alt="Room Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
                </td>
                <td style="padding: 10px; border: 1px solid #ddd;">Single Room</td>
                <td style="padding: 10px; border: 1px solid #ddd;">Standard</td>
                <td style="padding: 10px; border: 1px solid #ddd;">Rp. 500.000</td>
                <td style="padding: 10px; border: 1px solid #ddd;">Free Wi-Fi, Breakfast Included</td>
                <td style="padding: 10px; border: 1px solid #ddd;">
                    <button onclick="editRow(this)" style="background-color: #4aa4e0; color: #fff; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;">Edit</button>
                    <button onclick="deleteRow(this)" style="background-color: #ff6347; color: #fff; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>


<script>
 let editingRow = null; // Track the row being edited

// Function to save room (add or update)
function saveRoom() {
    const roomType = document.getElementById('roomType').value.trim();
    const category = document.getElementById('category').value.trim();
    const price = document.getElementById('price').value.trim();
    const benefits = document.getElementById('benefits').value.trim();
    const roomImage = document.getElementById('roomImage').files[0];

    // Validate fields
    if (!roomType || !category || !price || !benefits) {
        alert('All fields must be filled out!');
        return;
    }

    const tableBody = document.getElementById('roomTableBody');
    
    if (editingRow) {
        // Update existing row
        const cells = editingRow.getElementsByTagName('td');

        // Update the data in the cells
        cells[1].innerText = roomType;
        cells[2].innerText = category;
        cells[3].innerText = `Rp. ${price}`;
        cells[4].innerText = benefits;

        if (roomImage) {
            const reader = new FileReader();
            reader.onload = function (e) {
                cells[0].getElementsByTagName('img')[0].src = e.target.result;
            };
            reader.readAsDataURL(roomImage);
        }

        resetForm();
        editingRow = null;
    } else {
        // Add new row
        const newRow = document.createElement('tr');

        // Create cells and add content
        newRow.innerHTML = `
            <td style="padding: 10px; border: 1px solid #ddd;">
                <img src="" alt="Room Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px;">
            </td>
            <td style="padding: 10px; border: 1px solid #ddd;">${roomType}</td>
            <td style="padding: 10px; border: 1px solid #ddd;">${category}</td>
            <td style="padding: 10px; border: 1px solid #ddd;">Rp. ${price}</td>
            <td style="padding: 10px; border: 1px solid #ddd;">${benefits}</td>
            <td style="padding: 10px; border: 1px solid #ddd;">
                <button onclick="editRow(this)" style="background-color: #4aa4e0; color: #fff; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;">Edit</button>
                <button onclick="deleteRow(this)" style="background-color: #ff6347; color: #fff; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;">Delete</button>
            </td>
        `;

        // Handle the room image if provided
        if (roomImage) {
            const reader = new FileReader();
            reader.onload = function (e) {
                newRow.querySelector('img').src = e.target.result;
            };
            reader.readAsDataURL(roomImage);
        }

        // Append the new row to the table body
        tableBody.appendChild(newRow);

        // Reset the form after adding
        resetForm();
    }
}

// Function to delete a room
function deleteRow(button) {
    if (confirm('Are you sure you want to delete this room?')) {
        const row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
}

// Function to edit a room row
function editRow(button) {
    editingRow = button.parentNode.parentNode;
    const cells = editingRow.getElementsByTagName('td');

    // Populate the form with current row data
    document.getElementById('roomType').value = cells[1].innerText;
    document.getElementById('category').value = cells[2].innerText;
    document.getElementById('price').value = cells[3].innerText.replace('Rp. ', '').trim();
    document.getElementById('benefits').value = cells[4].innerText;

    // Change form title to "Edit Room"
    document.getElementById('formTitle').innerText = "Edit Room";
}

// Function to reset the form
function resetForm() {
    document.getElementById('roomForm').reset();
    document.getElementById('formTitle').innerText = "Add New Room";
}

</script>


<div id="Contact" class="section">
    <h2>Contact</h2>
    <p>
        Four Points by Sheraton Makassar<br>
        Jalan Andi Djemma No. 130 Makassar, South Sulawesi 90222<br>
        Phone: +62 411 8099999<br>
        Email: reservation.makassar@fourpoints.com
    </p>

    <!-- Google Maps iframe -->
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.7311544084367!2d119.41914527467783!3d-5.168048753556045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefd3f234c5f4d%3A0x5c00edc80b91c82!2sFour%20Points%20by%20Sheraton%20Makassar!5e0!3m2!1sen!2sid!4v1698068485449!5m2!1sen!2sid" 
        width="1000" 
        height="450" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>
</head>
  <div class="footer">
    <p>&copy; 2023 Four Points by Sheraton Makassar</p>
  </div>
</body>
</html>
</body>
</html>
