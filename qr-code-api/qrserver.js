//No error

const express = require('express');
const axios = require('axios');
const app = express();
const port = 3000;

app.use(express.json());

app.post('/generate-qr-code', async (req, res) => {
  const { data } = req.body;

  try {
    const response = await axios.post('https://QR-Code-Generator-API.proxy-production.allthingsdev.co/api/v1/image/qrcode', {
      data
    }, {
      headers: {
        'x-app-version': '1.0.0',
        'x-apihub-key': 'iGTiY05pEy5qhbjtQEOZB96W3uzhsPNVFNABgSrJtVezLITiUO',
        'x-apihub-host': 'QR-Code-Generator-API.allthingsdev.co',
        'x-apihub-endpoint': '8db04504-c6ae-4874-b4ce-b9ab7440bba5',
        'Content-Type': 'application/json'
      }
    });
    res.json({
      success: true,
      qrCodeUrl: response.data.data
    });
  } catch (error) {
    console.error('Error generating QR code:', error.message);
    res.status(500).json({
      success: false,
      message: 'Failed to generate QR code',
      error: error.message
    });
  }
});

app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
