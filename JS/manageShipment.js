let popup = document.getElementById("popup");

// to open the popup form
function openPopup(){
    popup.classList.add("open_popup");
}

// to close the popup form
function closePopup(){
    popup.classList.remove("open_popup");
    const url = new URL(window.location);
    url.searchParams.delete('id');
    window.history.replaceState({}, document.title, url);
}

// Close popup when clicking outside
popup.addEventListener('click', (e) => {
    if (e.target === popup) {
        closePopup();
    }
});

// Check if URL has an 'id' query parameter
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('id')) {
  openPopup();
}