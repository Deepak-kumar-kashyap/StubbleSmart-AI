# 🌾 StubbleSmart AI

**StubbleSmart AI** is a decentralized, high-engagement marketplace that tackles the massive environmental crisis of agricultural stubble burning. By bridging the gap between farmers and green bio-energy industries, we turn toxic smoke into a scalable, sustainable economy.

This project was developed to demonstrate how on-device AI and geospatial logistics can solve real-world climate problems effectively.

## ✨ Features

- **On-Device AI Verification:** Farmers upload photos of their stubble waste. Using `TensorFlow.js` (MobileNet), the app instantly verifies the presence of agricultural waste right in the browser, eliminating server processing costs and preventing fraudulent claims.
- **Geospatial Logistics Dashboard:** Industries get a real-time, interactive `Leaflet.js` map showing the exact GPS coordinates of verified stubble, allowing for optimized collection routes.
- **Live Status Tracking:** Visualize the supply chain with color-coded, custom map pins (Pending, Verified, Collected).
- **Carbon Credit Estimator:** Farmers can instantly see their potential earnings in cash and Carbon Credits, incentivizing green practices.
- **CSV Data Export:** Push-button reporting for industries to export the entire geospatial dataset for logistics and compliance.
- **Ultra-Engaging UI:** A cinematic, glassmorphism-inspired interface with scroll-triggered `AOS` animations, providing a modern and intuitive user experience.

## 🛠️ Tech Stack

- **Frontend:** HTML5, Tailwind CSS, AOS (Animate on Scroll)
- **Backend:** PHP 8.x
- **Database:** MySQL (PDO used for secure interactions)
- **AI/ML:** TensorFlow.js (MobileNet model)
- **Mapping:** Leaflet.js

## 🚀 Getting Started

To run this project locally, you need a standard LAMP/WAMP/XAMPP stack.

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/YOUR_USERNAME/STUBBLESMART.git
    cd STUBBLESMART
    ```

2.  **Database Setup:**
    - Open your MySQL administration tool (e.g., phpMyAdmin).
    - Create a new database (e.g., `test1`).
    - Import the provided `schema.sql` file to create the `stubbles` table.
    - Update the database credentials in `db.php` if necessary (defaults to `root` with no password).

3.  **Run the App:**
    - Place the project folder inside your web server's root directory (e.g., `htdocs` for XAMPP).
    - Open your browser and navigate to `http://localhost/YOUR_FOLDER_NAME/index.php`.

## 📂 Project Structure

- `index.php`: The high-converting, cinematic landing page.
- `farmer.php`: The portal for farmers to upload photos and get AI verification.
- `industry.php`: The industrial dashboard for monitoring supply and logistics.
- `api/`: Contains PHP endpoints for data retrieval (`get_stubbles.php`) and status management (`update_status.php`).
- `upload.php`: Handles image uploads from the farmer portal.
- `db.php`: Database connection logic.
- `schema.sql`: Database schema definition.
- `uploads/`: Directory where farmer images are securely stored.

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!

## 📜 License

This project is open-source and available under the MIT License.
