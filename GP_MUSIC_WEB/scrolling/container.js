const contentContainer = document.getElementById('content-container');
const loadingIndicator = document.getElementById('loading-indicator');

function loadMoreContent() {
    loadingIndicator.style.display = 'block';

    // Make an AJAX or Fetch request to the server
    // ...

    // Append the new content to the container
    // ...

    loadingIndicator.style.display = 'none';
}
