const express = require('express');
const bodyParser = require('body-parser');
const app = express();

// Use body-parser to parse POST request body
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.urlencoded({ extended: true }));

// Set the view engine to EJS
app.set('view engine', 'ejs');

// Serve static files
app.use(express.static('public'));

// Handle GET request for the default route
app.get('/', (req, res) => {
    res.render('index', { title: 'Membership Form' });
});

// Handle POST request for form submission
app.post('/submitmembership', (req, res) => {
    const { name, surname, email, phone, capStyle, comment, capsOwned } = req.body;
    let errors = [];

    // Validate form fields
    if (!name) errors.push("Name is required.");
    if (!surname) errors.push("Surname is required.");
    if (!email) {
        errors.push("Email is required.");
    } else if (!email.endsWith("@deakin.edu.au")) {
        errors.push("Email must end with @deakin.edu.au.");
    }
    if (!phone) errors.push("Phone number is required.");
    if (!capStyle) errors.push("Cap Style is required.");
    if (!capsOwned) errors.push("Number of caps owned is required.");
    if (!comment) errors.push("Comment is required.");

    // If there are validation errors, render the error page
    if (errors.length > 0) {
        return res.render('error', { errors });
    }

    // If no errors, render the thank you page with dynamic comment message
    res.render('thankyou', {
        title: 'Thank You for Your Submission',
        name: name,
        surname: surname,
        email: email,
        phone: phone,
        capStyle: capStyle,
        comment: comment,
        capsOwned: capsOwned
    });
});

// Start the server
app.listen(3000, () => {
    console.log('Server running on http://localhost:3000');
});
