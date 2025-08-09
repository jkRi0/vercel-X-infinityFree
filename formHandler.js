// Get the form element
const form = document.getElementById('myForm');

// Listen for submit event
form.addEventListener('submit', function(event) {
    event.preventDefault(); // stop form from refreshing the page

    // Get form data using FormData API
    const formData = new FormData(form);

    // Convert to a plain object (optional)
    const data = {};
    formData.forEach((value, key) => {
        data[key] = value;
    });

    // Output the data
    console.log("Form Data:", data);
    alert(`Name: ${data.name}\nEmail: ${data.email}`);
});




function sendData1(event) {
    event.preventDefault();
    const comment = document.getElementById('commentInput').value;
    console.log("Comment:", comment);
    
    
}