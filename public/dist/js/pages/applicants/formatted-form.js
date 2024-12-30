document.getElementById('copyModalButton').addEventListener('click', function () {
    // Select the modal content
    const modal = document.querySelector('.modal-body');
    if (modal) {
        // Create a temporary textarea to hold the modal's HTML
        const tempTextarea = document.createElement('textarea');
        tempTextarea.value = modal.textContent; // Copies HTML content
        // For plain text, use: tempTextarea.value = modal.textContent;

        document.body.appendChild(tempTextarea);
        tempTextarea.select(); // Select the content of the textarea
        console.log(tempTextarea);
        document.execCommand('copy'); // Copy to clipboard
        document.body.removeChild(tempTextarea); // Clean up
        alert('Modal content copied to clipboard!');
    } else {
        alert('Modal content not found!');
    }
});
