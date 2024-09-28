//No error
//
// const express = require('express');
// const axios = require('axios');
// const app = express();
// const port = 3000;
//
// app.use(express.json());
//
// app.post('/generate-qr-code', async (req, res) => {
//   const { data } = req.body;
//
//   try {
//     const response = await axios.post('https://QR-Code-Generator-API.proxy-production.allthingsdev.co/api/v1/image/qrcode', {
//       data
//     }, {
//       headers: {
//         'x-app-version': '1.0.0',
//         'x-apihub-key': 'iGTiY05pEy5qhbjtQEOZB96W3uzhsPNVFNABgSrJtVezLITiUO',
//         'x-apihub-host': 'QR-Code-Generator-API.allthingsdev.co',
//         'x-apihub-endpoint': '8db04504-c6ae-4874-b4ce-b9ab7440bba5',
//         'Content-Type': 'application/json'
//       }
//     });
//     res.json({
//       success: true,
//       qrCodeUrl: response.data.data
//     });
//   } catch (error) {
//     console.error('Error generating QR code:', error.message);
//     res.status(500).json({
//       success: false,
//       message: 'Failed to generate QR code',
//       error: error.message
//     });
//   }
// });
//
// app.listen(port, () => {
//   console.log(`Server is running on http://localhost:${port}`);
// });





const express = require('express');
const axios = require('axios');
const app = express();
const port = 3000;

app.use(express.json());

app.post('/generate-qr-code', async (req, res) => {
  const { data } = req.body;

  // Define the request options
  const options = {
    method: 'GET',
    url: 'https://qr-code-by-api-ninjas.p.rapidapi.com/v1/qrcode',
    params: {
      data,
      format: 'png',
    },
    responseType: 'arraybuffer', // To handle binary data
    headers: {
      'x-rapidapi-key': '737534c0a3msh754c22b40f882dcp1b0b11jsn9a70f208eda1',
      'x-rapidapi-host': 'qr-code-by-api-ninjas.p.rapidapi.com',
    },
  };

  try {
    // Send the request with the defined options
    const response = await axios.request(options);
    const base64Image = Buffer.from(response.data, 'binary')
    res.json({
      success: true,
      qrCodeUrl: `data:image/png;base64,${base64Image}` // Adjust MIME type if needed
    });

  } catch (error) {
    console.error('Error generating QR code:', error.message);
    res.status(500).json({
      success: false,
      message: 'Failed to generate QR code',
      error: error.message,
    });
  }
});

// Start the server
app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});



