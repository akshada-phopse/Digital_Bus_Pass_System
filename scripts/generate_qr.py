import qrcode
import sys
import mysql.connector

# Database connection settings
db_config = {
    'host': 'localhost',
    'user': 'root',  # Default XAMPP user
    'password': '',  # Default XAMPP password is empty
    'database': 'digital_bus_pass'
}

# Get student information from command-line arguments
student_id = sys.argv[1]
destination = sys.argv[2]
start_date = sys.argv[3]
end_date = sys.argv[4]

# Generate the data to be encoded in the QR code
qr_data = f"Student ID: {student_id}\nDestination: {destination}\nValid From: {start_date}\nValid Until: {end_date}"

# Generate the QR code
qr = qrcode.QRCode(
    version=1,
    error_correction=qrcode.constants.ERROR_CORRECT_L,
    box_size=10,
    border=4,
)
qr.add_data(qr_data)
qr.make(fit=True)

# Create an image from the QR code instance
img = qr.make_image(fill='black', back_color='white')

# Define the path to save the QR code
qr_filename = f"qr_{student_id}.png"
img.save(f"C:/xampp/htdocs/bus_pass_system/qrcodes/{qr_filename}")

# Store the QR code path in the database
conn = mysql.connector.connect(**db_config)
cursor = conn.cursor()

# Update the student's record with the path to the QR code
update_query = "UPDATE students SET qr_code_path = %s WHERE id = %s"
cursor.execute(update_query, (qr_filename, student_id))
conn.commit()

cursor.close()
conn.close()
