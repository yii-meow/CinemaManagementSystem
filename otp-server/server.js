const express = require('express');
const bodyParser = require('body-parser');
const cors = require('cors');
const { Twilio } = require('twilio');

const app = express();
const port = 3000;

// Replace these with your Twilio credentials
const accountSid = 'ACb22155837a913914ae94155c47338fb9'; 
const authToken = 'b39f440f767bbeefa9ef1d182eb2c0cb'; 
const twilioPhoneNumber = '+1 718 305 1851';

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