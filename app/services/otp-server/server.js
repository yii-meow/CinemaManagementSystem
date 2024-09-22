const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const { Twilio } = require('twilio');

const app = express();
const port = 3000;

// Replace these with your Twilio credentials
const accountSid = 'AC2e4d680e9dd3fa0e2ef3f8eff9b75a6f'; 
const authToken = '4fa9fadb08719738670e458ebd8a7051'; 
const twilioPhoneNumber = '+19477770658';

const client = new Twilio(accountSid, authToken);

// Middleware to parse JSON bodies and handle CORS
app.use(bodyParser.json());
app.use(cors()); // Enable CORS

app.post('/send-otp', async (req, res) => {
    const { phoneNo, otpCode } = req.body;

    const message = `Your OTP code is: ${otpCode}`;

    // Validate the phone number (just an example, you can use more sophisticated validation)
    if (!/^\+\d{1,14}$/.test(phoneNo)) {
        return res.status(400).json({
            success: false,
            message: 'Invalid phone number format.'
        });
    }

    try {
        await client.messages.create({
            body: message,
            from: twilioPhoneNumber,
            to: phoneNo
        });

        res.json({
            success: true,
            message: 'OTP sent successfully.'
        });
    } catch (error) {
        console.error('Error sending OTP:', error.message);

        // Send detailed error message to PHP
        res.status(500).json({
            success: false,
            message: 'Error sending OTP. Please check the phone number or try again later.'
        });
    }
});

app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});